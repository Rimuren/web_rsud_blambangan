<!DOCTYPE html>
<html>

<head>
    <title>Status Aplikasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f8fafc;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .ok {
            color: #16a34a;
            font-weight: bold;
        }

        .bad {
            color: #dc2626;
            font-weight: bold;
        }

        .label {
            color: #64748b;
            font-size: 14px;
        }

        .value {
            font-size: 16px;
            margin-bottom: 10px;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Status Aplikasi</h1>

        <p class="value">
            Status:
            <span class="{{ $data['status'] === 'ok' ? 'ok' : 'bad' }}">
                {{ strtoupper($data['status']) }}
            </span>
        </p>

        <p class="label">App</p>
        <p class="value">{{ $data['app'] }}</p>

        <p class="label">Environment</p>
        <p class="value">{{ $data['environment'] }}</p>

        <p class="label">Timestamp</p>
        <p class="value">{{ $data['timestamp'] }}</p>

        <hr>

        <h3>Database</h3>

        <p class="value">
            Status:
            <span class="{{ $data['checks']['database']['status'] === 'ok' ? 'ok' : 'bad' }}">
                {{ strtoupper($data['checks']['database']['status']) }}
            </span>
        </p>

        <p class="label">Message</p>
        <p class="value">{{ $data['checks']['database']['message'] ?? '-' }}</p>
    </div>
</body>

</html>