{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Currency Converter</h1>

        <form id="currency-form" action="{{ route('currency.convert') }}" method="POST">
            @csrf
            <div class="form-group row mb-3">
                <label for="amount" class="col-md-2 col-form-label">Amount:</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="amount" name="amount" value="1" step="0.01" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="from_currency" class="col-md-2 col-form-label">From:</label>
                <div class="col-md-10">
                    <select class="form-control" id="from_currency" name="from_currency" required>
                        <!-- Options will be dynamically added -->
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="to_currency" class="col-md-2 col-form-label">To:</label>
                <div class="col-md-10">
                    <select class="form-control" id="to_currency" name="to_currency" required>
                        <!-- Options will be dynamically added -->
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Convert</button>
        </form>

        @if(isset($convertedAmount))
            <h2 class="mt-4">Conversion Result</h2>
            <p>{{ $amount }} {{ $fromCurrency }} = {{ number_format($convertedAmount, 2) }} {{ $toCurrency }}</p>
        @elseif(isset($error))
            <p class="text-danger">{{ $error }}</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route('currency.getCurrencyRates') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.rates) {
                        const fromCurrencySelect = document.getElementById('from_currency');
                        const toCurrencySelect = document.getElementById('to_currency');
                        
                        // Populate from_currency options
                        Object.keys(data.rates).forEach(currency => {
                            const option = document.createElement('option');
                            option.value = currency;
                            option.textContent = currency;
                            fromCurrencySelect.appendChild(option);
                            
                            // Add the same options for to_currency
                            const optionTo = document.createElement('option');
                            optionTo.value = currency;
                            optionTo.textContent = currency;
                            toCurrencySelect.appendChild(optionTo);
                        });

                        // Add default USD to both selects
                        fromCurrencySelect.add(new Option('USD', 'USD'), 0);
                        toCurrencySelect.add(new Option('USD', 'USD'), 0);
                    }
                })
                .catch(error => {
                    console.error('Error fetching currency rates:', error);
                });
        });
    </script>
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Currency Converter</h1>

        <form id="currency-form" action="{{ route('currency.convert') }}" method="POST">
            @csrf
            <div class="form-group row mb-3">
                <label for="amount" class="col-md-2 col-form-label">Amount:</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="amount" name="amount" value="1" step="0.01" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="from_currency" class="col-md-2 col-form-label">From:</label>
                <div class="col-md-10">
                    <select class="form-control" id="from_currency" name="from_currency" required>
                        <!-- Options will be dynamically added -->
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Convert</button>
        </form>

        @if(isset($convertedAmount))
            <h2 class="mt-4">Conversion Result</h2>
            <p>{{ $amount }} {{ $fromCurrency }} = {{ number_format($convertedAmount, 2) }} USD</p>
        @elseif(isset($error))
            <p class="text-danger">{{ $error }}</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route('currency.getCurrencyRates') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.rates) {
                        const fromCurrencySelect = document.getElementById('from_currency');
                        
                        // Populate from_currency options
                        Object.keys(data.rates).forEach(currency => {
                            const option = document.createElement('option');
                            option.value = currency;
                            option.textContent = currency;
                            fromCurrencySelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching currency rates:', error);
                });
        });
    </script>
</body>
</html>
