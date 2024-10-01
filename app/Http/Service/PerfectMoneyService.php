<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PerfectMoneyService
{
    protected $apiUrl = 'https://perfectmoney.com/acct/confirm.asp';

    public function transferFunds($accountId, $passPhrase, $payerAccount, $payeeAccount, $amount, $paymentId)
    {
        try {
            // Xây dựng URL với tham số
            $url = $this->apiUrl . '?' . http_build_query([
                'AccountID' => $accountId,
                'PassPhrase' => $passPhrase,
                'Payer_Account' => $payerAccount,
                'Payee_Account' => $payeeAccount,
                'Amount' => $amount,
                'PAY_IN' => '1', // assuming PAY_IN indicates a deposit
                'PAYMENT_ID' => $paymentId,
            ]);

            // Gửi yêu cầu HTTP
            $response = Http::get($url);

            // Kiểm tra mã trạng thái HTTP
            if ($response->failed()) {
                Log::error('Failed to process transfer request', ['url' => $url, 'status' => $response->status()]);
                return ['error' => 'Failed to process the transfer.'];
            }

            // Lấy dữ liệu từ phản hồi
            $body = $response->body();
            Log::info('Transfer response body', ['body' => $body]);

            // Phân tích dữ liệu HTML để lấy các trường ẩn
            return $this->parseHiddenFields($body);
        } catch (\Exception $e) {
            Log::error('Exception processing transfer request', ['exception' => $e->getMessage()]);
            return ['error' => 'Exception occurred while processing the transfer.'];
        }
    }

    private function parseHiddenFields($html)
    {
        $fields = [];
        if (preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $html, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $fields[$match[1]] = $match[2];
            }
        } else {
            Log::error('No hidden fields found in response');
        }
        return $fields;
    }
}
