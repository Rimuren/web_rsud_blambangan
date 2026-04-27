<!DOCTYPE html>
<html>

<head>
    <title>System Status - {{ $payload['app'] }}</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            line-height: 1.6;
        }

        .status-ok {
            color: green;
            font-weight: bold;
        }

        .status-error {
            color: red;
            font-weight: bold;
        }

        .card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            max-width: 500px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>System Status</h1>
        <p>Overall Status:
            <span class="{{ $payload['status'] == 'ok' ? 'status-ok' : 'status-error' }}">
                {{ strtoupper($payload['status']) }}
            </span>
        </p>
        <hr>
        <h3>Checks:</h3>
        <ul>
            <li>Database: {{ $payload['checks']['database']['status'] }}</li>
        </ul>
        <small>Last check: {{ $payload['timestamp'] }}</small>
    </div>
</body>

</html>