<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Result</title>
</head>
<body>
    <h1>Transfer Result</h1>

    @if(isset($data['error']))
        <p>Error: {{ $data['error'] }}</p>
    @else
        <pre>{{ print_r($data, true) }}</pre>
    @endif
</body>
</html>
