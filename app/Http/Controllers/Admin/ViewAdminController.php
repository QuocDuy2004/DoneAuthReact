<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataHistory;
use App\Models\AccountRecharge;
use App\Models\HistoryCard;
use App\Models\HistoryRecharge;
use App\Models\Orders;
use App\Models\ServerService;
use App\Models\Service;
use App\Models\ServiceSocial;
use App\Models\User;
use App\Models\SiteData;
use App\Models\NewsAnnouncement;
use App\Models\Tainguyen;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Provider;
use App\Models\Support;
use App\Models\Tickets;
use Google\Service\Dfareporting\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ViewAdminController extends Controller
{
    public function tickets(Request $request, $id = null)
    {
        if ($request->isMethod('post') && $request->has('username') && $request->has('reply')) {
            Tickets::create([
                'username' => $request->username,
                'reply' => $request->reply,
                'parent_id' => $id,
                'domain' => getDomain(),
            ]);
            return redirect()->route('admin.tickets.index')->with('success', 'Phản hồi thành công!');
        }
        $tickets = Tickets::all();
        return view('Admin.Tickets.index', compact('tickets'));
    }

    public function dashboard()
    {
        $currentMonth = Carbon::now()->month;

        $totalUserThisMonth = User::where('domain', getDomain())
            ->whereMonth('created_at', $currentMonth)
            ->count();
        $total_user = User::where('domain', getDomain())->count();
        $total_balance = User::where('domain', getDomain())->sum('balance');
        $total_recharge = User::where('domain', getDomain())->sum('total_recharge');
        $total_order = Orders::where('domain', getDomain())->count();
        $total_user_today = User::where('domain', getDomain())->whereDate('created_at', Carbon::today())->count();
        $total_deduct_today = DataHistory::where('domain', getDomain())->whereDate('created_at', Carbon::today())->where('action', 'Tạo đơn')->sum('data');
        $total_deduct_month = DataHistory::where('domain', getDomain())->whereMonth('created_at', $currentMonth)->where('action', 'Tạo đơn')->sum('data');
        $total_recharge_today = HistoryRecharge::where('domain', getDomain())->whereDate('created_at', Carbon::today())->sum('real_amount') + HistoryCard::where('domain', getDomain())->whereDate('created_at', Carbon::today())->sum('card_real_amount');
        $total_recharge_month = HistoryRecharge::where('domain', getDomain())->whereMonth('created_at', $currentMonth)->sum('real_amount') + HistoryCard::where('domain', getDomain())->whereMonth('created_at', $currentMonth)->sum('card_real_amount');
        $total_order_today = Orders::where('domain', getDomain())->whereDate('created_at', Carbon::today())->count();
        $total_order_month = Orders::where('domain', getDomain())->whereMonth('created_at', $currentMonth)->count();
        // làm thống kê đơn
        $order = Orders::where('domain', getDomain())->get();
        $order_pending_order = Orders::where('domain', getDomain())->where('status', 'PendingOrder')->count();
        $order_processing = Orders::where('domain', getDomain())->where('status', 'Processing')->count();
        $order_active = Orders::where('domain', getDomain())->where('status', 'Active')->count() + $order_processing;
        $order_suspended = Orders::where('domain', getDomain())->where('status', 'Suspended')->count();
        $order_completed = Orders::where('domain', getDomain())->where('status', 'Completed')->count() + Orders::where('domain', getDomain())->where('status', 'Success')->count();
        $order_success = Orders::where('domain', getDomain())->where('status', 'Success')->count();
        $order_failed = Orders::where('domain', getDomain())->where('status', 'Failed')->count();
        $order_cancelled = Orders::where('domain', getDomain())->where('status', 'Cancelled')->count();
        $lai = $total_recharge_month - $total_deduct_month;


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

            $recharge = HistoryRecharge::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
            $orders = Orders::whereBetween('created_at', [$startDate, $endDate])->sum('total_payment');
            $refunded = Orders::where(['status' => 'Refunded'])->whereBetween('created_at', [$startDate, $endDate])->count();
            $canceled = Orders::where(['status' => 'Cancelled'])->whereBetween('created_at', [$startDate, $endDate])->count();

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

        return view('Admin.dashboard', compact('total_user', 'lai', 'total_balance', 'chart', 'total_deduct_month', 'total_recharge', 'total_recharge_month', 'currentMonth', 'total_order_month', 'total_order', 'total_user_today', 'total_deduct_today', 'totalUserThisMonth', 'total_recharge_today', 'total_order_today', 'order', 'order_pending_order', 'order_processing', 'order_active', 'order_suspended', 'order_completed', 'order_success', 'order_failed', 'order_cancelled'));
    }

    public function websiteConfig()
    {
        return view('Admin.Website.Config');
    }

    public function ConfigAuto()
    {
        $envData = $_ENV; // Retrieve all environment variables
        $apiV1 = [];
        $apiV2 = [];

        foreach ($envData as $key => $value) {
            // Skip variables containing 'TELEGRAM' or 'SECURE'
            if (strpos($key, 'TELEGRAM') !== false || strpos($key, 'SECURE') !== false) {
                continue;
            }

            // Check if the key contains '_TOKEN' or starts with 'TOKEN_' and does not contain 'Controller'
            if ((strpos($key, '_TOKEN') !== false || strpos($key, 'TOKEN_') === 0) && strpos($key, 'Controller') === false) {
                $apiV1[$key] = $value;
            }
            // Check if the key contains '_TOKEN' or starts with 'TOKEN_' and contains 'Controller'
            elseif ((strpos($key, '_TOKEN') !== false || strpos($key, 'TOKEN_') === 0) && strpos($key, 'Controller') !== false) {
                $apiV2[$key] = $value;
            }
        }

        // Return the view with categorized environment data
        return view('Admin.Website.ConfigAuto', compact('apiV1', 'apiV2'));
    }

    public function ConfigTheme()
    {
        return view('Admin.Website.ConfigTheme');
    }


    // public function sitePartner()
    // {
    //     return view('Admin.Website.websitePartner');
    // }
    public function ConfigCaptcha()
    {
        return view('Admin.Website.ConfigCaptcha');
    }

    public function userList(Request $request)
    {
        $total_user = User::where('domain', getDomain())->count();
        $total_ctv = User::where('domain', getDomain())->where('level', '2')->count();
        $total_daily = User::where('domain', getDomain())->where('level', '3')->count();
        $total_npp = User::where('domain', getDomain())->where('level', '4')->count();
        $total_qtv = User::where('domain', getDomain())->where('position', 'admin')->count();

        // Check if there's an 'edit' request
        $user = null;
        if ($request->has('edit_id')) {
            $user = User::where('domain', getDomain())->where('id', $request->edit_id)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Không tìm thấy người dùng');
            }
        }

        // Retrieve users for the list
        $users = User::where('domain', getDomain())->get();

        // Return view with both list and optional edit user
        return view('Admin.User.userList', compact('total_user', 'total_ctv', 'total_daily', 'total_npp', 'total_qtv', 'users', 'user'));
    }


    public function orderEdit($id)
    {
        $order = Orders::where('id', $id)->where('domain', getDomain())->first();
        if ($order) {
            return view('Admin.History.orderEdit', compact('order'));
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
        }
    }


    public function userEditBalance()
    {
        return view('Admin.User.userEditBalance');
    }

    public function notification()
    {
        return view('Admin.Notification.notification');
    }

    public function newsannouncement()
    {
        return view('Admin.Notification.newsannouncement');
    }

    public function activity()
    {
        return view('Admin.Activity.activity');
    }

    public function activitysystem()
    {
        return view('Admin.Activity.activitysystem');
    }

    /* SERVICE */
    public function serviceNewSocial()
    {
        if (getDomain() == env('PARENT_SITE')) {
            // Lấy danh sách tất cả các nền tảng xã hội
            $socials = ServiceSocial::where('domain', getDomain())->get();

            return view('Admin.Service.serviceNewSocial', compact('socials'));
        } else {
            return abort(404);
        }
    }

    public function serviceSocialEdit($id)
    {
        if (getDomain() == env('PARENT_SITE')) {
            $social = ServiceSocial::where('domain', getDomain())->where('id', $id)->first();

            if ($social) {
                return view('Admin.Service.serviceSocialEdit', compact('social'));
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
            }
        } else {
            return abort(404);
        }
    }


    public function serviceNew()
    {
        if (getDomain() == env('PARENT_SITE')) {
            $social = ServiceSocial::where('domain', getDomain())->get();
            $services = Service::where('domain', getDomain())->get(); // Đổi từ ServiceSocial sang Service nếu cần

            return view('Admin.Service.serviceNew', compact('social', 'services'));
        } else {
            return abort(404);
        }
    }

    public function serviceEdit($id)
    {
        if (getDomain() == env('PARENT_SITE')) {
            $service = Service::where('id', $id)->where('domain', getDomain())->first();
            if ($service) {
                // Chỉ cần lấy thông tin của dịch vụ cần chỉnh sửa
                $social = ServiceSocial::where('domain', getDomain())->get();
                return view('Admin.Service.serviceEdit', compact('service', 'social'));
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
            }
        } else {
            return abort(404);
        }
    }


    public function serverList()
    {
        if (getDomain() == env('PARENT_SITE')) {
            // Lấy dữ liệu servers và social theo domain
            $servers = ServerService::where('domain', getDomain())->get();
            $social = ServiceSocial::where('domain', getDomain())->get();

            // Lấy dữ liệu providers
            try {
                $providers = Provider::select('url', 'key')->get();
            } catch (\Exception $e) {
                // Xử lý lỗi nếu có
                $providers = [];
            }
 
            // Truyền dữ liệu tới view serverList.blade.php
            return view('Admin.Server.serverList', compact('social', 'servers', 'providers'));
        } 
    }


    public function serverNew()
    {
        if (getDomain() == env('PARENT_SITE')) {
            $social = ServiceSocial::where('domain', getDomain())->get();
            $service = Service::all(); // Thêm dòng này nếu cần truyền biến $service vào view
            return view('Admin.Server.serverNew', compact('social', 'service'));
        } else {
            return abort(404);
        }
    }

    //     public function updateAllServerPrices()
    // {
    //     $server = ServerService::where('domain', getDomain())->get();

    //     return view('Admin.Server.serverPrice', compact('server'));
    // }

    public function tainguyenNewChuyenmuc()
    {
        if (getDomain() != env('PARENT_SITE')) {
            return abort(404);
        }

        // Lấy tất cả các categories
        $resources = Category::where('domain', getDomain())->get();

        return view('Admin.Tainguyen.category', compact('resources'));
    }


    public function tainguyenNewTainguyen()
    {
        if (getDomain() == env('PARENT_SITE')) {
            $tainguyen = Tainguyen::where('domain', getDomain())->get();
            $category = Category::where('domain', getDomain())->get();
            return view('Admin.Tainguyen.tainguyen', compact('category', 'tainguyen'));
        } else {
            return abort(404);
        }
    }



    public function tainguyenNewTainguyenEdit($id)
    {
        if (getDomain() == env('PARENT_SITE')) {
            $social = Tainguyen::where('domain', getDomain())->where('id', $id)->first();
            if ($social) {
                return view('Admin.Tainguyen.tainguyenEdit', compact('social'));
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
            }
        } else {
            return abort(404);
        }
    }
    public function updateAllServerPrices()
    {

        $social = ServiceSocial::where('domain', env('PARENT_SITE'))->get();
        $socialSlugs = $social->pluck('slug')->all();
        $socialid = $social->pluck('id')->all();
        // Use the $socialSlugs array to filter the $service query
        $service = Service::where('domain', env('PARENT_SITE'))->whereIn('service_social', $socialSlugs)->get();
        $service_Id = $service->pluck('id')->all();
        $server = ServerService::where('domain', getDomain())->whereIn('social_id', $socialid)->whereIn('service_id', $service_Id)->get();



        return view('Admin.Server.serverPrice', compact('server', 'social', 'service'));
    }


    public function serverEdit($id)
    {
        $servers = ServerService::where('id', $id)->where('domain', getDomain())->first();

        if ($servers) {
            return view('Admin.Server.serverList', compact('servers'));
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
        }
    }


    public function HistoryOrder(Request $request)
{
    $query = Orders::where('domain', getDomain());

    if ($request->has('status')) {
        $status = $request->input('status');
        if ($status == 'Success') {
            $query->where('status', 'Success');
        } elseif ($status == 'Active') {
            $query->where('status', 'Active');
        }
    }

    $orders = $query->get();
    return view('Admin.History.historyOrder', compact('orders'));
}


    public function HistoryUser()
    {
        return view('Admin.History.historyUser');
    }

    public function rechargeConfig()
    {
        $momo = AccountRecharge::where('domain', getDomain())->where('type', 'momo')->first();
        $mbbank = AccountRecharge::where('domain', getDomain())->where('type', 'mbbank')->first();
        $vietcombank = AccountRecharge::where('domain', getDomain())->where('type', 'vietcombank')->first();
        $acb = AccountRecharge::where('domain', getDomain())->where('type', 'acb')->first();

        return view('Admin.Recharge.config', compact('momo', 'mbbank', 'vietcombank', 'acb'));
    }
    public function rechargeadd()
    {

        return view('Admin.Recharge.add');
    }

    public function HistoryRecharge()
    {
        return view('Admin.History.historyRecharge');
    }

    public function HistoryCard()
    {
        return view('Admin.History.historyCard');
    }

    public function HistoryLogin()
    {
        return view('Admin.History.historyLogin');
    }

    public function configTelegram()
    {
        return view('Admin.Config.configTelegram');
    }

    public function ConfigChildList()
    {
        return view('Admin.Website.ConfigChildList');
    }

    public function currencyManager(Request $request)
    {
        $currencies = Currency::all();
        $client = new Client();
        $apiKey = 'efbb7163444e6bb8819e6dbf';
        $apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/latest/USD"; // USD as base currency

        try {
            // Make an API request
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody()->getContents(), true);
            $rates = $data['conversion_rates'];  // Fetch conversion rates from API


            $fromCurrency = $request->input('from_currency');
            $amount = $request->input('amount');
            $currency_position = $request->input('currency_position', 'left', 'right'); // Default currency_position
            $status = $request->input('status', 'show'); // Default status
            $decimal = (int) $request->input('currency_decimal', 2);
            $currency_name = $request->input('currency_name');

            $conversionResults = [];
            // Currency symbols mapping
            $currency_symbols = [
                'AED' => 'د.إ',  // United Arab Emirates Dirham
                'AFN' => '؋',   // Afghan Afghani
                'ALL' => 'L',   // Albanian Lek
                'AMD' => '֏',   // Armenian Dram
                'ANG' => 'ƒ',   // Netherlands Antillean Guilder
                'AOA' => 'Kz',  // Angolan Kwanza
                'ARS' => '$',   // Argentine Peso
                'AUD' => 'A$',  // Australian Dollar
                'AWG' => 'ƒ',   // Aruban Florin
                'AZN' => '₼',   // Azerbaijani Manat
                'BAM' => 'KM',  // Bosnia and Herzegovina Convertible Mark
                'BBD' => '$',   // Barbadian Dollar
                'BDT' => '৳',   // Bangladeshi Taka
                'BGN' => 'лв', // Bulgarian Lev
                'BHD' => '.د.ب', // Bahraini Dinar
                'BIF' => 'Fr',  // Burundian Franc
                'BMD' => '$',   // Bermudian Dollar
                'BND' => '$',   // Brunei Dollar
                'BOB' => 'Bs.', // Bolivian Boliviano
                'BRL' => 'R$',  // Brazilian Real
                'BSD' => '$',   // Bahamian Dollar
                'BTN' => 'Nu.', // Bhutanese Ngultrum
                'BWP' => 'P',   // Botswanan Pula
                'BYN' => 'Br',  // Belarusian Ruble
                'BZD' => 'BZ$', // Belize Dollar
                'CAD' => 'C$',  // Canadian Dollar
                'CDF' => 'Fr',  // Congolese Franc
                'CHF' => 'CHF', // Swiss Franc
                'CLP' => '$',   // Chilean Peso
                'CNY' => '¥',   // Chinese Yuan
                'COP' => '$',   // Colombian Peso
                'CRC' => '₡',   // Costa Rican Colón
                'CUP' => '$',   // Cuban Peso
                'CVE' => '$',   // Cape Verdean Escudo
                'CZK' => 'Kč',  // Czech Koruna
                'DJF' => 'Fdj', // Djiboutian Franc
                'DKK' => 'kr',  // Danish Krone
                'DOP' => 'RD$', // Dominican Peso
                'DZD' => 'د.ج', // Algerian Dinar
                'EGP' => '£',   // Egyptian Pound
                'ERN' => 'Nfk', // Eritrean Nakfa
                'ETB' => 'Br',  // Ethiopian Birr
                'EUR' => '€',   // Euro
                'FJD' => '$',   // Fijian Dollar
                'FKP' => '£',   // Falkland Islands Pound
                'FOK' => 'kr',  // Faroese Króna
                'GBP' => '£',   // British Pound Sterling
                'GEL' => '₾',   // Georgian Lari
                'GHS' => '₵',   // Ghanaian Cedi
                'GIP' => '£',   // Gibraltar Pound
                'GMD' => 'D',   // Gambian Dalasi
                'GNF' => 'Fr',  // Guinean Franc
                'GTQ' => 'Q',   // Guatemalan Quetzal
                'GYD' => '$',   // Guyanaese Dollar
                'HKD' => 'HK$', // Hong Kong Dollar
                'HNL' => 'L',   // Honduran Lempira
                'HRK' => 'kn',  // Croatian Kuna
                'HTG' => 'G',   // Haitian Gourde
                'HUF' => 'Ft',  // Hungarian Forint
                'IDR' => 'Rp',  // Indonesian Rupiah
                'ILS' => '₪',   // Israeli New Shekel
                'IMP' => '£',   // Isle of Man Pound
                'INR' => '₹',   // Indian Rupee
                'IQD' => 'ع.د', // Iraqi Dinar
                'IRR' => '﷼',  // Iranian Rial
                'ISK' => 'kr',  // Icelandic Króna
                'JMD' => '$',   // Jamaican Dollar
                'JOD' => 'د.ا', // Jordanian Dinar
                'JPY' => '¥',   // Japanese Yen
                'KES' => 'KSh', // Kenyan Shilling
                'KGS' => 'с',   // Kyrgystani Som
                'KHR' => '៛',   // Cambodian Riel
                'KID' => '$',   // Kiribati Dollar
                'KMF' => 'Fr',  // Comorian Franc
                'KRW' => '₩',   // South Korean Won
                'KWD' => 'د.ك', // Kuwaiti Dinar
                'KYD' => '$',   // Cayman Islands Dollar
                'KZT' => '₸',   // Kazakhstani Tenge
                'LAK' => '₭',   // Laotian Kip
                'LBP' => 'ل.ل', // Lebanese Pound
                'LKR' => 'Rs',  // Sri Lankan Rupee
                'LRD' => '$',   // Liberian Dollar
                'LSL' => 'M',   // Lesotho Loti
                'MAD' => 'د.م.', // Moroccan Dirham
                'MDL' => 'lei', // Moldovan Leu
                'MGA' => 'Ar',  // Malagasy Ariary
                'MKD' => 'ден', // Macedonian Denar
                'MMK' => 'K',   // Myanma Kyat
                'MNT' => '₮',   // Mongolian Tugrik
                'MOP' => 'MOP$', // Macanese Pataca
                'MRU' => 'UM',  // Mauritanian Ouguiya
                'MUR' => '₨',   // Mauritian Rupee
                'MVR' => 'Rf',  // Maldivian Rufiyaa
                'MWK' => 'MK',  // Malawian Kwacha
                'MXN' => '$',   // Mexican Peso
                'MYR' => 'RM',  // Malaysian Ringgit
                'MZN' => 'MT',  // Mozambican Metical
                'NAD' => '$',   // Namibian Dollar
                'NGN' => '₦',   // Nigerian Naira
                'NIO' => 'C$',  // Nicaraguan Córdoba
                'NOK' => 'kr',  // Norwegian Krone
                'NPR' => 'Rs',  // Nepalese Rupee
                'NZD' => 'NZ$', // New Zealand Dollar
                'OMR' => 'ر.ع.', // Omani Rial
                'PAB' => 'B/.', // Panamanian Balboa
                'PEN' => 'S/.', // Peruvian Nuevo Sol
                'PGK' => 'K',   // Papua New Guinean Kina
                'PHP' => '₱',   // Philippine Peso
                'PKR' => '₨',   // Pakistani Rupee
                'PLN' => 'zł',  // Polish Zloty
                'PYG' => 'Gs',  // Paraguayan Guarani
                'QAR' => 'ر.ق', // Qatari Rial
                'RON' => 'lei', // Romanian Leu
                'RSD' => 'Рс',  // Serbian Dinar
                'RUB' => '₽',   // Russian Ruble
                'RWF' => 'Fr',  // Rwandan Franc
                'SAR' => 'ر.س', // Saudi Riyal
                'SBD' => '$',   // Solomon Islands Dollar
                'SCR' => '₨',   // Seychellois Rupee
                'SDG' => 'ج.س.', // Sudanese Pound
                'SEK' => 'kr',  // Swedish Krona
                'SGD' => 'S$',  // Singapore Dollar
                'SHP' => '£',   // Saint Helena Pound
                'SLL' => 'Le',  // Sierra Leonean Leone
                'SOS' => 'S',   // Somali Shilling
                'SRD' => '$',   // Surinamese Dollar
                'SSP' => '£',   // South Sudanese Pound
                'STN' => 'Db',  // São Tomé and Príncipe Dobra
                'SYP' => 'ل.س', // Syrian Pound
                'SZL' => 'E',   // Swazi Lilangeni
                'THB' => '฿',   // Thai Baht
                'TJS' => 'SM',  // Tajikistani Somoni
                'TMT' => 'm',   // Turkmenistani Manat
                'TND' => 'د.ت', // Tunisian Dinar
                'TOP' => 'T$',  // Tongan Paʻanga
                'TRY' => '₺',   // Turkish Lira
                'TTD' => '$',   // Trinidad and Tobago Dollar
                'TVD' => '$',   // Tuvaluan Dollar
                'TZS' => 'Sh',  // Tanzanian Shilling
                'UAH' => '₴',   // Ukrainian Hryvnia
                'UGX' => 'USh', // Ugandan Shilling
                'USD' => '$',   // United States Dollar
                'UYU' => '$U',  // Uruguayan Peso
                'UZS' => 'soʼm', // Uzbekistani Som
                'VES' => 'Bs.S', // Venezuelan Bolívar Soberano
                'VND' => '₫',   // Vietnamese Dong
                'VUV' => 'Vt',  // Vanuatu Vatu
                'WST' => 'WS$', // Samoan Tala
                'XAF' => 'Fr',  // Central African CFA Franc
                'XAG' => 'XAG', // Silver Ounce
                'XAU' => 'XAU', // Gold Ounce
                'XCD' => '$',   // East Caribbean Dollar
                'XDR' => 'XDR', // Special Drawing Rights
                'XOF' => 'Fr',  // West African CFA Franc
                'XPF' => 'Fr',  // CFP Franc
                'YER' => 'ر.ي', // Yemeni Rial
                'ZAR' => 'R',   // South African Rand
                'ZMW' => 'ZK',  // Zambian Kwacha
                'ZWL' => '$'    // Zimbabwean Dollar
            ];


            if (isset($rates[$fromCurrency])) {
                $rate = $rates[$fromCurrency];
                $convertedAmount = $amount / $rate; // Convert to USD
                $convertedAmount = round($convertedAmount, $decimal); // Round the result to decimal places

                // Store conversion result
                $conversionResults[] = [
                    'currency' => $fromCurrency,
                    'amount' => $amount,
                    'rate' => $rate,
                    'converted_amount' => $convertedAmount,
                    'currency_symbol' => $currency_symbols[$fromCurrency] ?? '', // Get currency symbol
                    'currency_position' => $currency_position, // Add currency_position to the result
                    'status' => $status
                ];
            }

            return view('Admin.Currency.Manager', [
                'rates' => $rates,
                'amount' => $amount,
                'fromCurrency' => $fromCurrency,
                'currency_position' => $currency_position,
                'status' => $status,
                'decimal' => $decimal,
                'conversionResults' => $conversionResults,
                'currency_name' => $currency_name,
                'currencies' => $currencies, // Thêm dữ liệu từ cơ sở dữ liệu
                'error' => isset($error) ? $error : null
            ]);
        } catch (\Exception $e) {
            return view('Admin.Currency.Manager', ['error' => 'Unable to fetch data from API']);
        }
    }

    public function CreateCurrency(Request $request)
    {
        $client = new Client();
        $apiKey = 'efbb7163444e6bb8819e6dbf';
        $apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/latest/USD";

        try {
            // Thực hiện yêu cầu đến API
            $response = $client->get($apiUrl);

            // Kiểm tra mã trạng thái phản hồi
            if ($response->getStatusCode() != 200) {
                throw new \Exception('Invalid response from API');
            }

            $data = json_decode($response->getBody()->getContents(), true);

            // Kiểm tra cấu trúc phản hồi API
            if (!isset($data['conversion_rates'])) {
                throw new \Exception('Invalid API response structure');
            }

            $rates = $data['conversion_rates'];
            // Fetch currency names from a reliable source or use a static mapping
            $currency_names = [
                'AED' => 'United Arab Emirates Dirham',
                'AFN' => 'Afghan Afghani',
                'ALL' => 'Albanian Lek',
                'AMD' => 'Armenian Dram',
                'ANG' => 'Netherlands Antillean Guilder',
                'AOA' => 'Angolan Kwanza',
                'ARS' => 'Argentine Peso',
                'AUD' => 'Australian Dollar',
                'AWG' => 'Aruban Florin',
                'AZN' => 'Azerbaijani Manat',
                'BAM' => 'Bosnia and Herzegovina Convertible Mark',
                'BBD' => 'Barbadian Dollar',
                'BDT' => 'Bangladeshi Taka',
                'BGN' => 'Bulgarian Lev',
                'BHD' => 'Bahraini Dinar',
                'BIF' => 'Burundian Franc',
                'BMD' => 'Bermudian Dollar',
                'BND' => 'Brunei Dollar',
                'BOB' => 'Bolivian Boliviano',
                'BRL' => 'Brazilian Real',
                'BSD' => 'Bahamian Dollar',
                'BTN' => 'Bhutanese Ngultrum',
                'BWP' => 'Botswanan Pula',
                'BYN' => 'Belarusian Ruble',
                'BZD' => 'Belize Dollar',
                'CAD' => 'Canadian Dollar',
                'CDF' => 'Congolese Franc',
                'CHF' => 'Swiss Franc',
                'CLP' => 'Chilean Peso',
                'CNY' => 'Chinese Yuan',
                'COP' => 'Colombian Peso',
                'CRC' => 'Costa Rican Colón',
                'CUP' => 'Cuban Peso',
                'CVE' => 'Cape Verdean Escudo',
                'CZK' => 'Czech Koruna',
                'DJF' => 'Djiboutian Franc',
                'DKK' => 'Danish Krone',
                'DOP' => 'Dominican Peso',
                'DZD' => 'Algerian Dinar',
                'EGP' => 'Egyptian Pound',
                'ERN' => 'Eritrean Nakfa',
                'ETB' => 'Ethiopian Birr',
                'EUR' => 'Euro',
                'FJD' => 'Fijian Dollar',
                'FKP' => 'Falkland Islands Pound',
                'FOK' => 'Faroese Króna',
                'GBP' => 'British Pound Sterling',
                'GEL' => 'Georgian Lari',
                'GHS' => 'Ghanaian Cedi',
                'GIP' => 'Gibraltar Pound',
                'GMD' => 'Gambian Dalasi',
                'GNF' => 'Guinean Franc',
                'GTQ' => 'Guatemalan Quetzal',
                'GYD' => 'Guyanaese Dollar',
                'HKD' => 'Hong Kong Dollar',
                'HNL' => 'Honduran Lempira',
                'HRK' => 'Croatian Kuna',
                'HTG' => 'Haitian Gourde',
                'HUF' => 'Hungarian Forint',
                'IDR' => 'Indonesian Rupiah',
                'ILS' => 'Israeli New Shekel',
                'IMP' => 'Isle of Man Pound',
                'INR' => 'Indian Rupee',
                'IQD' => 'Iraqi Dinar',
                'IRR' => 'Iranian Rial',
                'ISK' => 'Icelandic Króna',
                'JMD' => 'Jamaican Dollar',
                'JOD' => 'Jordanian Dinar',
                'JPY' => 'Japanese Yen',
                'KES' => 'Kenyan Shilling',
                'KGS' => 'Kyrgystani Som',
                'KHR' => 'Cambodian Riel',
                'KID' => 'Kiribati Dollar',
                'KMF' => 'Comorian Franc',
                'KRW' => 'South Korean Won',
                'KWD' => 'Kuwaiti Dinar',
                'KYD' => 'Cayman Islands Dollar',
                'KZT' => 'Kazakhstani Tenge',
                'LAK' => 'Laotian Kip',
                'LBP' => 'Lebanese Pound',
                'LKR' => 'Sri Lankan Rupee',
                'LRD' => 'Liberian Dollar',
                'LSL' => 'Lesotho Loti',
                'MAD' => 'Moroccan Dirham',
                'MDL' => 'Moldovan Leu',
                'MGA' => 'Malagasy Ariary',
                'MKD' => 'Macedonian Denar',
                'MMK' => 'Myanma Kyat',
                'MNT' => 'Mongolian Tugrik',
                'MOP' => 'Macanese Pataca',
                'MRU' => 'Mauritanian Ouguiya',
                'MUR' => 'Mauritian Rupee',
                'MVR' => 'Maldivian Rufiyaa',
                'MWK' => 'Malawian Kwacha',
                'MXN' => 'Mexican Peso',
                'MYR' => 'Malaysian Ringgit',
                'MZN' => 'Mozambican Metical',
                'NAD' => 'Namibian Dollar',
                'NGN' => 'Nigerian Naira',
                'NIO' => 'Nicaraguan Córdoba',
                'NOK' => 'Norwegian Krone',
                'NPR' => 'Nepalese Rupee',
                'NZD' => 'New Zealand Dollar',
                'OMR' => 'Omani Rial',
                'PAB' => 'Panamanian Balboa',
                'PEN' => 'Peruvian Nuevo Sol',
                'PGK' => 'Papua New Guinean Kina',
                'PHP' => 'Philippine Peso',
                'PKR' => 'Pakistani Rupee',
                'PLN' => 'Polish Zloty',
                'PYG' => 'Paraguayan Guarani',
                'QAR' => 'Qatari Rial',
                'RON' => 'Romanian Leu',
                'RSD' => 'Serbian Dinar',
                'RUB' => 'Russian Ruble',
                'RWF' => 'Rwandan Franc',
                'SAR' => 'Saudi Riyal',
                'SBD' => 'Solomon Islands Dollar',
                'SCR' => 'Seychellois Rupee',
                'SDG' => 'Sudanese Pound',
                'SEK' => 'Swedish Krona',
                'SGD' => 'Singapore Dollar',
                'SHP' => 'Saint Helena Pound',
                'SLL' => 'Sierra Leonean Leone',
                'SOS' => 'Somali Shilling',
                'SRD' => 'Surinamese Dollar',
                'SSP' => 'South Sudanese Pound',
                'STN' => 'São Tomé and Príncipe Dobra',
                'SYP' => 'Syrian Pound',
                'SZL' => 'Swazi Lilangeni',
                'THB' => 'Thai Baht',
                'TJS' => 'Tajikistani Somoni',
                'TMT' => 'Turkmenistani Manat',
                'TND' => 'Tunisian Dinar',
                'TOP' => 'Tongan Paʻanga',
                'TRY' => 'Turkish Lira',
                'TTD' => 'Trinidad and Tobago Dollar',
                'TVD' => 'Tuvaluan Dollar',
                'TZS' => 'Tanzanian Shilling',
                'UAH' => 'Ukrainian Hryvnia',
                'UGX' => 'Ugandan Shilling',
                'USD' => 'United States Dollar',
                'UYU' => 'Uruguayan Peso',
                'UZS' => 'Uzbekistani Som',
                'VES' => 'Venezuelan Bolívar Soberano',
                'VND' => 'Vietnamese Dong',
                'VUV' => 'Vanuatu Vatu',
                'WST' => 'Samoan Tala',
                'XAF' => 'Central African CFA Franc',
                'XAG' => 'Silver Ounce',
                'XAU' => 'Gold Ounce',
                'XCD' => 'East Caribbean Dollar',
                'XDR' => 'Special Drawing Rights',
                'XOF' => 'West African CFA Franc',
                'XPF' => 'CFP Franc',
                'YER' => 'Yemeni Rial',
                'ZAR' => 'South African Rand',
                'ZMW' => 'Zambian Kwacha',
                'ZWL' => 'Zimbabwean Dollar',
            ];


            \DB::beginTransaction();

            $success = false;

            if ($request->has('currencies')) {
                foreach ($request->input('currencies') as $currencyData) {
                    $result = json_decode($currencyData, true);

                    // Kiểm tra dữ liệu hợp lệ
                    if (!isset($result['currency'], $result['rate'])) {
                        continue;
                    }

                    $currencyCode = $result['currency'];
                    $currencyName = $currency_names[$currencyCode] ?? 'Unknown';
                    $rate = $result['rate'];
                    $currencySymbol = $result['currency_symbol'] ?? '';

                    // Cập nhật hoặc tạo mới bản ghi tiền tệ
                    Currency::updateOrCreate(
                        ['currency_code' => $currencyCode],
                        [
                            'rate' => $rate,
                            'currency_name' => $currencyCode === 'VND' ? 'Vietnamese Dong' : ($currencyCode === 'USD' ? 'United States Dollar' : $currencyName),
                            'currency_symbol' => $currencySymbol
                        ]
                    );
                }

                // Hoán đổi tỷ giá giữa USD và VND nếu cả hai đều có
                if (isset($rates['USD']) && isset($rates['VND'])) {
                    $usdRate = $rates['USD'];
                    $vndRate = $rates['VND'];

                    // Cập nhật tỷ giá của USD với tỷ giá của VND
                    Currency::updateOrCreate(
                        ['currency_code' => 'USD'],
                        [
                            'rate' => $vndRate / $usdRate, // Tỷ giá USD = Tỷ giá VND chia cho tỷ giá USD
                            'currency_name' => 'United States Dollar',
                            'currency_symbol' => '$' // Đặt symbol cho USD
                        ]
                    );

                    // Cập nhật tỷ giá của VND với tỷ giá của USD
                    Currency::updateOrCreate(
                        ['currency_code' => 'VND'],
                        [
                            'rate' => $usdRate / $vndRate, // Tỷ giá VND = Tỷ giá USD chia cho tỷ giá VND
                            'currency_name' => 'Vietnamese Dong',
                            'currency_symbol' => '₫' // Đặt symbol cho VND
                        ]
                    );
                }

                $success = true;
            } else {
                throw new \Exception('No currencies were selected.');
            }

            // Cam kết giao dịch nếu thành công
            if ($success) {
                \DB::commit();
                $message = 'Selected currencies have been successfully saved.';
            } else {
                throw new \Exception('Error saving currencies.');
            }
        } catch (\Exception $e) {
            // Hoàn tác giao dịch khi có lỗi
            \DB::rollBack();

            // Ghi lại thông tin lỗi để phục vụ việc gỡ lỗi
            \Log::error('Currency update failed: ' . $e->getMessage());

            return redirect()->route('admin.currency.manager')->with('error', $e->getMessage());
        }

        return redirect()->route('admin.currency.manager')->with('success', $message);
    }

    public function destroyCurrency($id)
    {
        try {
            // Tìm và xóa bản ghi theo ID
            $currency = Currency::findOrFail($id);
            $currency->delete();

            return redirect()->back()->with('success', 'Xóa tiền tệ thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa tiền tệ không thành công');
        }
    }
    public function editCurrency($id)
    {
        $currency = Currency::findOrFail($id);
        return view('admin.currency.edit', compact('currency'));
    }
    public function updateCurrency(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $this->validate($request, [
            'currency_code' => 'required|string|size:3',
            'currency_name' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:10',
            'rate' => 'required|numeric|min:0',
            'currency_position' => 'required|string|in:left,right',
            'status' => 'required|string|in:active,inactive',
            'currency_decimal' => 'nullable|integer|min:0|max:10', // Nếu cột decimal không tồn tại trong bảng, có thể bỏ qua
        ]);

        // Lấy dữ liệu từ yêu cầu
        $currency_code = $request->input('currency_code');
        $currency_name = $request->input('currency_name');
        $currency_position = $request->input('currency_position', 'left');
        $rate = $request->input('rate');
        $currency_symbol = $request->input('currency_symbol');
        $status = $request->input('status');
        $decimal = (int) $request->input('currency_decimal', 2); // Giá trị mặc định nếu không có

        $client = new Client();
        $apiKey = 'efbb7163444e6bb8819e6dbf';
        $apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/latest/USD"; // USD làm cơ sở

        try {
            // Gửi yêu cầu API để lấy dữ liệu tỷ giá
            $response = $client->get($apiUrl);
            $data = json_decode($response->getBody()->getContents(), true);

            if (!isset($data['conversion_rates']) || !is_array($data['conversion_rates'])) {
                throw new \Exception('Dữ liệu tỷ giá không hợp lệ từ API');
            }

            $rates = $data['conversion_rates'];
            unset($rates['USD']); // Loại bỏ USD nếu không cần thiết

            // Cập nhật hoặc tạo mới thông tin tiền tệ vào cơ sở dữ liệu
            Currency::updateOrCreate(
                ['currency_code' => $currency_code], // Điều kiện tìm kiếm hoặc tạo mới
                [
                    'currency_name' => $currency_name,
                    'currency_symbol' => $currency_symbol,
                    'currency_position' => $currency_position,
                    'rate' => $rate,
                    'status' => $status,
                    'currency_decimal' => $decimal, // Nếu có cột decimal, cần cập nhật
                ]
            );

            // Hiển thị thông báo thành công
            return redirect()->route('admin.currency.manager')->with('success', 'Cập nhật tiền tệ thành công!');
        } catch (\Exception $e) {
            // Xử lý lỗi và hiển thị thông báo lỗi
            return redirect()->route('admin.currency.manager')->with('error', 'Không thể cập nhật tiền tệ: ' . $e->getMessage());
        }
    }

    public function websiteConfigLanding()
    {
        $siteData = SiteData::first(); // Lấy dữ liệu từ database
        return view('Admin.Website.ConfigLanding', compact('siteData'));
    }

    public function websiteConfigEffect()
    {
        // Fetch effect setting from database, assuming there's a table called `settings`
        $effect = SiteData::where('domain', getDomain())->get();
        // Pass the effect value to the view
        return view('admin.website.effect', compact('effect'));
    }

    public function nync_log()
    {
        $logs = DB::table('sync_log')->orderBy('created_at', 'desc')->get();
        return view('admin.sync.log',compact('logs'));
    }
}
