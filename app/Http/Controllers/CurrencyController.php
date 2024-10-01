<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CurrencyController extends Controller
{
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
}
