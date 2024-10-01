<?php

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Provider;
use App\Curl\SmmApi;
use Illuminate\Support\Facades\Log;

class UpdateProviderBalances extends Command
{
    protected $signature = 'update:provider-balances';
    protected $description = 'Fetch and update provider balances every 3 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all providers from the database
        $providers = Provider::all();

        foreach ($providers as $provider) {
            try {
                // Initialize SmmApi class with provider's API key and URL
                $api = new SmmApi($provider->key, $provider->url);

                // Fetch balance using SmmApi class
                $response = $api->balance();

                // Check if response has an error
                if (!$response || isset($response->error)) {
                    Log::error('Failed to fetch data for provider: ' . $provider->id);
                    continue;
                }

                // Extract balance and currency from response
                $balance = isset($response->balance) ? floatval($response->balance) : 0.0;
                $currency = isset($response->currency) ? $response->currency : '';

                // Update provider record
                $provider->update([
                    'balance' => $balance,
                    'currency' => $currency,
                ]);

                Log::info('Updated balance for provider: ' . $provider->id . ' to ' . $balance);

            } catch (\Exception $e) {
                // Log exception for debugging
                Log::error('Exception for provider ' . $provider->id . ': ' . $e->getMessage());
            }
        }

        $this->info('Provider balances updated successfully.');
    }
}
