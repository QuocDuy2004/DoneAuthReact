<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\CloudflareCustomController;
use App\Models\AccountRecharge;
use App\Models\Activities;
use App\Models\Activitiessystem;
use App\Models\DataHistory;
use App\Models\HistoryLogin;
use App\Models\HistoryCard;
use App\Models\HistoryRecharge;
use App\Models\Notification;
use App\Models\NewsAnnouncement;
use App\Models\Orders;
use App\Models\ServerService;
use App\Models\Service;
use App\Models\ServiceSocial;
use App\Models\SiteData;
use App\Models\Tainguyen;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Custom\TelegramCustomController;
use App\Models\SiteCon;
use App\Http\Controllers\Custom\CpanelCustomController;
use App\Models\Payments;
use App\Models\Tickets;

class DataAdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('xss')->only(['']);
    }

    public function ticketsReply($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'reply' => 'required',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $ticket = Tickets::where('id', $id)->first();

            if (!$ticket) {
                return redirect()->back()->with('error', 'Ticket không tồn tại!');
            }
            $ticket->reply = $request->reply;
            $ticket->username = $request->username;
            $ticket->save();
            return redirect()->back()->with('success', 'Phản hồi thành công!');
        }
    }

    public function ticketsDelete($id)
    {
        try {
            $count = Tickets::where('domain', getDomain())
                ->where('id', $id)
                ->delete();
            if ($count > 0) {
                return redirect()->back()->with('success', 'Xóa liên hệ thành công');
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy liên hệ để xóa');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa: ' . $e->getMessage());
        }
    }


    public function websiteConfig(Request $request)
    {
        $DataSite = SiteData::where('domain', getDomain())->first();
        foreach ($request->all() as $key => $value) {
            if ($key != '_token') {
                $DataSite->$key = $value;
            }
            if (isset($request->notice_order)) {
                $DataSite->notice_order = 'on';
            } else {
                $DataSite->notice_order = 'off';
            }
            if (isset($request->notice_login)) {
                $DataSite->notice_login = 'on';
            } else {
                $DataSite->notice_login = 'off';
            }
        }
        $DataSite->save();
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function websiteTheme(Request $request)
    {
        $DataSite = SiteData::where('domain', request()->getHost())->first();
        foreach ($request->only(['logo', 'logo_mini', 'favicon', 'image_seo']) as $key => $value) {
            if ($key != '_token') {
                $DataSite->$key = $value;
            }
        }
        $DataSite->save();
        return redirect()->back()->with('success', 'Updated successfully');
    }

    public function sitePartner(Request $request)
    {
        $DataSite = SiteData::where('domain', request()->getHost())->first();
        foreach ($request->only(['partner1', 'partner2', 'partner3']) as $key => $value) {
            if ($key != '_token') {
                $DataSite->$key = $value;
            }
        }
        $DataSite->save();
        return redirect()->back()->with('success', 'Updated successfully');
    }


    public function userEdit($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255',
            'username' => 'string|max:255',
            'balance' => 'numeric',
            'level' => 'numeric',
            'status' => 'string|in:active,banner',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $user = User::where('domain', getDomain())->where('id', $id)->first();
            if ($user) {
                foreach ($request->only(['name', 'email', 'username', 'balance', 'level', 'status']) as $key => $value) {
                    if ($key != '_token') {
                        $user->$key = $value;
                    }
                }
                $user->save();
                return redirect()->back()->with('success', 'Updated successfully');
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy người dùn1g');
            }
        }
    }

    public function userChangePassword($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|string|min:6|same:password',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $user = User::where('domain', getDomain())->where('id', $id)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('success', 'Updated successfully');
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy người dùng1');
            }
        }
    }

    public function userEditBalance(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'action' => 'required|string|in:plus,minus',
            'balance' => 'required|numeric',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $action = $request->action === 'plus' ? '+' : '-';
            // $user = User::where('domain', getDomain())->where('id', $request->username)->orWhere('username', $request->username)->first();
            $user = User::where('domain', getDomain())
                ->where(function ($query) use ($request) {
                    $query->where('id', $request->username)
                        ->orWhere('username', $request->username);
                })
                ->first();

            if ($user) {
                $balance = $user->balance;
                $user->balance = $request->action === 'plus' ? $user->balance + $request->balance : $user->balance - $request->balance;
                $user->total_recharge = $request->action === 'plus' ? $user->total_recharge + $request->balance : $user->total_recharge - $request->balance;
                $user->save();
                DataHistory::create([
                    'username' => $user->username,
                    'action' => $action,
                    'data' => $request->balance,
                    'old_data' => $balance,
                    'new_data' => $user->balance,
                    'ip' => $request->ip(),
                    'data_json' => json_encode([
                        'username' => $user->username,
                        'action' => $action,
                        'data' => $request->balance,
                        'old_data' => $balance,
                        'new_data' => $user->balance,
                        'ip' => $request->ip(),
                    ]),
                    'description' => "Quản trị viên đã thay đổi số dư tài khoản của bạn",
                    'domain' => getDomain(),
                ]);
                HistoryRecharge::create([
                    'username' => $user->username,
                    'name_bank' => $name ?? 'Không xác định',
                    'type_bank' => 'mbbank',
                    'tranid' => 'BIENDOISODU',
                    'amount' => $request->balance,
                    'promotion' => 0,
                    'real_amount' => $request->balance,
                    'status' => 'Success',
                    'note' => 'Quản trị viên đã thay đổi số dư tài khoản của bạn',
                    'domain' => getDomain(),
                ]);
                return redirect()->back()->with('success', 'Updated successfully');
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy người dùng');
            }
        }
    }

    public function userDelete($id)
    {
        $user = User::where('domain', getDomain())->where('id', $id)->first();
        if ($user) {
            $user->delete();
            return resApi('success', 'Xóa thành viên thành công');
        } else {
            return resApi('error', 'Không tìm thấy người dùng');
        }
    }

    public function notificationModal(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'notice-modal' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $DataSite = SiteData::where('domain', getDomain())->first();
            $DataSite->notice = $request->input('notice-modal');
            $DataSite->save();
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function notification(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'notice' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {

            // class random primary, success, warning, danger, info
            $class = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $class = $class[rand(0, 4)];

            Notification::create([
                'name' => $request->name,
                'content' => $request->notice,
                'domain' => getDomain(),
                'class' => $class,
            ]);

            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function newsannouncementModal(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $randClass = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $randClass = $randClass[rand(0, 4)];
            NewsAnnouncement::create([
                'name' => $request->name,
                'content' => $request->content,
                'status' => $randClass,
                'domain' => getDomain(),
            ]);
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function newsannouncement(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'notice' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $randClass = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $randClass = $randClass[rand(0, 4)];
            NewsAnnouncement::create([
                'name' => $request->name,
                'notice' => $request->content,
                'status' => $randClass,
                'domain' => getDomain(),
            ]);
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }


    public function websiteCaptcha(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'secret_key' => 'required',
            'site_key' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {

            // class random primary, success, warning, danger, info
            $class = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $class = $class[rand(0, 4)];
            $DataSite = SiteData::where('domain', getDomain())->first();
            foreach ($request->only(['secret_key', 'site_key']) as $key => $value) {
                if ($key != '_token') {
                    $DataSite->$key = $value;
                }
            }
            $DataSite->save();
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function notificationDelete($id)
    {
        $notification = Notification::where('domain', getDomain())->where('id', $id)->first();
        if ($notification) {
            $notification->delete();
            return resApi('success', 'Xóa thông báo thành công');
        } else {
            return resApi('error', 'Không tìm thấy thông báo');
        }
    }

    public function newsannouncementDelete($id)
    {
        $newsannouncement = NewsAnnouncement::where('domain', getDomain())->where('id', $id)->first();
        if ($newsannouncement) {
            $newsannouncement->delete();
            return resApi('success', 'Xóa thông báo thành công');
        } else {
            return resApi('error', 'Không tìm thấy thông báo');
        }
    }

    public function activity(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $randClass = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $randClass = $randClass[rand(0, 4)];
            Activities::create([
                'name' => $request->name,
                'content' => $request->content,
                'status' => $randClass,
                'domain' => getDomain(),
            ]);
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }

    public function activitysystem(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $randClass = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $randClass = $randClass[rand(0, 4)];
            Activitiessystem::create([
                'name' => $request->name,
                'content' => $request->content,
                'status' => $randClass,
                'domain' => getDomain(),
            ]);
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }
    public function rechargeadd(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'namebank' => 'required|string',
            'nametk' => 'required|string',
            'sotaikhoan' => 'required|string',
            'logo' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $randClass = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $randClass = $randClass[rand(0, count($randClass) - 1)];

            // Lấy giá trị code_tranfer từ DataSite cho domain hiện tại
            $dataSite = SiteData::where('domain', getDomain())->first();
            $code_tranfer = $dataSite ? $dataSite->code_tranfer : ''; // Lấy giá trị hoặc đặt mặc định nếu không tìm thấy

            // Tạo URL mã QR
            if (strtolower($request->namebank) == 'momo') {
                // Sử dụng dịch vụ QR Server cho Momo
                $qr_code_url = "https://api.qrserver.com/v1/create-qr-code?size=200x200&cht=qr&data=2|99|" . $request->sotaikhoan . "|||0|0|0|" . $code_tranfer . "|transfer_myqr";
            } else {
                // Sử dụng dịch vụ VietQR cho các ngân hàng khác
                $qr_code_url = "https://api.vietqr.io/" . strtolower($request->namebank) . "/" . $request->sotaikhoan . "/0/" . $code_tranfer . "?amount=10000&memo=";
            }

            // Tạo bản ghi trong cơ sở dữ liệu
            AccountRecharge::create([
                'type' => $request->namebank,
                'account_name' => $request->nametk,
                'account' => $request->nametk,
                'account_number' => $request->sotaikhoan,
                'password' => 'no',
                'api_token' => 'no',
                'logo' => $request->logo,
                'qr_code' => $qr_code_url,
                'domain' => getDomain(),
            ]);

            return redirect()->back()->with('success', 'Account added successfully');
        }
    }

    public function Payments(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'namebank' => 'required|string',
            'nametk' => 'required|string',
            'sotaikhoan' => 'required|string',
            'logo' => 'required|url', // Đảm bảo rằng logo là URL hợp lệ
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            // Chọn một lớp màu ngẫu nhiên từ danh sách (nếu cần)
            $randClass = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
            $randClass = $randClass[array_rand($randClass)];

            // Lấy giá trị code_tranfer từ DataSite cho domain hiện tại
            $dataSite = SiteData::where('domain', getDomain())->first();
            $code_tranfer = $dataSite ? $dataSite->code_tranfer : ''; // Lấy giá trị hoặc đặt mặc định nếu không tìm thấy

            // Tạo bản ghi mới trong cơ sở dữ liệu
            Payments::create([
                'type' => $request->namebank,
                'account_name' => $request->nametk,
                'account_number' => $request->sotaikhoan,
                'logo' => $request->logo,
                'qr_code' => $request->qr_code ?? '', // Đảm bảo trường qr_code không bị bỏ trống
                'domain' => getDomain(),
            ]);

            return redirect()->back()->with('success', 'Account added successfully');
        }
    }



    public function activityDelete($id)
    {
        $activity = Activities::where('domain', getDomain())->where('id', $id)->first();
        if ($activity) {
            $activity->delete();
            return resApi('success', 'Xóa hoạt động thành công');
        } else {
            return resApi('error', 'Không tìm thấy hoạt động');
        }
    }

    public function activitysystemDelete($id)
    {
        $activitysystem = Activitiessystem::where('domain', getDomain())->where('id', $id)->first();
        if ($activitysystem) {
            $activitysystem->delete();
            return resApi('success', 'Xóa hoạt động thành công');
        } else {
            return resApi('error', 'Không tìm thấy hoạt động');
        }
    }

    public function rechargeCard(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'partner_key' => 'required|string',
            'partner_id' => 'required|string',

            'card_discount' => 'required|numeric'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {

            $DataSite = SiteData::where('domain', getDomain())->first();
            foreach ($request->only(['partner_id', 'partner_key', 'card_discount']) as $key => $value) {
                if ($key != '_token') {
                    $DataSite->$key = $value;
                }
            }
            $DataSite->save();
            return redirect()->back()->with('success', 'Updated successfully');
        }
    }
    public function rechargeConfig(Request $request)
    {


        $valid = Validator::make($request->all(), [
            'type' => 'required|string|in:mbbank,vietcombank,momo,acb',

        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $account_recharge = AccountRecharge::where('domain', getDomain())->where('type', $request->type)->first();
            if ($account_recharge) {


                $account_recharge->account_name =  $request->name;
                $account_recharge->api_token =  $request->api_token;
                $account_recharge->account_number =  $request->stk;
                $account_recharge->save();
                return resApi('success', 'Updated successfully');
            } else {
                switch ($request->type) {
                    case 'mbbank':
                        $logo = '/assets/images/bank/mbb.png';
                        $qr = "https://img.vietqr.io/image/" . 'mbbank-' . $request->stk . '-compact2.jpg?amount=10000&accountName=' . $request->name;
                        break;
                    case 'vietcombank':
                        $bank = 'Vietcombank';
                        $logo = '/assets/images/bank/vcb.png';
                        $qr = 'https://img.vietqr.io/image/vietcombank-' . $request->stk . '-compact2.jpg?amount=10000&accountName=' . $request->name;
                        break;
                    case 'acb':
                        $bank = 'acb';
                        $logo = '/assets/images/bank/acb.png';
                        $qr = "https://apiqr.web2m.com/api/generate/ACB/" . $request->stk . "/" . $request->name . "?amount=10000&memo=";
                        break;
                    case 'momo':
                        $bank = 'Momo';
                        $logo = '/assets/images/bank/momo.png';
                        $qr = "https://chart.googleapis.com/chart?chs=480x480&cht=qr&choe=UTF-8&chl=2|99|" . $request->stk . "|%3C?=" . $request->name . "?%3E|trumsubngon.vn@gmail.com|0|0|0|";
                        break;
                }

                AccountRecharge::create([
                    'type' => $request->type,
                    'account_name' => $request->name,
                    'account' => $request->account,
                    'account_number' => $request->stk,
                    'password' => $request->password,
                    'api_token' => $request->api_token,
                    'logo' => $logo,
                    'qr_code' => $qr,
                    'domain' => getDomain(),
                ]);
                return resApi('success', 'Updated successfully');
            }
        }
    }

    public function rechargeDelete($id)
    {
        $account_recharge = AccountRecharge::where('domain', getDomain())->where('id', $id)->first();
        if ($account_recharge) {
            $account_recharge->delete();
            return redirect()->back()->with('success', 'Xóa ngân hàng thành công');
        } else {
            return resApi('error', 'Không tìm thấy tài khoản');
        }
    }

    public function rechargePromotion(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'action' => 'required|string|in:show,hide',
            'promotion' => 'required|numeric',
            'start_promotion' => 'required',
            'end_promotion' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $dataSite = SiteData::where('domain', getDomain())->first();
            if ($dataSite) {
                $dataSite->update([
                    'recharge_promotion' => $request->promotion,
                    'start_promotion' => $request->start_promotion,
                    'end_promotion' => $request->end_promotion,
                    'show_promotion' => $request->action,
                ]);
                return redirect()->back()->with('success', 'Updated successfully');
            } else {
                return redirect()->back()->with('error', 'Lỗi mong muốn không sảy ra');
            }
        }
    }

    public function configTelegram(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'telegram_bot' => 'required|string|url',
            'telegram_token' => 'required|string',
            'telegram_chat_id' => 'required|numeric',
            'telegram_token_tb' => 'required|string',
            'balance_telegram' => 'required|numeric',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first());
        } else {
            $dataSite = SiteData::where('domain', getDomain())->first();
            if ($dataSite) {

                $dataSite->update([
                    'telegram_bot' => $request->telegram_bot,
                    'telegram_token' => $request->telegram_token,
                    'telegram_token_tb' => $request->telegram_token_tb,
                    'telegram_chat_id' => $request->telegram_chat_id,
                    'balance_telegram' => $request->balance_telegram,
                ]);

                if (empty($dataSite->telegram_callback)) {
                    $tele = new TelegramCustomController();
                    $dta = $tele->setWebhook();
                    // get id bot
                    // $bot = $tele->getMe();
                    // $bot_id = $bot['result']['id'];

                    if ($dta) {
                        $dataSite->update([
                            'telegram_callback' => route('callback.telegram.v1'),
                            // 'telegram_chat_id' => $bot_id,
                        ]);
                    }
                }
                return redirect()->back()->with('success', 'Updated successfully');
            } else {
                return redirect()->back()->with('error', 'Lỗi mong muốn không sảy ra');
            }
        }
    }
    public function serverAutoEdit(Request $request)
    {


        $valid = Validator::make($request->all(), [

            'type' => 'required|string',
            'price' => 'required|numeric',

        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {

            $server_parent = ServerService::where('domain', getDomain())->get();
            $count = 0;
            foreach ($server_parent as $server) {
                $price = $server->price;
                $price_collaborator = $server->price_collaborator;
                $price_agency = $server->price_agency;
                $price_distributor = $server->price_distributor;

                switch ($request->type) {

                    case 'percent':
                        $price = $price + ($price * $request->price / 100);
                        $price_collaborator = $price_collaborator + ($price_collaborator * $request->price / 100);
                        $price_agency = $price_agency + ($price_agency * $request->price / 100);
                        $price_distributor = $price_distributor + ($price_distributor * $request->price / 100);
                        break;
                    case 'add':
                        $price = $price + $request->price;
                        $price_collaborator = $price_collaborator + $request->price;
                        $price_agency = $price_agency + $request->price;
                        $price_distributor = $price_distributor + $request->price;
                        break;
                    default:
                        $price = $price;
                        $price_collaborator = $price_collaborator;
                        $price_agency = $price_agency;
                        $price_distributor = $price_distributor;
                        break;
                }


                $check_server = ServerService::where('domain', getDomain())->where('social_id', $server->social_id)->where('service_id', $server->service_id)->where('server', $server->server)->first();
                if ($check_server) {
                    $check_server->update([
                        'price' => $price,
                        'price_collaborator' => $price_collaborator,
                        'price_agency' => $price_agency,
                        'price_distributor' => $price_distributor,
                    ]);
                }
                $count++;
            }


            return resApi('success', 'Updated successfully ' . $count . ' dịch vụ');
        }
    }

    public function serverAutoCreate(Request $request)
    {
        if (getDomain() != env('PARENT_SITE')) {

            $valid = Validator::make($request->all(), [
                'action' => 'required|string|in:update,add',
                'type' => 'required|string',
                'price' => 'required|numeric',
            ]);

            if ($valid->fails()) {
                return resApi('error', $valid->errors()->first());
            } else {
                $server_parent = ServerService::where('domain', env('PARENT_SITE'))->get();
                $count = 0;
                foreach ($server_parent as $server) {
                    $price = $server->price;
                    $price_collaborator = $server->price_collaborator;
                    $price_agency = $server->price_agency;
                    $price_distributor = $server->price_distributor;
                    $admin = User::where('username', DataSite('username_web'))->where('domain', env('PARENT_SITE'))->first();
                    // switch ($admin->level) {
                    //     case 1:
                    //         $price = $price;
                    //         break;
                    //     case 2:
                    //         $price = $price_collaborator;
                    //         break;
                    //     case 3:
                    //         $price = $price_agency;
                    //         break;
                    //     case 4:
                    //         $price = $price_distributor;
                    //         break;
                    //     default:
                    //         $price = 0;
                    //         break;
                    // }

                    $check_server = ServerService::where('domain', getDomain())->where('social_id', $server->social_id)->where('service_id', $server->service_id)->first();
                    if ($request->action == 'update') {
                        if ($check_server) {
                            switch ($request->type) {
                                case 'default':
                                    $price = $price;
                                    $price_collaborator = $price_collaborator;
                                    $price_agency = $price_agency;
                                    $price_distributor = $price_distributor;
                                    break;
                                case 'percent':
                                    // giá thành viên tăng % theo mỗi cấp bậc
                                    $price = $price + ($price * $request->price / 100);
                                    $price_collaborator = $price_collaborator + ($price_collaborator * $request->price / 100);
                                    $price_agency = $price_agency + ($price_agency * $request->price / 100);
                                    $price_distributor = $price_distributor + ($price_distributor * $request->price / 100);

                                    break;
                                case 'add':
                                    $price = $price + $request->price;
                                    $price_collaborator = $price_collaborator + $request->price;
                                    $price_agency = $price_agency + $request->price;
                                    $price_distributor = $price_distributor + $request->price;
                                    break;
                                default:
                                    $price = $price;
                                    break;
                            }
                            $check_server->update([
                                'actual_price' => $server->price,
                                'status' => $server->status,
                                'server' => $server->server,
                                'price' => $price,
                                'price_collaborator' => $price_collaborator,
                                'price_agency' => $price_agency,
                                'price_distributor' => $price_distributor,
                                'actual_service' => $server->actual_service,
                                'actual_server' => $server->actual_server,
                                'actual_path' => $server->actual_path,
                            ]);
                        }
                        $count++;
                    } elseif ($request->action == 'add') {
                        switch ($request->type) {
                            case 'default':
                                $price = $price;
                                $price_collaborator = $price_collaborator;
                                $price_agency = $price_agency;
                                $price_distributor = $price_distributor;
                                break;
                            case 'percent':
                                $price = $price + ($price * $request->price / 100);
                                $price_collaborator = $price_collaborator + ($price_collaborator * $request->price / 100);
                                $price_agency = $price_agency + ($price_agency * $request->price / 100);
                                $price_distributor = $price_distributor + ($price_distributor * $request->price / 100);
                                break;
                            case 'add':
                                $price = $price + $request->price;
                                $price_collaborator = $price_collaborator + $request->price;
                                $price_agency = $price_agency + $request->price;
                                $price_distributor = $price_distributor + $request->price;
                                break;
                            default:
                                $price = $price;
                                break;
                        }
                        $check_server = ServerService::where('domain', getDomain())->where('social_id', $server->social_id)->where('service_id', $server->service_id)->where('server', $server->server)->first();
                        if ($check_server) {
                        } else {
                            ServerService::create([
                                'name' => $server->name,
                                'social_id' => $server->social_id,
                                'service_id' => $server->service_id,
                                'server' => $server->server,
                                'price' => $price,
                                'price_collaborator' => $price_collaborator,
                                'price_agency' => $price_agency,
                                'price_distributor' => $price_distributor,
                                'min' => $server->min,
                                'max' => $server->max,
                                'title' => $server->title,
                                'description' => $server->description,
                                'status' => $server->status,
                                'actual_price' => $server->price,
                                'actual_service' => $server->actual_service,
                                'actual_server' => $server->actual_server,
                                'actual_path' => $server->actual_path,
                                'action' => $server->action,
                                'domain' => getDomain(),
                            ]);
                        }
                        $count++;
                    }
                }

                if ($request->action == 'update') {
                    return resApi('success', 'Updated successfully ' . $count . ' dịch vụ');
                } elseif ($request->action == 'add') {
                    return resApi('success', 'Thêm thành công ' . $count . ' dịch vụ');
                } else {
                    return resApi('error', 'Dữ liệu không hợp lệ');
                }
            }
        } else {
            return abort(404);
        }
    }

    public function websiteChildActive(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'domain' => 'required|string',
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $data = SiteCon::where('domain_name', $request->domain)->first();
            if ($data) {
                $clf = new CloudflareCustomController();
                if ($data->status == 'Pending_Cloudflare') {
                    if ($data->status_cloudflare == 'pending') {
                        $rs = $clf->recordDomain($data->zone_id);
                        // $rs = $clf->createDns($data->zone_id);
                        // $id = $rs['result'][0]['id'];
                        // die();
                        if ($rs['success'] == true) {
                            // if ($rs['result'][0]['type'] == 'A') {
                            //     $rs = $clf->updateDns($data->zone_id, $rs['result'][0]['id']);
                            //     var_dump($rs);
                            //     die();
                            //     if ($rs['success'] == true) {
                            //         $data->update([
                            //             'status_cloudflare' => 'active',
                            //         ]);
                            //         return resApi('success', 'Cập nhật record thành công');
                            //     } else {
                            //         return resApi('error', 'Cập nhật record thất bại');
                            //     }
                            // } else {
                            // }
                            $rs = $clf->createDns($data->zone_id);
                            if ($rs['success'] == true) {
                                $data->update([
                                    'status_cloudflare' => 'active',
                                ]);
                                $cpanel = new CpanelCustomController();
                                $cpanel->createDomain($data->domain_name);
                                return resApi('success', 'Tạo record thành công');
                            } else {
                                if ($rs['errors'][0]['code'] == 81057) {
                                    $data->update([
                                        'status_cloudflare' => 'active',
                                    ]);
                                    $cpanel = new CpanelCustomController();
                                    $cpanel->createDomain($data->domain_name);
                                    return resApi('success', 'Tạo record thành công');
                                } else {
                                    return resApi('error', $rs['errors'][0]['message']);
                                }
                            }
                        }
                    } else {


                        $data->update([
                            'status' => 'Active',
                        ]);


                        return resApi('success', 'Duyệt cloudflare thành công');
                    }
                } else {
                    $site = SiteData::where('domain', $request->domain)->first();
                    $rs = $clf->addDomain($request->domain);
                    // var_dump($rs);
                    if ($rs['success'] == true) {
                        $zone_id = $rs['result']['id'];
                        $status = $rs['result']['status'];
                        $data->update([
                            'zone_id' => $zone_id,
                            'status_cloudflare' => $status,
                        ]);
                        if ($site) {
                            $site->update([
                                'status' => 'Pending',
                            ]);
                        } else {
                            $user = User::where('username', $data->username)->first();
                            if ($user) {
                                SiteData::create([
                                    'namesite' => getDomain(),
                                    'is_admin' => json_encode($user->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                                    'token_web' => $user->api_token,
                                    'username_web' => 'null',
                                    'status' => 'Pending',
                                    'domain' => $request->domain,
                                ]);
                            }
                            $data->update([
                                'status' => 'Pending_Cloudflare',
                            ]);
                        }
                        return resApi('success', 'Kích hoạt thành công');
                    } else {
                        if ($rs['errors'][0]['code'] == 1061) {
                            $site = SiteData::where('domain', $request->domain)->first();
                            $data1 = $clf->findDomain($request->domain);
                            $zone_id =  $data1['id'];
                            $data1 = $clf->recordDomain($zone_id);
                            // var_dump($data1);
                            // die(); 
                            if (isset($data1['result'])) {



                                $data->update([
                                    'zone_id' => $zone_id,
                                    'status_cloudflare' => 'pending',
                                ]);
                                if ($site) {
                                    $site->update([
                                        'status' => 'Pending',
                                    ]);
                                } else {
                                    $user = User::where('username', $data->username)->first();
                                    if ($user) {
                                        SiteData::create([
                                            'namesite' => getDomain(),
                                            'is_admin' => json_encode($user->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                                            'token_web' => $user->api_token,
                                            'username_web' => 'null',
                                            'status' => 'Pending',
                                            'domain' => $request->domain,
                                        ]);
                                    }
                                    $data->update([
                                        'status' => 'Pending_Cloudflare',
                                    ]);
                                }
                                return resApi('success', 'Kích hoạt thành công');
                            }

                            // if ($site) {
                            //     $site->update([
                            //         'status' => 'Pending',
                            //     ]);
                            // } else {
                            //     $user = User::where('username', $data->username)->first();
                            //     if ($user) {
                            //         SiteData::create([
                            //             'namesite' => getDomain(),
                            //             'is_admin' => json_encode($user->only(['id', 'name', 'username', 'email', 'position', 'api_token', 'domain'])),
                            //             'token_web' => $user->api_token,
                            //             'username_web' => 'null',
                            //             'status' => 'Pending',
                            //             'domain' => $request->domain,
                            //         ]);
                            //     }
                            //     $data->update([
                            //         'status' => 'Pending_Cloudflare',
                            //     ]);
                            // }
                            // return resApi('success', 'Kích hoạt thành công');


                        }
                    }
                }
            } else {
                return resApi('error', 'Không tìm thấy website');
            }
        }
    }

    public function listAction($action, Request $request)
    {
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $search = $request->search['value'] ?? '';
        $order = $request->order[0] ?? [];
        $dir = $request->order[0]['dir'] ?? 'DESC';

        if ($action == 'list-user') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = User::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('balance', 'like', "%$search%")
                        ->orWhere('total_recharge', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = User::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = User::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {
                $item->level = level($item->level);
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'history-notification') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = Notification::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Notification::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Notification::where('domain', getDomain())->count();
            }

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'history-newsannouncement') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = NewsAnnouncement::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = NewsAnnouncement::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = NewsAnnouncement::where('domain', getDomain())->count();
            }

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'history-activity') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = Activities::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Activities::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Activities::where('domain', getDomain())->count();
            }

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'history-activitysystem') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = Activitiessystem::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('content', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Activitiessystem::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Activitiessystem::where('domain', getDomain())->count();
            }

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'list-social') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = ServiceSocial::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('slug', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = ServiceSocial::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = ServiceSocial::where('domain', getDomain())->count();
            }

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'list-service') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = Service::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('slug', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Service::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Service::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {
                $social = ServiceSocial::where('domain', getDomain())->where('slug', $item->service_social)->first();
                $item->social = $social->name ?? '';
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'list-server') {
            if (!empty($search)) {
                $data = ServerService::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('server', 'like', "%$search%")
                        ->orWhere('price', 'like', "%$search%")
                        ->orWhere('price_collaborator', 'like', "%$search%")
                        ->orWhere('price_agency', 'like', "%$search%")
                        ->orWhere('price_distributor', 'like', "%$search%")
                        ->orWhere('min', 'like', "%$search%")
                        ->orWhere('max', 'like', "%$search%")
                        ->orWhere('title', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = ServerService::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = ServerService::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {
                $item->service = Service::where('domain', env('PARENT_SITE'))->where('id', $item->service_id)->first()->name ?? '';
                if (getDomain() != env('PARENT_SITE')) {
                    unset($item->actual_path);
                    // unset($item->actual_price);
                    unset($item->actual_server);
                    unset($item->actual_service);
                }
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
        if ($action == 'history-user-today') {
            if (!empty($search)) {
                $data = DataHistory::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")->whereDate('created_at', Carbon::today())
                        ->orWhere('action', 'like', "%$search%")
                        ->orWhere('data', 'like', "%$search%")
                        ->orWhere('old_data', 'like', "%$search%")
                        ->orWhere('new_data', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = DataHistory::where('domain', getDomain())->whereDate('created_at', Carbon::today())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = DataHistory::where('domain', getDomain())->whereDate('created_at', Carbon::today())->count();
            }
            $data = $data->map(function ($item) {
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
        if ($action == 'history-login-today') {
            if (!empty($search)) {
                $data = HistoryLogin::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")->whereDate('created_at', Carbon::today())
                        ->orWhere('action', 'like', "%$search%")
                        ->orWhere('dangnhap', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = HistoryLogin::where('domain', getDomain())->whereDate('created_at', Carbon::today())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = HistoryLogin::where('domain', getDomain())->whereDate('created_at', Carbon::today())->count();
            }
            $data = $data->map(function ($item) {
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
        if ($action == 'history-user') {
            if (!empty($search)) {
                $data = DataHistory::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('action', 'like', "%$search%")
                        ->orWhere('data', 'like', "%$search%")
                        ->orWhere('old_data', 'like', "%$search%")
                        ->orWhere('new_data', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = DataHistory::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = DataHistory::where('domain', getDomain())->count();
            }
            $data = $data->map(function ($item) {
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'list-order') {
            if (!empty($search)) {
                $data = Orders::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")


                        ->orWhere('quantity', 'like', "%$search%")
                        ->orWhere('total_payment', 'like', "%$search%")
                        ->orWhere('order_link', 'like', "%$search%")
                        ->orWhere('order_code', 'like', "%$search%")
                        ->orWhere('start', 'like', "%$search%")
                        ->orWhere('buff', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Orders::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Orders::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {
                $item->status_order = statusOrder($item->status);
                if (getDomain() != env('PARENT_SITE')) {
                    unset($item->actual_service);
                    unset($item->actual_path);
                    unset($item->actual_server);
                }
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
        if ($action == 'order-tay') {
            if (!empty($search)) {
                $data = Orders::where('domain', getDomain())->where('status', 'Pending')->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('server_service', 'like', "%$search%")
                        ->orWhere('price', 'like', "%$search%")
                        ->orWhere('quantity', 'like', "%$search%")
                        ->orWhere('total_payment', 'like', "%$search%")
                        ->orWhere('order_link', 'like', "%$search%")
                        ->orWhere('order_code', 'like', "%$search%")
                        ->orWhere('start', 'like', "%$search%")
                        ->orWhere('buff', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Orders::where('domain', getDomain())->where('status', 'Pending')->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Orders::where('domain', getDomain())->where('status', 'Pending')->count();
            }

            $data = $data->map(function ($item) {
                $item->status_order = statusOrder($item->status);
                if (getDomain() != env('PARENT_SITE')) {
                    unset($item->actual_service);
                    unset($item->actual_path);
                    unset($item->actual_server);
                }
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }


        if ($action == 'list-recharge') {
            $domain = getDomain();

            // Tìm kiếm và phân trang cho AccountRecharge
            $accountRechargeQuery = AccountRecharge::where('domain', $domain)
                ->where(function ($query) use ($search) {
                    $query->where('type', 'like', "%$search%")
                        ->orWhere('account_name', 'like', "%$search%")
                        ->orWhere('account_number', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                });

            // Tìm kiếm và phân trang cho Payments
            $paymentsQuery = Payments::where('domain', $domain)
                ->where(function ($query) use ($search) {
                    $query->where('type', 'like', "%$search%")
                        ->orWhere('account_name', 'like', "%$search%")
                        ->orWhere('account_number', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                });

            // Lấy dữ liệu và tổng số bản ghi
            $accountRechargeData = $accountRechargeQuery->orderBy('id', $dir)->offset($start)->limit($length)->get();
            $paymentsData = $paymentsQuery->orderBy('id', $dir)->offset($start)->limit($length)->get();

            $totalAccountRecharge = $accountRechargeQuery->count();
            $totalPayments = $paymentsQuery->count();

            // Kết hợp dữ liệu từ hai bảng
            $data = $accountRechargeData->merge($paymentsData)->sortBy('id');

            return response()->json([
                'data' => $data->values(),
                'recordsTotal' => $totalAccountRecharge + $totalPayments,
                'recordsFiltered' => $totalAccountRecharge + $totalPayments
            ]);
        }


        if ($action == 'history-recharge') {
            if (!empty($search)) {
                $data = HistoryRecharge::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('name_bank', 'like', "%$search%")
                        ->orWhere('type_bank', 'like', "%$search%")
                        ->orWhere('tranid', 'like', "%$search%")
                        ->orWhere('amount', 'like', "%$search%")
                        ->orWhere('promotion', 'like', "%$search%")
                        ->orWhere('real_amount', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = HistoryRecharge::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = HistoryRecharge::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {

                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
        if ($action == 'list-chuyenmuc') {
            if (!empty($search)) {
                //search sử dụng function match trong mysql
                $data = Category::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%')
                        ->orWhere('created_at', 'like', '%' . $search . '%');
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Category::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Category::where('domain', getDomain())->count();
            }

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'list-tainguyen') {
            if (!empty($search)) {
                $data = Tainguyen::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('id', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%')
                        ->orWhere('price_collaborator', 'like', '%' . $search . '%')
                        ->orWhere('price_agency', 'like', '%' . $search . '%')
                        ->orWhere('price_distributor', 'like', '%' . $search . '%')

                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('created_at', 'like', '%' . $search . '%');
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = $data->count();
            } else {
                $data = Tainguyen::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = Tainguyen::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {


                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
        if ($action == 'history-card') {
            if (!empty($search)) {
                $data = HistoryCard::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('card_type', 'like', "%$search%")
                        ->orWhere('card_amount', 'like', "%$search%")
                        ->orWhere('card_serial', 'like', "%$search%")
                        ->orWhere('card_code', 'like', "%$search%")
                        ->orWhere('status', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
            } else {
                $data = HistoryCard::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = HistoryCard::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {
                $item->status = statusCard($item->status);
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }

        if ($action == 'list-site') {
            if (!empty($search)) {
                $data = SiteCon::where('domain', getDomain())->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%$search%")
                        ->orWhere('domain_name', 'like', "%$search%")
                        ->orWhere('created_at', 'like', "%$search%");
                })->orderBy('id', $dir)->offset($start)->limit($length)->get();
            } else {
                $data = SiteCon::where('domain', getDomain())->orderBy('id', $dir)->offset($start)->limit($length)->get();
                $total = SiteCon::where('domain', getDomain())->count();
            }

            $data = $data->map(function ($item) {
                $item->status = $item->status;
                return $item;
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $total,
                'recordsFiltered' => $total
            ]);
        }
    }

    public function deleteData($type, Request $request)
    {
        if ($type == 'delete-site') {
            $valid = Validator::make($request->all(), [
                'domain' => 'required'
            ]);

            if ($valid->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $valid->errors()->first()
                ]);
            } else {
                $check = SiteCon::where('domain_name', $request->domain)->first();
                if ($check) {
                    $site = SiteData::where('domain', '!=', env('PARENT_SITE'))->where('domain', $request->domain)->first();
                    if ($site) {
                        $site->delete();
                    }
                    if ($check->status_cloudflare == 'active') {
                        $clf = new CloudflareCustomController();
                        $clf->deleteDomain($request->domain);
                        $cpanel = new CpanelCustomController();
                        $cpanel->deleteDomain($request->domain);
                    }

                    $check->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Xóa tên miền thành công'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Không tìm thấy tên miền này'
                    ]);
                }
            }
        }
    }
    public function serverDeleteAlls(Request $request)
    {
        $ids = $request->input('ids', []);
    
        // Xóa các mục với ID đã chọn
        $deleted = ServerService::whereIn('id', $ids)->delete();
    
        if ($deleted) {
            return response()->json(['status' => 'success', 'message' => 'Xóa tất cả dịch vụ đã chọn thành công']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Không thể xóa dịch vụ.']);
        }
    }
    
    public function serverDeleteAll()
    {
        
        $server = ServerService::where('domain', getDomain())->get();
        foreach ($server as $item) {
            $item->delete();
        }
        return redirect()->back()->with('success', 'Xóa tất cả dịch vụ đã chọn thành công');
    }
    public function updateEnv(Request $request)
{
    // Xác thực dữ liệu
    $request->validate([
        'apiV1' => 'nullable|array',
        'apiV2' => 'nullable|array',
    ]);

    $apiV1 = $request->input('apiV1', []);
    $apiV2 = $request->input('apiV2', []);

    // Gộp dữ liệu từ API V1 và API V2
    $envData = array_merge($apiV1, $apiV2);

    try {
        // Cập nhật file .env
        $updated = $this->updateEnvFile($envData);

        if ($updated) {
            // Trả về thông báo cập nhật thành công nếu có thay đổi
            return redirect()->back()->with('success', 'Cập nhật thành công.');
        } else {
            // Nếu không có thay đổi nào, thông báo người dùng
            return redirect()->back()->with('info', 'Không có thay đổi nào được thực hiện.');
        }
    } catch (\Exception $e) {
        // Hiển thị thông báo lỗi
        return redirect()->back()->withErrors(['msg' => 'Lỗi cập nhật: ' . $e->getMessage()]);
    }
}

    private function updateEnvFile(array $data)
{
    $path = base_path('.env');
    $content = file_get_contents($path);
    $updated = false; // Theo dõi trạng thái thay đổi

    foreach ($data as $key => $value) {
        if (!empty($value)) {
            // Tạo pattern kiểm tra sự tồn tại của biến môi trường
            $pattern = "/^{$key}=.*/m";
            if (preg_match($pattern, $content)) {
                // Nếu biến đã tồn tại, kiểm tra xem giá trị có thay đổi không
                $existingValue = preg_replace("/^{$key}=(.*)/m", '$1', $content);
                if ($existingValue !== $value) {
                    // Thay thế giá trị mới vào tệp
                    $content = preg_replace($pattern, "{$key}={$value}", $content);
                    $updated = true; // Đánh dấu đã cập nhật
                }
            } else {
                // Nếu biến chưa tồn tại, thêm mới vào cuối tệp
                $content .= PHP_EOL . "{$key}={$value}";
                $updated = true; // Đánh dấu đã cập nhật
            }
        }
    }

    // Chỉ ghi vào tệp nếu có thay đổi
    if ($updated) {
        file_put_contents($path, $content);
    }

    return $updated; // Trả về trạng thái cập nhật
}


    //landing page
    public function updateLandingPage(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'landing_page' => 'required|string',
        ]);

        // Lấy dữ liệu từ bảng site_data (nếu không có, tạo mới)
        $siteData = SiteData::first();

        // Kiểm tra nếu tồn tại dữ liệu thì mới cập nhật
        if ($siteData) {
            // Cập nhật giá trị landing page
            $siteData->landing = $request->landing_page;
            $siteData->save();

            // Trả về thông báo thành công
            return redirect()->back()->with('success', 'Cập nhật landing page thành công!');
        }

        // Nếu không tìm thấy dữ liệu, trả về lỗi
        return redirect()->back()->with('error', 'Không tìm thấy dữ liệu để cập nhật!');
    }
    public function websiteEffect(Request $request)
    {
        // Lấy dữ liệu từ request
        $data = $request->all();

        // Tìm SiteData cần cập nhật
        $siteData = SiteData::first(); // Nếu bạn chỉ có một bản ghi, nếu nhiều bản ghi thì cần xác định rõ ràng.

        if ($data['action_type'] === 'update') {
            // Cập nhật giá trị từ form
            $siteData->effect = $data['effect'];
        } elseif ($data['action_type'] === 'reset') {
            // Khôi phục giá trị mặc định
            $siteData->effect = 0;
        }

        // Lưu thay đổi
        $siteData->save();

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
    public function bulkDelete(Request $request)
{
    $ids = $request->input('ids', []);
    
    if (!empty($ids)) {
        ServerService::whereIn('id', $ids)->delete();
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'error', 'message' => 'Không có dịch vụ nào được chọn.'], 400);
}
}
