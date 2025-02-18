<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1E3A47; /* Warna background sesuai gambar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background-color: #1B2230; /* Warna navy gelap */
            padding: 30px;
            border-radius: 15px; /* Sudut membulat */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        .login-card h3 {
            color: white;
            margin-bottom: 20px;
        }

        .form-label {
            color: white;
            text-align: left;
            display: block;
        }

        .form-control {
            background-color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
        }

        .btn-login {
            width: 100%;
            background-color: gray;
            border: none;
            padding: 10px;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: darkgray;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3>LOGIN</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-login">LOGIN</button>
        </form>
    </div>

</body>
</html>
