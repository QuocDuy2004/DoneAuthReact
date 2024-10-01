<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\TelegramCustomController;
use App\Models\Orders;
use App\Models\ServerService;
use App\Models\Service;
use App\Models\Category;
use App\Models\ServiceSocial;
use App\Models\User;
use App\Models\Tainguyen;
use App\Models\DataHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DataServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('xss')->except(['serverNew', 'serverEdit', 'updateAllServerPrices']);
    }

    public function serviceNew(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'social' => 'required|string',
            'service' => 'required|string',
            'path_service' => 'required|string',
            'status' => 'required|string|in:show,hide',
            'category' => 'required|string',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $social = ServiceSocial::where('domain', getDomain())->where('slug', $request->social)->first();
            if ($social) {
                $slug_service = Str::slug($request->path_service, '-');
                $service = Service::where('slug', $slug_service)->where('service_social', $request->social)->where('domain', getDomain())->first();
                if ($service) {
                    return redirect()->back()->with('error', 'Dịch vụ đã tồn tại')->withInput();
                } else {

                    $action_type = '';
                    switch ($request->category) {
                        case 'default':
                            $file_view = storage_path('/app/public/source/default.twig');
                            $action_type = 'default';
                            break;
                        case 'reaction':
                            $file_view = storage_path('/app/public/source/reaction.twig');
                            $action_type = 'reaction';
                            break;
                        case 'reaction-speed':
                            $file_view = storage_path('/app/public/source/reaction-speed.twig');
                            $action_type = 'reaction-speed';
                            break;
                        case 'comment':
                            $file_view = storage_path('/app/public/source/comment2.twig');
                            $action_type = 'comment';
                            break;
                        case 'comment-quantity':
                            $file_view = storage_path('/app/public/source/comment.twig');
                            $action_type = 'comment-quantity';
                            break;
                        case 'minutes':
                            $file_view = storage_path('/app/public/source/minutes.twig');
                            $action_type = 'minutes';
                            break;
                        case 'viplike':
                            $file_view = storage_path('/app/public/source/viplike.twig');
                            $action_type = 'viplike';
                            break;
                        case 'viplike-kcx':
                            $file_view = storage_path('/app/public/source/viplike-kcx.twig');
                            $action_type = 'viplike-kcx';
                            break;
                        case 'time':
                            $file_view = storage_path('/app/public/source/time.twig');
                            $action_type = 'time';
                            break;
                        case 'bot':
                            $file_view = storage_path('/app/public/source/bot.twig');
                            $action_type = 'bot';
                            break;
                        case 'proxy':
                            $file_view = storage_path('/app/public/source/proxy.twig');
                            $action_type = 'proxy';
                            break;
                        default:
                            $file_view = storage_path('/app/public/source/default.twig');
                            $action_type = 'default';
                            break;
                    }
                    $social_folder = $social->folder;
                    $file_view = File::get($file_view);
                    $file_service = $slug_service . Str::random(4);
                    if (!File::exists(resource_path('views/service/' . $social_folder))) {
                        File::makeDirectory(resource_path('views/service/' . $social_folder), 0777, true, true);
                    }

                    if (!File::exists(resource_path('views/service/' . $social_folder . '/' . $file_service . '.blade.php'))) {
                        File::put(resource_path('views/service/' . $social_folder . '/' . $file_service . '.blade.php'), $file_view);
                    }
                    Service::create([
                        'name' => $request->service,
                        'logo' => $request->logo,
                        'slug' => $slug_service,
                        'service_social' => $social->slug,
                        'status' => $request->status,
                        'file' => $file_service,
                        'category' => $request->category,
                        'domain' => getDomain(),
                    ]);

                    return redirect()->back()->with('success', 'Thêm thành công');
                }
            } else {
                return redirect()->back()->with('error', 'Dịch vụ MXH không tồn tại')->withInput();
            }
        }
    }


    public function serviceSocialEdit($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'social_service' => 'required|string',
            'social_path' => 'required|string',
            'social_image' => 'required|string',
            'social_status' => 'required|string|in:show,hide',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $social_service = $request->social_service;
            $social_path = $request->social_path;
            $social_image = $request->social_image;
            $social_status = $request->social_status;

            $social_path = Str::slug($social_path, '-');

            $social = ServiceSocial::where('domain', getDomain())->where('slug', $social_path)->where('id', '!=', $id)->first();
            if ($social) {
                return redirect()->back()->with('error', 'Đường dẫn đã tồn tại')->withInput();
            } else {
                $social_folder = Str::slug($social_service, '-') . '-' . Str::random(10);
                $social_old = ServiceSocial::where('domain', getDomain())->where('id', $id)->first();
                if ($social_old) {
                    File::move(resource_path('views/service/' . $social_old->folder), resource_path('views/service/' . $social_folder));
                }
                ServiceSocial::where('domain', getDomain())->where('id', $id)->update([
                    'name' => $social_service,
                    'slug' => $social_path,
                    'image' => $social_image,
                    'folder' => $social_folder,
                    'status' => $social_status,
                ]);

                return redirect()->back()->with('success', 'Cập nhật thành công');
            }
        }
    }

    public function serviceNewSocial(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'social_service' => 'required|string',
            'social_path' => 'required|string',
            'social_image' => 'required|string',
            'social_status' => 'required|string|in:show,hide',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $social_service = $request->social_service;
            $social_path = $request->social_path;
            $social_image = $request->social_image;
            $social_status = $request->social_status;

            $social_path = Str::slug($social_path, '-');

            $social = ServiceSocial::where('domain', getDomain())->where('slug', $social_path)->first();
            if ($social) {
                return redirect()->back()->with('error', 'Đường dẫn đã tồn tại')->withInput();
            } else {
                // Tạo folder trong resources/views/service
                $social_folder = Str::slug($social_service, '-') . '-' . Str::random(10);
                File::makeDirectory(resource_path('views/service/' . $social_folder), 0777, true, true);

                ServiceSocial::create([
                    'name' => $social_service,
                    'slug' => $social_path,
                    'image' => $social_image,
                    'folder' => $social_folder,
                    'status' => $social_status,
                    'domain' => getDomain(),
                ]);

                return redirect()->back()->with('success', 'Thêm thành công');
            }
        }
    }


    public function serviceSocialDelete($id)
    {
        $social = ServiceSocial::where('domain', getDomain())->where('id', $id)->first();
        if ($social) {
            $service = Service::where('domain', getDomain())->where('service_social', $social->slug)->get();
            foreach ($service as $item) {
                $file = resource_path('views/service/' . $social->folder . '/' . $item->file . '.blade.php');
                File::delete($file);
                $item->delete();
            }
            $server = ServerService::where('domain', getDomain())->where('social_id', $social->id)->get();
            foreach ($server as $item) {
                $item->delete();
            }
            $social->delete();
            return resApi('success', 'Xóa dịch vụ mạng xã hội thành công');
        } else {
            return resApi('error', 'Không tìm thấy dịch vụ');
        }
    }



    public function serviceEdit($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required|string|in:show,hide',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $name = $request->name;
            $status = $request->status;

            $service = Service::where('domain', getDomain())->where('id', $id)->first();
            if ($service) {
                Service::where('domain', getDomain())->where('id', $id)->update([
                    'name' => $name,
                    'status' => $status,
                ]);
                return redirect()->back()->with('success', 'Cập nhật thành công');
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
            }
        }
    }

    public function serviceDelete($id)
    {
        $service = Service::where('domain', getDomain())->where('id', $id)->first();
        if ($service) {
            // xoá file
            $social = ServiceSocial::where('domain', getDomain())->where('slug', $service->service_social)->first();
            if ($social) {
                $server = ServerService::where('domain', getDomain())->where('service_id', $service->id)->get();
                foreach ($server as $item) {
                    $item->delete();
                }
                File::delete(resource_path('views/service/' . $social->folder . '/' . $service->file . '.blade.php'));
            }
            $service->delete();
            return redirect()->back()->with('success', 'Xóa dịch vụ thành công');
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
        }
    }
    public function importServices(Request $request)
    {
        // Validate input
        $valid = Validator::make($request->all(), [
            'social' => 'required|integer',
            'service' => 'required|integer',
            'server_service' => 'required|integer',
            'price' => 'required|numeric',
            'min' => 'required|integer',
            'max' => 'required|integer',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'actual_service' => 'required|string',
            'actual_server' => 'required|string',
            'actual_path' => 'nullable|string',
            'action' => 'nullable|string', // action không bắt buộc
            'order_type' => 'nullable|string', // order_type không bắt buộc
            'warranty' => 'nullable|string|in:yes,no', // warranty không bắt buộc
        ]);
    
        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        }
    
        // Check if social exists
        $social = ServiceSocial::where('domain', getDomain())->where('id', $request->social)->first();
        if (!$social) {
            return resApi('error', 'Không tìm thấy dịch vụ MXH');
        }
    
        // Check if service exists
        $service = Service::where('domain', getDomain())->where('id', $request->service)->first();
        if (!$service) {
            return redirect()->back()->with('error', 'Không tìm thấy dịch vụ');
        }
    
        // Check if server already exists
        $server = ServerService::where('domain', getDomain())
            ->where('social_id', $social->id)
            ->where('service_id', $service->id)
            ->where('server', $request->server_service)
            ->first();
    
        if ($server) {
            return redirect()->back()->with('error', 'Máy chủ đã tồn tại trên hệ thống');
        }
    
        // Lấy domain từ URL actual_service
        $parsedUrl = parse_url($request->actual_service);
        $domain = isset($parsedUrl['host'])
            ? preg_replace('/^www\./', '', $parsedUrl['host'])
            : $request->actual_service;
    
        $basePrice = $request->price;
        $priceCollaborator = $basePrice * 1.05;
        $priceAgency = $priceCollaborator * 1.05;
        $priceDistributor = $priceAgency * 1.05;
    
        ServerService::create([
            'name' => $service->name,
            'social_id' => $social->id,
            'service_id' => $service->id,
            'socialll' => $service->service_social,
            'server' => $request->server_service,
            'price' => $basePrice,
            'price_collaborator' => $priceCollaborator,
            'price_agency' => $priceAgency,
            'price_distributor' => $priceDistributor,
            'min' => $request->min,
            'max' => $request->max,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'provider_url' => $domain, // Lưu domain vào provider_url
            'actual_service' => $domain, // Lưu domain vào actual_service
            'actual_server' => $request->actual_server,
            'actual_path' => $request->actual_path ?? '/',
            'action' => $request->action ?? 'default',
            'order_type' => $request->order_type ?? 'default',
            'warranty' => $request->warranty ?? 'no',
            'domain' => getDomain(),
        ]);
    
        return redirect()->back()->with('success', 'Thêm dịch vụ thành công');
    }
    

    public function serverNew(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'social' => 'required|integer',
            'service' => 'required|integer',
            'server_service' => 'required|integer',
            'price' => 'required|numeric',
            'price_collaborator' => 'required|numeric',
            'price_agency' => 'required|numeric',
            'price_distributor' => 'required|numeric',
            'min' => 'required|integer',
            'max' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'actual_service' => 'required|string',
            'actual_server' => 'required|string',
            'actual_path' => 'required|string',
            'action' => 'required|string',
            'order_type' => 'required|string',
            'warranty' => 'required|string|in:yes,no',
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            //kiểm tra social có tồn tại không
            $actualService = $request->actual_service;
            $social = ServiceSocial::where('domain', getDomain())->where('id', $request->social)->first();
            if ($social) {
                //kiêmtr tra service có tồn tại không
                $service = Service::where('domain', getDomain())->where('id', $request->service)->first();
                if ($service) {
                    // kiểm tra server
                    $server = ServerService::where('domain', getDomain())->where('social_id', $social->id)->where('service_id', $service->id)->where('server', $request->server_service)->first();
                    if ($server) {
                        return resApi('error', 'Máy chủ đã tồn tại');
                    } else {
                        // tạo server
                        ServerService::create([
                            'name' => $service->name,
                            'social_id' => $social->id,
                            'service_id' => $service->id,
                            'socialll' => $service->service_social,
                            'server' => $request->server_service,

                            'price' => $request->price,
                            'price_collaborator' => $request->price_collaborator,
                            'price_agency' => $request->price_agency,
                            'price_distributor' => $request->price_distributor,
                            'min' => $request->min,
                            'max' => $request->max,
                            'title' => $request->title,
                            'description' => $request->description,
                            'status' => 'Active',
                            'actual_service' => $request->actual_service,
                            'actual_server' => $request->actual_server,
                            'actual_path' => $request->actual_path,
                            'action' => $request->action,
                            'order_type' => $request->order_type,
                            'warranty' => $request->warranty,
                            'domain' => getDomain(),

                        ]);
                        return resApi('success', 'Thêm thành công');
                    }
                } else {
                    return resApi('error', 'Không tìm thấy dịch vụ');
                }
            } else {
                return resApi('error', 'Không tìm thấy dịch vụ MXH');
            }
        }
    }

    public function serverEdit($id, Request $request)
    {
        if (getDomain() == env('PARENT_SITE')) {
            $valid = Validator::make($request->all(), [
                'name' => 'required|string',
                'server_service' => 'required|integer',
                'price' => 'required|numeric',
                'price_collaborator' => 'required|numeric',
                'price_agency' => 'required|numeric',
                'price_distributor' => 'required|numeric',
                'min' => 'required|integer',
                'max' => 'required|integer',
                'title' => 'required|string',
                'description' => 'required|string',
                'actual_service' => 'required|string',
                'actual_server' => 'required|string',
                'actual_path' => 'required|string',
                'status' => 'required|string|in:Active,InActive',
                'action' => 'required|string',
                'order_type' => 'required|string',
                'warranty' => 'required|string|in:yes,no',
            ]);
        } else {
            $valid = Validator::make($request->all(), [
                'name' => 'required|string',
                'server_service' => 'required|integer',
                'price' => 'required|numeric',
                'price_collaborator' => 'required|numeric',
                'price_agency' => 'required|numeric',
                'price_distributor' => 'required|numeric',
                'min' => 'required|integer',
                'max' => 'required|integer',
                'title' => 'required|string',
                'description' => 'required|string',
                'status' => 'required|string|in:Active,InActive'
            ]);
        }

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            if (getDomain() == env('PARENT_SITE')) {
                ServerService::where('domain', getDomain())->where('id', $id)->update([
                    'name' => $request->name,
                    'server' => $request->server_service,
                    'price' => $request->price,
                    'price_collaborator' => $request->price_collaborator,
                    'price_agency' => $request->price_agency,
                    'price_distributor' => $request->price_distributor,
                    'min' => $request->min,
                    'max' => $request->max,
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                    'actual_service' => $request->actual_service,
                    'actual_server' => $request->actual_server,
                    'actual_path' => $request->actual_path,
                    'action' => $request->action,
                    'order_type' => $request->order_type,
                    'warranty' => $request->warranty,
                    'domain' => getDomain(),
                ]);
            } else {
                ServerService::where('domain', getDomain())->where('id', $id)->update([
                    'name' => $request->name,
                    'server' => $request->server_service,
                    'price' => $request->price,
                    'price_collaborator' => $request->price_collaborator,
                    'price_agency' => $request->price_agency,
                    'price_distributor' => $request->price_distributor,
                    'min' => $request->min,
                    'max' => $request->max,
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                    'domain' => getDomain(),
                ]);
            }
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }
    }
    public function updateAllServerPrices(Request $request)
    {

        $serverData = $request->input('servers');


        $errors = [];

        foreach ($serverData as $serverItem) {
            $serverId = $serverItem['id'];

            // Tạo một request mới từ dữ liệu của mỗi dịch vụ
            $serverRequest = new Request($serverItem);

            // Kiểm tra dữ liệu của từng dịch vụ
            $valid = Validator::make($serverItem, [
                'id' => 'required|integer',
                'price' => 'required|numeric',
                'price_collaborator' => 'required|numeric',
                'price_agency' => 'required|numeric',
                'price_distributor' => 'required|numeric',
                'status' => 'required|string|in:Active,InActive',
            ]);

            if ($valid->fails()) {
                $errors[] = 'Dữ liệu không hợp lệ cho dịch vụ với ID: ' . $serverId;
                // In giá trị dữ liệu để kiểm tra

            } else {
                // Gọi phương thức serverPrice() với từng dịch vụ

                $result = $this->serverPrice($serverId, $serverRequest);
                // Xử lý kết quả nếu cần thiết
                // ...
            }
        }

        if (empty($errors)) {
            return resApi('success', 'Cập nhật giá thành công cho tất cả các dịch vụ.');
        } else {
            return resApi('error', implode(' ', $errors));
        }
    }

    public function serverPrice($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'price_collaborator' => 'required|numeric',
            'price_agency' => 'required|numeric',
            'price_distributor' => 'required|numeric',
            'status' => 'required|string|in:Active,InActive',
        ]);

        if ($valid->fails()) {
            return ['status' => 'error', 'message' => $valid->errors()->first()];
        } else {
            ServerService::where('domain', getDomain())->where('id', $id)->update([
                'price' => $request->price,
                'price_collaborator' => $request->price_collaborator,
                'price_agency' => $request->price_agency,
                'price_distributor' => $request->price_distributor,
                'actual_price' => null,
                'status' => $request->status,
                'domain' => getDomain(),
            ]);

            return ['status' => 'success'];
        }
    }


    public function serverDelete($id)
    {
        try {
            $server = ServerService::findOrFail($id);
            $server->delete();

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi khi xóa dịch vụ.']);
        }
    }

    public function serviceChecking(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $social = ServiceSocial::where('domain', env('PARENT_SITE'))->where('id', $request->id)->first();
            if ($social) {
                $service_list = Service::where('domain', env('PARENT_SITE'))->where('service_social', $social->slug)->get();
                if ($service_list) {
                    return resApi('success', 'Thành công', $service_list);
                } else {
                    return resApi('error', 'Không tìm thấy dịch vụ');
                }
            } else {
                return resApi('error', 'Không tìm thấy dịch vụ');
            }
        }
    }

    public function tainguyenNewChuyenmucEdit($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|string',
            'status' => 'required|string|in:show,hide',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $name = $request->name;
            $slug = $request->slug;
            $image = $request->image;
            $status = $request->status;

            $slug = Str::slug($slug, '-');

            $social = Category::where('domain', getDomain())->where('slug', $slug)->where('id', '!=', $id)->first();
            if ($social) {
                return redirect()->back()->with('error', 'Đường dẫn đã tồn tại')->withInput();
            } else {

                Category::where('domain', getDomain())->where('id', $id)->update([
                    'name' => $name,
                    'slug' => $slug,
                    'image' => $image,

                    'status' => $status,
                ]);

                return redirect()->back()->with('success', 'Cập nhật thành công');
            }
        }
    }
    public function tainguyenNewChuyenmuc(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|string',
            'status' => 'required|string|in:show,hide',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->with('error', $valid->errors()->first())->withInput();
        } else {
            $name = $request->name;
            $slug = $request->slug;
            $image = $request->image;
            $status = $request->status;

            $slug = Str::slug($slug, '-');

            $social = Category::where('domain', getDomain())->where('slug', $slug)->first();
            if ($social) {
                return redirect()->back()->with('error', 'Đường dẫn đã tồn tại')->withInput();
            } else {
                

                Category::create([
                    'name' => $name,
                    'slug' => $slug,
                    'image' => $image,
               
                    'status' => $status,
                    'domain' => getDomain(),
                ]);

                return redirect()->back()->with('success', 'Thêm thành công');
            }
        }
    }
    public function tainguyenNewChuyenmucDelete($id)
    {
        $social = Category::where('domain', getDomain())->where('id', $id)->first();
        if ($social) {
            // $service = Service::where('domain', getDomain())->where('service_social', $social->slug)->get();
            // foreach ($service as $item) {
            //     $file = resource_path('views/service/' . $social->folder . '/' . $item->file . '.blade.php');
            //     File::delete($file);
            //     $item->delete();
            // }
            $server = Tainguyen::where('domain', getDomain())->where('category_id', $social->id)->get();
            foreach ($server as $item) {
                $item->delete();
            }
            $social->delete();
            return resApi('success', 'Xóa thành công');
        } else {
            return resApi('error', 'Không tìm thấy dịch vụ');
        }
    }
    public function tainguyenNewTainguyenDelete($id)
    {
        $social = Tainguyen::where('domain', getDomain())->where('id', $id)->first();
        if ($social) {

            $social->delete();
            return resApi('success', 'Xóa thành công');
        } else {
            return resApi('error', 'Không tìm thấy dịch vụ');
        }
    }


    public function tainguyenNewTainguyen(Request $request)
{
    // Xác thực dữ liệu
    $validated = $request->validate([
        'chuyenmuc' => 'required|exists:category,id',
        'name' => 'required|string',
        'image' => 'required|url',
        'description' => 'required|string',
        'thongtin' => 'required|string',
        'price' => 'required|numeric',
        'price_collaborator' => 'required|numeric',
        'price_agency' => 'required|numeric',
        'price_distributor' => 'required|numeric',
    ]);

    // Kiểm tra và lấy thông tin chuyên mục
    $tainguyen = Category::where('domain', getDomain())
                         ->where('id', $request->chuyenmuc)
                         ->first();

    if ($tainguyen) {
        // Lưu tài nguyên mới vào cơ sở dữ liệu
        Tainguyen::create([
            'thongtin' => $request->thongtin,
            'price' => $request->price,
            'price_collaborator' => $request->price_collaborator,
            'price_agency' => $request->price_agency,
            'price_distributor' => $request->price_distributor,
            'image' => $request->image,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->chuyenmuc,
            'domain' => getDomain(),
        ]);

        return redirect()->back()->with('success', 'Thêm thành công');
    } else {
        return redirect()->back()->with('error', 'Không tìm thấy chuyên mục');
    }
}
    public function tainguyenNewTainguyenEdit($id, Request $request)
    {

        $valid = Validator::make($request->all(), [

            'price' => 'required|numeric',
            'price_collaborator' => 'required|numeric',
            'price_agency' => 'required|numeric',
            'price_distributor' => 'required|numeric',

            'name' => 'required|string',
            'description' => 'required|string',
            'thongtin' => 'required',

        ]);


        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {

            Tainguyen::where('domain', getDomain())->where('id', $id)->update([
                'thongtin' => $request->thongtin,


                'price' => $request->price,
                'price_collaborator' => $request->price_collaborator,
                'price_agency' => $request->price_agency,
                'price_distributor' => $request->price_distributor,
                'image' => $request->image,
                'name' => $request->name,
                'description' => $request->description,


            ]);

            return resApi('success', 'Sửa thành công');
        }
    }
    public function serverNotificationTelegram(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'social' => 'required|integer',
            'service' => 'required|integer',
            'content' => 'required|string',
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $tele = new TelegramCustomController();
            $bot = $tele->bot();

            $social = ServiceSocial::where('domain', getDomain())->where('id', $request->social)->first();
            if ($social) {
                $service = Service::where('domain', getDomain())->where('id', $request->service)->first();
                if ($service) {
                    $server = ServerService::where('domain', getDomain())->where('social_id', $social->id)->where('service_id', $service->id)->get();
                    if ($server) {
                        $users = User::where('domain', getDomain())->where('telegram_verified', 'yes')->where('telegram_notice', 'on')->get();
                        if ($users) {
                            foreach ($users as $user) {
                                $bot->sendMessage([
                                    'chat_id' => $user->telegram_chat_id,
                                    'text' => "Thông báo từ dịch vụ \n" . $social->name . " - " . $service->name . "\n" . $request->content,
                                    'parse_mode' => 'HTML',
                                ]);
                            }
                            return resApi('success', 'Gửi thông báo thành công');
                        } else {
                            return resApi('error', 'Không tìm thấy người dùng');
                        }
                    } else {
                        return resApi('error', 'Không tìm thấy máy chủ');
                    }
                } else {
                    return resApi('error', 'Không tìm thấy dịch vụ');
                }
            } else {
                return resApi('error', 'Không tìm thấy dịch vụ');
            }
        }
    }

    public function orderActive(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {
            $order = Orders::where('domain', getDomain())->where('id', $request->id)->where('status', 'Pending')->update([
                'status' => 'Active',
            ]);

            if ($order) {
                return resApi('success', 'Duyệt đơn hàng thành công');
            } else {
                return resApi('error', 'Không tìm thấy đơn hàng');
            }
        }
    }
    public function orderEdit($id, Request $request)
    {

        $valid = Validator::make($request->all(), [
            'buff' => 'required',
            'status' => 'required',
            'start' => 'required',
        ]);


        if ($valid->fails()) {
            return resApi('error', $valid->errors()->first());
        } else {

            Orders::where('domain', getDomain())->where('id', $id)->update([
                'buff' => $request->buff,
                'status' => $request->status,
                'start' => $request->start,

                'domain' => getDomain(),
            ]);

            return resApi('success', 'Sửa thành công');
        }
    }
    public function orderDelete(Request $request, $id)
    {
        try {
            $order = Orders::where('domain', getDomain())->where('id', $id)->first();
            if ($order) {
                $order->delete();
                return response()->json(['status' => 'success', 'message' => 'Xóa đơn hàng thành công']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Không tìm thấy đơn hàng']);
            }
        } catch (\Exception $e) {
            // Ghi lại lỗi để kiểm tra
            \Log::error('Error deleting order: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Đã xảy ra lỗi trong quá trình xóa.']);
        }
    }

    public function orderCancel(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($valid->fails()) {
            return response()->json(['status' => 'error', 'message' => $valid->errors()->first()]);
        } else {
            $order = Orders::where('domain', getDomain())->where('id', $request->id)->where('status', 'Pending')->first();

            if ($order) {
                $order->update([
                    'status' => 'Cancelled',
                ]);

                $user = User::where('domain', getDomain())->where('username', $order->username)->first();
                if ($user) {
                    $user->balance += $order->total_payment;
                    $user->total_deduct -= $order->total_payment;
                    $user->save();
                }
                return response()->json(['status' => 'success', 'message' => 'Hủy đơn hàng thành công']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Không tìm thấy đơn hàng']);
            }
        }
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');
        $deleted = Service::whereIn('id', $ids)->delete();

        if ($deleted) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }


    // ServiceController.php
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids)) {
            foreach ($ids as $id) {
                // Xóa dịch vụ theo ID
                Service::find($id)->delete();
            }
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 400);
    }
}
