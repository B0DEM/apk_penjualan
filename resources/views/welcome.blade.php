<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #153040;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .welcome-container {
            background: white;
            border-radius: 20px;
            display: flex;
            width: 900px;
            height: 400px;
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        .left-section {
            background-color: #1E2B3A;
            color: white;
            padding: 60px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .left-section h2 {
            font-size: 22px;
            font-weight: bold;
        }
        .left-section p {
            font-size: 14px;
            font-style: italic;
            opacity: 0.8;
        }
        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }
        .btn-custom {
            display: inline-block;
            text-align: center;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-login {
            background: gray;
            color: white;
        }
        .btn-login:hover {
            background: darkgray;
        }
        .btn-register {
            background: green;
            color: white;
        }
        .btn-register:hover {
            background: darkgreen;
        }
        .right-section {
            background-color: white;
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .right-section img {
            width: 85%;
        }
    </style>
</head>
<body>

<div class="welcome-container">
    <div class="left-section">
        <h2>Alone we can do so little,<br>Together we can do so much</h2>
        <p>Your customer doesn’t care <br>how much you know until they <br>know how much you care</p>
        <div class="buttons">
            <a href="login" class="btn-custom btn-login">LOGIN</a>
            <a href="register" class="btn-custom btn-register">REGISTER</a>
        </div>
    </div>
    <div class="right-section">
    <img src="{{ asset('img/welcome.jpg') }}" alt="Illustration">
    </div>
</div>

</body>
</html>
