<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Curl\SmmApi; // Import SmmApi class
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ProviderController extends Controller
{
    public function showForm()
    {
        return view('admin.providers.form');
    }

    public function fetchAndStoreData(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'key' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'sync' => 'required|boolean',
            'status' => 'required|boolean',
            'name' => 'required|string' // Validate the name field
        ]);

        $apiUrl = $request->input('url');
        $apiKey = $request->input('key');
        $username = $request->input('username');
        $password = $request->input('password');
        $sync = $request->input('sync');
        $status = $request->input('status');
        $name = $request->input('name'); // Get the name from the request

        try {
            // Initialize SmmApi class with user-provided API key and URL
            $api = new SmmApi($apiKey, $apiUrl);

            // Fetch balance and currency using SmmApi class
            $response = $api->balance();

            // Check if response has an error
            if (!$response || isset($response->error)) {
                return redirect()->back()->withErrors(['msg' => 'Failed to fetch data from API.']);
            }

            // Extract balance and currency from response
            $balance = isset($response->balance) ? floatval($response->balance) : 0.0;
            $currency = isset($response->currency) ? $response->currency : 'Unknown';

            // Update or create provider record
            $provider = Provider::updateOrCreate(
                ['url' => $apiUrl, 'key' => $apiKey],
                [
                    'name' => $username,
                    'balance' => $balance,
                    'currency' => $currency,
                    'sync' => $sync,
                    'status' => $status,
                    'username' => $username,
                    'password' => $password,
                    'file_name' => ucfirst($name) . 'Controller.php' // Store file name
                ]
            );

            // Define the controller name and add the environment variable
            $controllerName = ucfirst($name) . 'Controller';
            $envKey = "{$controllerName}_TOKEN";

            // Update the .env file with the new API token
            $this->addEnvVariable($envKey, $apiKey);

            // Create the controller file
            $this->createControllerFile($controllerName, $apiUrl, $apiKey);

            return redirect()->route('providers.index')
                ->with('success', 'Data fetched, saved successfully, and ' . $controllerName . ' created.')
                ->with('balance', $balance);
        } catch (\Exception $e) {
            // Log exception for debugging
            Log::error('Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['msg' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    private function createControllerFile($controllerName, $apiUrl, $apiKey)
    {
        // Define the content of the new controller file
        $controllerContent = <<<EOD
<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class {$controllerName} extends Controller
{
    private \$apiToken;

    public function __construct()
    {
        \$this->apiToken = env('{$controllerName}_TOKEN'); // Use environment variable for the API token
    }

    public function CreateOrder(Request \$request)
    {
        \$apiToken = \$this->apiToken;
        \$url = "{$apiUrl}";

        // Extract data from request
        \$data = [
            'key' => \$apiToken,
            'action' => 'add',
            'service' => \$request->input('service'),
            'link' => \$request->input('link'),
            'quantity' => \$request->input('quantity'),
        ];

        \$result = \$this->curl(\$url, \$data);

        // Handle the result
        if (isset(\$result['order'])) {
            return response()->json([
                'status' => true,
                'message' => "Order placed successfully",
                'data' => \$result['order'],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => \$result['error'] ?? 'Unknown error',
                'data' => null,
            ]);
        }
    }

    public function status(Request \$request, \$order_code)
    {
        \$apiToken = \$this->apiToken;
        \$url = "{$apiUrl}";

        // Check order status
        \$data = [
            'key' => \$apiToken,
            'action' => 'status',
            'order' => \$order_code,
        ];

        \$result = \$this->curl(\$url, \$data);
        return response()->json(\$result);
    }

    private function curl(\$path, \$data = [])
    {
        \$data_string = http_build_query(\$data);

        \$ch = curl_init(\$path);
        curl_setopt(\$ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt(\$ch, CURLOPT_POSTFIELDS, \$data_string);
        curl_setopt(\$ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(\$ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        \$result = curl_exec(\$ch);
        curl_close(\$ch);

        return json_decode(\$result, true);
    }
}
EOD;

        // Determine the path to save the new controller file
        $path = app_path('Http/Controllers/Api/Service/' . $controllerName . '.php');

        // Create the directory if it does not exist
        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        // Write the controller content to the file
        File::put($path, $controllerContent);
    }


    private function addEnvVariable($key, $value)
    {
        $envFile = base_path('.env');

        // Load existing .env file contents
        $envContent = file_get_contents($envFile);

        // Check if the key already exists
        $pattern = "/^{$key}=.*/m";
        if (preg_match($pattern, $envContent)) {
            // Replace existing key
            $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
        } else {
            // Add new key
            $envContent .= "\n{$key}={$value}";
        }

        // Save updated .env file
        file_put_contents($envFile, $envContent);
    }




    public function updateBalance(Request $request, $id)
    {
        // Validate ID to ensure it is present and exists in the database
        $request->validate([]);

        // Find the provider by ID
        $provider = Provider::find($id);

        if (!$provider) {
            return redirect()->route('providers.index')->with('error', 'Balance updated error.');
        }

        $apiUrl = $provider->url;
        $apiKey = $provider->key;

        try {
            // Initialize SmmApi class with provider's API key and URL
            $api = new SmmApi($apiKey, $apiUrl);

            // Fetch balance using SmmApi class
            $response = $api->balance();

            // Check if response has an error
            if (!$response || isset($response->error)) {
                return redirect()->back()->withErrors(['msg' => 'Failed to fetch data from API.']);
            }

            // Extract balance from response
            $balance = isset($response->balance) ? floatval($response->balance) : 0.0;

            // Update balance for the provider record
            $provider->balance = $balance;
            $provider->save();

            // Redirect back with success message and updated balance
            return redirect()->route('providers.index')->with('success', 'Balance updated successfully.')->with('balance', $balance);
        } catch (\Exception $e) {
            // Log exception for debugging
            Log::error('Exception: ' . $e->getMessage());
            return redirect()->back()->withErrors(['msg' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


    public function index()
    {
        $providers = Provider::all();
        return view('admin.providers.index', compact('providers'));
    }

    public function edit($id)
    {
        $provider = Provider::findOrFail($id);
        return view('admin.providers.edit', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'url' => 'required|url',
            'key' => 'required|string',
            'username' => 'required|string',
            'sync' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // Find the provider by ID
        $provider = Provider::find($id);

        if (!$provider) {
            return redirect()->route('providers.index')->with('error', 'Provider not found.');
        }

        try {
            // Update only the necessary fields
            $provider->update($request->only([
                'url',
                'key',
                'username',
                'sync',
                'status'
            ]));

            // Update the environment variable
            $controllerName = ucfirst($provider->name) . 'Controller';
            $envKey = "{$controllerName}_TOKEN";
            $this->addOrUpdateEnvVariable($envKey, $request->input('key'));

            return redirect()->route('providers.index')->with('success', 'Provider updated successfully.');
        } catch (\Exception $e) {
            // Log exception for debugging
            Log::error('Exception updating provider with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('providers.index')->with('error', 'Failed to update provider. Please try again.');
        }
    }

    private function addOrUpdateEnvVariable($key, $value)
    {
        $envFile = base_path('.env');

        // Load existing .env file contents
        $envContent = file_get_contents($envFile);

        // Check if the key already exists
        $pattern = "/^{$key}=.*/m";
        if (preg_match($pattern, $envContent)) {
            // Replace existing key
            $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
        } else {
            // Add new key
            $envContent .= PHP_EOL . "{$key}={$value}";
        }

        // Save updated .env file
        file_put_contents($envFile, $envContent);

        // Clear configuration cache if needed
        Artisan::call('config:cache');
    }




    private function removeEnvVariable($key)
    {
        $envFile = base_path('.env');

        // Đọc nội dung của tệp .env
        $envContent = file_get_contents($envFile);

        // Tạo pattern để tìm biến môi trường cần xóa
        $pattern = "/^{$key}=.*\n?/m";

        // Loại bỏ dòng chứa biến môi trường
        $newEnvContent = preg_replace($pattern, '', $envContent);

        // Xóa ký tự newline dư thừa ở cuối tệp
        $newEnvContent = rtrim($newEnvContent, "\n");

        // Ghi lại nội dung mới vào tệp .env
        file_put_contents($envFile, $newEnvContent);
    }
    public function destroy($id)
    {
        // Tìm provider theo ID
        $provider = Provider::findOrFail($id);

        // Xóa file controller nếu tồn tại
        if ($provider->file_name) {
            $controllerPath = app_path('Http/Controllers/Api/Service/' . $provider->file_name);

            if (file_exists($controllerPath)) {
                unlink($controllerPath);
            }
        }

        // Xóa biến môi trường liên quan
        $this->removeEnvVariable("{$provider->file_name}_TOKEN");

        // Xóa provider
        $provider->delete();

        return redirect()->route('providers.index')->with('success', 'Provider deleted successfully.');
    }
}
