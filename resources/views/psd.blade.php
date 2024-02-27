<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSD Data</title>
</head>
<body>
    <h1>PSD Data</h1>

    @if(isset($psdData))
        <pre>{{ json_encode($psdData, JSON_PRETTY_PRINT) }}</pre>
    @elseif(isset($error))
        <p>Error: {{ $error }}</p>
    @endif
</body>
</html>
