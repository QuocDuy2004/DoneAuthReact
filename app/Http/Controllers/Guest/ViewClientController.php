<?php

namespace App\Http\Controllers\Guest;

use App\Curl\SmmApi;
use App\Http\Controllers\Api\Service\SmmController;
use App\Http\Controllers\Controller;
use App\Models\AccountRecharge;
use App\Models\Activities;
use App\Models\Activitiessystem;
use App\Models\Notification;
use App\Models\Support;
use App\Models\Service;
use App\Models\Orders;
use App\Models\User;
use App\Models\Tainguyen;
use App\Models\Category;
use App\Models\Currency;
use App\Models\HistoryLogin;
use App\Models\HistoryRecharge;
use App\Models\Payments;
use App\Models\Provider;
use App\Models\ServerService;
use App\Models\ServiceSocial;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteCon;
use App\Models\SiteData;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewClientController extends Controller
{

    public function LandingPage()
    {
        // Lấy giá trị của cột `landing` từ bảng `site_data`
        $siteData = SiteData::first(); // Giả sử bạn chỉ có một bản ghi trong bảng site_data
        $landing = $siteData->landing;

        // Kiểm tra giá trị của cột landing để load đúng view
        if ($landing == 1) {

            return view('landing_1'); // Hiển thị landing 1
        } elseif ($landing == 2) {
            return view('landing_2'); // Hiển thị landing 2
        } elseif ($landing == 3) {
            return view('landing_3'); // Hiển thị landing 3
        } elseif ($landing == 4) {
            return view('landing_4'); // Hiển thị landing 4
        } elseif ($landing == 5) {
            return view('landing_5'); // Hiển thị landing 4
        } else {
            return view('landing_1'); // Hiển thị một trang mặc định
        }
    }


    public function autoServer(Request $request)
    {
        try {
            // Lấy tất cả các URL và key từ bảng providers
            $providers = Provider::select('url', 'key')->get();
            $social = ServiceSocial::where('domain', getDomain())->get();
            $service = Service::where('domain', getDomain())->get();

            // Truyền dữ liệu sang view
            return view('admin.server.auto', ['providers' => $providers, 'services' => null], compact('social', 'service'));
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return view('admin.providers.error', ['message' => 'An error occurred while fetching providers']);
        }
    }

    public function getServices(Request $request)
    {
        try {
            $providerDomain = $request->input('provider_url'); // Domain từ frontend
            $providerKey = $request->input('provider_key');

            // Xây dựng URL đầy đủ từ domain
            $providerUrl = 'https://' . $providerDomain . '/api/v2';

            // Tìm provider theo domain và key
            $provider = Provider::where('url', $providerUrl)->where('key', $providerKey)->first();

            if (!$provider) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Provider không tìm thấy hoặc key không đúng'], 404);
                } else {
                    return redirect()->route('admin.server.auto')->with('error', 'Provider không tìm thấy hoặc key không đúng');
                }
            }

            $smmApi = new SmmApi($provider->key, $provider->url);
            $response = $smmApi->services();

            // Debug dữ liệu JSON trả về từ API
            \Log::info('Dữ liệu từ API:', ['response' => $response]);

            if (isset($response['error'])) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Không thể lấy danh sách dịch vụ: ' . $response['error']], 500);
                } else {
                    return redirect()->route('admin.server.auto')->with('error', 'Không thể lấy danh sách dịch vụ: ' . $response['error']);
                }
            }

            $services = json_decode(json_encode($response), true);

            if ($request->ajax()) {
                return response()->json(['services' => $services]);
            } else {
                return view('admin.server.auto', [
                    'providers' => Provider::select('url', 'key')->get(),
                    'services' => $services
                ]);
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
            } else {
                return redirect()->route('admin.server.auto')->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
            }
        }
    }



    public function processSelectedServices(Request $request)
    {
        $selectedServices = $request->input('services');

        if ($selectedServices) {
            foreach ($selectedServices as $serviceId) {
                // Thực hiện logic xử lý với serviceId
            }

            return redirect()->back()->with('success', 'Dịch vụ đã được xử lý thành công');
        }

        return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một dịch vụ');
    }





    public function HomePage()
    {
        // Các mã hiện tại của bạn...
        $social = ServiceSocial::where('domain', env('PARENT_SITE'))->get();
        $socialSlugs = $social->pluck('slug')->all();
        $socialid = $social->pluck('id')->all();
        $order = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->count();
        $order_processing = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Processing')->count();
        $dangchay = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Active')->count() + $order_processing;
        $hoanthanh = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Completed')->count() + Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Success')->count();
        $order_failed = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Suspended')->count();
        $service = Service::where('domain', env('PARENT_SITE'))->whereIn('service_social', $socialSlugs)->get();
        $order_cancelled = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Cancelled')->count();
        $notification = Notification::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $hoantien = Orders::where('domain', getDomain())->where('username', Auth::user()->username)->where('status', 'Refunded')->count();

        // Tháng hiện tại
        $startDateCurrentMonth = Carbon::now()->startOfMonth();
        $endDateCurrentMonth = Carbon::now()->endOfMonth();

        // Tháng trước
        $startDateLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endDateLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Tổng số tiền nạp của tháng hiện tại và tháng trước
        $totalDepositCurrentMonth = HistoryRecharge::whereBetween('created_at', [$startDateCurrentMonth, $endDateCurrentMonth])
            ->where('username', Auth::user()->username)
            ->sum('amount');
        $totalDepositLastMonth = HistoryRecharge::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])
            ->where('username', Auth::user()->username)
            ->sum('amount');

        // Tổng số đơn hàng của tháng hiện tại và tháng trước
        $totalOrdersCurrentMonth = Orders::whereBetween('created_at', [$startDateCurrentMonth, $endDateCurrentMonth])
            ->where('username', Auth::user()->username)
            ->count();
        $totalOrdersLastMonth = Orders::whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])
            ->where('username', Auth::user()->username)
            ->count();

        // Số dư hiện tại và số dư của tháng trước
        $currentBalance = Auth::user()->balance;
        $balanceLastMonth = Auth::user()->whereBetween('created_at', [$startDateLastMonth, $endDateLastMonth])
            ->where('username', Auth::user()->username)
            ->sum('balance'); // Bạn cần đảm bảo rằng có lưu số dư vào cơ sở dữ liệu

        // Tính tỷ lệ phần trăm thay đổi
        $depositChangePercentage = $totalDepositLastMonth > 0 ? (($totalDepositCurrentMonth - $totalDepositLastMonth) / $totalDepositLastMonth) * 100 : 0;
        $ordersChangePercentage = $totalOrdersLastMonth > 0 ? (($totalOrdersCurrentMonth - $totalOrdersLastMonth) / $totalOrdersLastMonth) * 100 : 0;
        $balanceChangePercentage = $balanceLastMonth > 0 ? (($currentBalance - $balanceLastMonth) / $balanceLastMonth) * 100 : 0;

        $label = [];
        $recharges = [];
        $purchase = [];
        $refund = [];
        $cancel = [];

        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create(date('Y'), $month, 1)->startOfMonth();
            $endDate = Carbon::create(date('Y'), $month, 1)->endOfMonth();

            $formatMonth = $startDate->format('M');
            $label[] = $formatMonth;

            $recharge = HistoryRecharge::whereBetween('created_at', [$startDate, $endDate])
                ->where('username', Auth::user()->username)
                ->sum('amount');
            $orders = Orders::whereBetween('created_at', [$startDate, $endDate])
                ->where('username', Auth::user()->username)
                ->sum('total_payment');
            $refunded = Orders::where(['status' => 'Refunded'])
                ->where('username', Auth::user()->username)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();
            $canceled = Orders::where(['status' => 'Cancelled'])
                ->where('username', Auth::user()->username)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

            $recharges[] = $recharge;
            $purchase[] = $orders;
            $refund[] = $refunded;
            $cancel[] = $canceled;
        }

        $chart = [
            'labels' => $label,
            'recharge' => $recharges,
            'orders' => $purchase,
            'refunded' => $refund,
            'canceled' => $cancel,
        ];
        $user = Auth::user();

        // Lấy thông tin tỷ giá từ bảng Currency cho loại tiền tệ của người dùng
        $currency = Currency::where('currency_code', $user->type_balance)
            ->where('status', 1)
            ->first();

        // Tính toán số dư dựa trên loại tiền tệ
        if ($user->type_balance === "VND") {
            // Nếu loại tiền tệ là VND, sử dụng số dư gốc
            $balance_s = number_format($user->balance);
            $currency_symbol = "₫"; // Ký hiệu tiền tệ cho VND
        } else {
            // Nếu loại tiền tệ không phải VND, chia số dư của người dùng cho tỷ giá
            if ($currency) {
                $balance_s = number_format($user->balance / $currency->rate, 2);
                $currency_symbol = $currency->currency_symbol;
            } else {
                $balance_s = number_format($user->balance); // Hiển thị số dư gốc nếu không tìm thấy tỷ giá
                $currency_symbol = $user->type_balance; // Sử dụng loại tiền tệ của người dùng nếu không có tỷ giá
            }
        }

        return view('Client.home', compact(
            'notification',
            'activities',
            'activitiessystem',
            'social',
            'service',
            'dangchay',
            'hoanthanh',
            'order',
            'hoantien',
            'order_failed',
            'order_cancelled',
            'chart',
            'socialid',
            'totalDepositCurrentMonth',
            'totalDepositLastMonth',
            'totalOrdersCurrentMonth',
            'totalOrdersLastMonth',
            'depositChangePercentage',
            'ordersChangePercentage',
            'currentBalance',
            'balanceLastMonth',
            'balanceChangePercentage',
            'balance_s',
            'currency_symbol'
        ));
    }



    public function ProfilePage()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $history_login = HistoryLogin::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.profile', compact('activities', 'activitiessystem', 'history_login'));
    }

    public function TransferPage()
    {
        $account = AccountRecharge::where('domain', getDomain())->get();
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();

        $payments = Payments::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Account.Deposits.transfer', compact('account', 'activities', 'activitiessystem', 'payments'));
    }

    public function CardPage()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Account.Deposits.card', compact('activities', 'activitiessystem'));
    }

    public function HistoryPage()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.User.history', compact('activities', 'activitiessystem'));
    }

    public function Ref()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $count = User::where('ref_id', Auth::user()->id)->where('domain', getDomain())->count();
        $money1 = User::where('id', Auth::user()->id)->where('domain', getDomain())->first();
        $money = $money1->referral_money;

        return view('Client.User.ref', compact('activities', 'activitiessystem', 'count', 'money'));
    }
    public function HistoryPurchase()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.User.donhang', compact('activities', 'activitiessystem'));
    }
    // public function SupportEditPage($id)
    // {
    //     $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
    //     $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
    //     $support = Support::where('parent_id', $id)->where('domain', getDomain())->first();

    //     return view('Client.supportedit', compact('activities', 'activitiessystem', 'support'));
    // }
    public function LevelPage()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.User.level', compact('activities', 'activitiessystem'));
    }
    public function DocsApi()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Pages.api', compact('activities', 'activitiessystem'));
    }
    public function Terms()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.dieukhoan', compact('activities', 'activitiessystem'));
    }

    public function showTicket()
    {
        return view('Client.Tickets.index');
    }

    public function CreateWebsite()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();

        $sitecon = SiteCon::where('domain', getDomain())->where('username', Auth::user()->username)->first();
        if (!$sitecon) {
            // stdclass domain
            $sitecon = new \stdClass();
            $sitecon->domain_name = '';
        }
        return view('Client.Website.create', compact('sitecon', 'activities', 'activitiessystem'));
    }

    public function ViewChuyenmucPage($chuyenmuc)
    {
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $category = Category::where('domain', env('PARENT_SITE'))->where('slug', $chuyenmuc)->first();

        if ($category) {
            $tainguyen1 = Tainguyen::where('domain', env('PARENT_SITE'))->where('category_id', $category->id)->first();
            if ($tainguyen1) {
                $tainguyen = Tainguyen::where('domain', env('PARENT_SITE'))->where('category_id', $category->id)->get();
                return view('Client.Tainguyen.tainguyen', compact('category', 'activities', 'tainguyen'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
    public function ToolUid()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.Tool.getUid', compact('activities', 'activitiessystem'));
    }
    public function ToolDomain()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.Tool.whiosDomain', compact('activities', 'activitiessystem'));
    }
    public function Tool2fa()
    {
        $activitiessystem = Activitiessystem::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        $activities = Activities::where('domain', getDomain())->orderBy('id', 'DESC')->get();
        return view('Client.Tool.get2FA', compact('activities', 'activitiessystem'));
    }

    public function Affiliates()
    {
        $referral_code = Auth::check() ? Auth::user()->referral_code : '';

        // Tạo đường dẫn liên kết tiếp thị theo định dạng yêu cầu
        $referral_link = $referral_code ? url('john/' . $referral_code) : '';

        return view('Pages.affiliates', ['referral_link' => $referral_link]);
    }

    public function updateCurrency(Request $request)
    {
        try {
            // Xác thực dữ liệu yêu cầu
            $request->validate([
                'currency_code' => 'required|string|exists:currencies,currency_code',
                'currency_symbol' => 'required|string', // Xác thực ký hiệu tiền tệ
            ]);

            // Lấy người dùng hiện tại
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with('error', 'User not authenticated.');
            }

            // Lấy mã tiền tệ và ký hiệu từ yêu cầu
            $currencyCode = $request->input('currency_code');
            $currencySymbol = $request->input('currency_symbol');

            // Cập nhật loại tiền tệ cho người dùng
            $user->type_balance = $currencyCode; // Cập nhật currency_code
            $user->save();

            return redirect()->back()->with('success', 'Currency updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating currency: ' . $e->getMessage());
        }
    }

    public function statusOrders()
    {
        $history_orders = Orders::where('status', '!=', 'Completed')->where('actual_service', '!=', 'dontay')->get();
        $orderStatusResults = [];
        foreach ($history_orders as $order) {
            // Lấy Provider tương ứng với actual_service trong đơn hàng
            $provider = Provider::where('url', 'like', '%' . $order->actual_service . '%')
                ->where('status', 1)
                ->select('id', 'url', 'key')
                ->first();
            // Nếu tìm thấy Provider, thực hiện curl lấy trạng thái đơn hàng
            if ($provider) {
                // Tạo một instance của SmmController với url và apiToken từ provider
                $smmController = new SmmController($provider->url, $provider->key);
                // Gọi hàm status để kiểm tra trạng thái đơn hàng
                $response = $smmController->status($order->order_code);
                // Lưu kết quả vào mảng orderStatusResults
                $orderStatusResults[$order->id] = $response;
                // Cập nhật trạng thái của đơn hàng trong cơ sở dữ liệu nếu API trả về status
                if ($response && isset($response['status'])) {
                    // Lấy giá trị status từ API
                    $apiStatus = $response['status'];
                    // Cập nhật trạng thái của đơn hàng
                    switch ($apiStatus) {
                        case 'Pending':
                            $order->update(['status' => 'Pending']);
                            break;
                        case 'Processing':
                            $order->update(['status' => 'Processing']);
                            break;
                        case 'In progress':
                            $order->update(['status' => 'In progress']);
                            break;
                        case 'Completed':
                            $order->update(['status' => 'Completed']);
                            break;
                        case 'Refund':
                            $order->update(['status' => 'Refund']);
                            break;
                        case 'Cancel':
                            $order->update(['status' => 'Cancel']);
                            break;
                        case 'Partial':
                            $order->update(['status' => 'Partial']);
                            break;
                        case 'Fail':
                            $order->update(['status' => 'Fail']);
                            break;
                        case 'Error':
                            $order->update(['status' => 'Error']);
                            break;
                        default:
                            $order->update(['status' => 'Error']);
                            break;
                    }
                    // Cập nhật trường buff của đơn hàng với giá trị remains từ phản hồi
                    if (isset($response['remains'])) {
                        $order->update(['buff' => $response['remains']]);
                    }
                    // if (isset($response['remains']) && isset($order->quantity)) {
                    //     $remainingQuantity = $order->quantity - $response['remains'];
                    //     $order->update(['buff' => $remainingQuantity]);
                    // }
                }
            }
        }
        // Trả về view với dữ liệu lịch sử đơn hàng, provider và kết quả status
        return view('crons.orders', compact('history_orders', 'orderStatusResults'));
    }

    public function sync()
    {
        // Lấy tất cả các dịch vụ với trạng thái 'Active' từ domain hiện tại
        $price_services = ServerService::where('domain', getDomain())->where('status', 'Active')->get();
        
        // Lấy provider đang hoạt động
        $provider = Provider::where('status', 1)->first(); 
    
        if ($provider) {
            // Khởi tạo controller để lấy dịch vụ từ API
            $smmController = new \App\Http\Controllers\Api\Service\SmmController($provider->url, $provider->key);
            $api_services = $smmController->services();
    
            if (!empty($api_services) && is_array($api_services)) {
                foreach ($api_services as $api_service) {
                    if (isset($api_service['service']) && isset($api_service['rate']) && isset($api_service['min']) && isset($api_service['max'])) {
                        // Tìm dịch vụ tương ứng trong cơ sở dữ liệu
                        $service = ServerService::where('domain', getDomain())
                            ->where('status', 'Active')
                            ->where('actual_server', $api_service['service'])
                            ->first();
    
                        if ($service) {
                            $actual_price = $api_service['rate'] * 25;
                            $change_log = '';
                            $is_updated = false; // Biến để theo dõi xem có thay đổi nào không
    
                            // Nếu giá mới khác với giá hiện tại thì cập nhật và ghi log
                            if ($actual_price != $service->actual_price) {
                                $old_price = $service->price;
                                $new_price = $actual_price * 1.10;
                                $new_price_collaborator = $new_price * 1.10;
                                $new_price_agency = $new_price_collaborator * 1.10;
                                $new_price_distributor = $new_price_agency * 1.10;
    
                                // Cập nhật giá trị mới vào cơ sở dữ liệu
                                $service->update([
                                    'actual_price' => $actual_price,
                                    'price' => $new_price,
                                    'price_collaborator' => $new_price_collaborator,
                                    'price_agency' => $new_price_agency,
                                    'price_distributor' => $new_price_distributor,
                                ]);
    
                                $change_log .= '<i class="fa-solid fa-caret-up text-success"></i> <span class="text-success">Price change from ' . $old_price . ' to ' . $new_price . '</span><br>';
                                $is_updated = true;
                            }
    
                            // Nếu có thay đổi về min/max thì cập nhật và ghi log
                            if ($service->min != $api_service['min'] || $service->max != $api_service['max']) {
                                $change_log .= 'Thay đổi min/max: min từ ' . $service->min . ' thành ' . $api_service['min'] . ', max từ ' . $service->max . ' thành ' . $api_service['max'] . '. ';
                                
                                // Cập nhật min/max mới vào cơ sở dữ liệu
                                $service->update([
                                    'min' => $api_service['min'],
                                    'max' => $api_service['max'],
                                ]);
    
                                $is_updated = true;
                            }
    
                            // Nếu có thay đổi (giá hoặc min/max), ghi log vào database
                            if ($is_updated) {
                                DB::table('sync_log')->insert([
                                    'service' => "$service->id | $service->actual_server | $provider->url | " . $service->title,
                                    'change' => $change_log,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }
            }
        }
    
        return view('crons.sync', compact('price_services', 'api_services'));
    }
    
}
