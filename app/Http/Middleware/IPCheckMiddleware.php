<?php

namespace App\Http\Middleware;

use Closure;

class IPCheckMiddleware
{
    public function handle($request, Closure $next)
    { 
        $serverIPMC= $_SERVER['SERVER_ADDR'];
        $clientIP = $request->ip();
        // Danh sách các địa chỉ IP được phép truy cập
        $allowedIPs = ['103.200.23.98'];

        // Lấy địa chỉ IP của người gửi request
        
        $serverIP = $_SERVER['REMOTE_ADDR'];
        // Kiểm tra xem địa chỉ IP có trong danh sách được phép không
        if (!in_array($serverIPMC, $allowedIPs)) {
            // return response('Access denied', 403);
             return response()->json([
                    'status' => 'error',
                    'message' => 'Access denied '.$serverIP.'.<br>Đòi làm buoi gì vậy hacker?'
                ]);
        }
       

        return $next($request);
    }
}
