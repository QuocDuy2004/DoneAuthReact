<?php

namespace App\Http\Controllers;

use App\Http\Service\PerfectMoneyService as ServicePerfectMoneyService;
use App\Services\PerfectMoneyService;
use Illuminate\Http\Request;

class PerfectMoneyController extends Controller
{
    protected $perfectMoneyService;

    public function __construct(ServicePerfectMoneyService $perfectMoneyService)
    {
        $this->perfectMoneyService = $perfectMoneyService;
    }

    // Hiển thị form để nhập thông tin chuyển tiền
    public function showForm()
    {
        return view('transfer-form'); // Đảm bảo bạn đã tạo view 'transfer-form'
    }

    // Thực hiện hành động chuyển tiền
    public function transfer(Request $request)
    {
        // Lấy các tham số từ yêu cầu POST
        $accountId = $request->input('account_id');
        $passPhrase = $request->input('pass_phrase');
        $payerAccount = $request->input('payer_account');
        $payeeAccount = $request->input('payee_account');
        $amount = $request->input('amount');
        $paymentId = $request->input('payment_id');

        // Thực hiện chuyển tiền thông qua service
        $data = $this->perfectMoneyService->transferFunds($accountId, $passPhrase, $payerAccount, $payeeAccount, $amount, $paymentId);

        // Kiểm tra kết quả và trả về phản hồi
        if (isset($data['error'])) {
            // Nếu có lỗi, ghi log và trả về lỗi
            \Log::error('Transfer Error', ['error' => $data['error']]);
            return response()->json(['error' => $data['error']], 500);
        }

        // Nếu thành công, hiển thị kết quả
        return view('transfer-result', ['data' => $data]);
    }
}
