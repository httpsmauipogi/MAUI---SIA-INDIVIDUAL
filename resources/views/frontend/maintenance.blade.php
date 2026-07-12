<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ site_setting('site_name', 'Healix HMS') }} - Under Maintenance</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0f172a;
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
            padding: 24px;
        }
        .box { max-width: 480px; }
        h1 { font-size: 28px; margin-bottom: 12px; }
        p { color: #94a3b8; line-height: 1.6; }
        .icon { font-size: 48px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="box">
        <div class="icon">🛠️</div>
        <h1>We'll be right back</h1>
        <p>{{ site_setting('site_name', 'Healix HMS') }} is currently undergoing scheduled maintenance. Please check back shortly. We apologize for the inconvenience.</p>
        @if (site_setting('phone'))
            <p>For urgent matters, call us at <strong>{{ site_setting('phone') }}</strong></p>
        @endif
    </div>
</body>
</html>
