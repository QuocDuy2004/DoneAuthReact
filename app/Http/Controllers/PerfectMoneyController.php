<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\SiteData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Để lấy thông tin người dùng hiện tại
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PerfectMoneyController extends Controller
{
    // Hiển thị form để người dùng nhập số tiền
    public function showForm()
    {
        return view('transfer-form');
    }

    // Xử lý thanh toán và chuyển hướng đến Perfect Money
    public function submitTransfer(Request $request)
    {
        $paymentAmount = $request->input('amount');

        if (!is_numeric($paymentAmount) || $paymentAmount <= 0) {
            return redirect()->back()->withErrors(['amount' => 'Số tiền không hợp lệ.']);
        }

        // Truy vấn để lấy thông tin tài khoản Perfect Money
        $numberPerfect = Payments::where('type', 'Perfect Money')->first();

        if ($numberPerfect && !empty($numberPerfect->account_number)) {
            // Gán giá trị tài khoản từ cột `account_number` vào biến `$payeeAccount`
            $payeeAccount = $numberPerfect->account_number;
        } else {
            // Nếu không tìm thấy tài khoản hợp lệ, trả về lỗi
            return redirect()->back()->withErrors(['payee_account' => 'Không tìm thấy tài khoản Perfect Money hợp lệ.']);
        }

        // Tiếp tục sử dụng biến $payeeAccount như mong muốn

        if (empty($payeeAccount) || !preg_match('/^U[0-9]{7,}$/', $payeeAccount)) {
            return redirect()->back()->withErrors(['payee_account' => 'Tài khoản nhận tiền không hợp lệ.']);
        }

        $orderId = md5(uniqid()); // Tạo ID đơn hàng duy nhất
        $user = Auth::user();
        $username = $user ? $user->username : 'unknown_user';
        $domain = DataSite('domain');
        // Cấu trúc dữ liệu gửi đến Perfect Money
        $data = [
            'PAYEE_ACCOUNT'   => $payeeAccount,
            'PAYEE_NAME'      => $domain, // Tên doanh nghiệp
            'PAYMENT_ID'      => $orderId,
            'PAYMENT_AMOUNT'  => $paymentAmount,
            'PAYMENT_UNITS'   => 'USD', // Đơn vị tiền tệ: USD hoặc EUR
            'PAYMENT_URL'     => url('/payment-success'), // URL khi thanh toán thành công
            'NOPAYMENT_URL'   => url('/payment-failure'), // URL khi thanh toán thất bại
            'BAGGAGE_FIELDS'  => 'IDENT',
            'SUGGESTED_MEMO'  => 'Balance recharge (' . $username . ')',
        ];

        // Tạo form chuyển hướng
        $redirectForm = '<form method="POST" action="https://perfectmoney.is/api/step1.asp" name="perfectMoneyCheckoutForm">';
        foreach ($data as $name => $value) {
            $redirectForm .= '<input type="hidden" name="' . $name . '" value="' . $value . '">';
        }
        $redirectForm .= '</form>
        <script type="text/javascript">
            document.perfectMoneyCheckoutForm.submit();
        </script>';

        return response($redirectForm);
    }

    // Xử lý khi thanh toán thành công
    public function paymentSuccess(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            DB::beginTransaction();

            try {
                // Giả sử Perfect Money trả về các tham số cần thiết để xác minh thanh toán
                $paymentId = $request->input('PAYMENT_ID');
                $paymentAmount = $request->input('PAYMENT_AMOUNT');
                $paymentSuccess = true; // Cần thay bằng logic thực tế để xác minh giao dịch từ Perfect Money

                if ($paymentSuccess && $paymentId && $paymentAmount > 0) {
                    // Cập nhật balance và total_recharge cho người dùng
                    $reward = 0; // Nếu bạn có hệ thống reward
                    $user->balance += $paymentAmount + $reward;
                    $user->total_recharge += $paymentAmount + $reward;

                    // Lưu thay đổi vào database
                    $user->save();

                    DB::commit(); // Hoàn thành giao dịch

                    return redirect()->route('payment.success.page')->with('success', 'Thanh toán thành công, số dư đã được cập nhật.');
                } else {
                    DB::rollBack();
                    return redirect()->route('payment.failure')->with('error', 'Thanh toán thất bại.');
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('payment.failure')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->withErrors(['user' => 'Không tìm thấy thông tin người dùng.']);
        }
    }

    // Xử lý khi thanh toán thất bại
    public function paymentFailure()
    {
        return view('payment-failure', ['message' => 'Thanh toán thất bại!']);
    }
}
