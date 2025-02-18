<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #153040;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .register-container {
        display: flex;
        width: 850px;
        height: 620px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    /* Bagian Kiri */
    .left-section {
        background-color: #1E2B3A;
        color: white;
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
        text-align: center;
    }

    .left-section img {
        width: 80%;
    }

    .left-section p {
        margin-top: 20px;
        font-size: 14px;
        font-style: italic;
    }

    /* Tambahan CSS untuk teks "Already have an account?" */
    .already-account {
        margin-top: 40px;
        font-size: 18px;
        font-weight: bold;
    }

    .btn-login {
        margin-top: 10px;
        background-color: gray;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
    }

    .btn-login:hover {
        background-color: darkgray;
    }

    /* Bagian Kanan */
    .right-section {
        width: 50%;
        padding: 50px;
        background-color: #1E2B3A;
        color: white;
    }

    .right-section h3 {
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px; /* Menambah jarak antar input */
    }

    .form-control {
        background-color: #2B3A4A;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 12px;
    }

    .form-control:focus {
        background-color: #2B3A4A;
        color: white;
        border-color: #5a5a5a;
        box-shadow: none;
    }

    .btn-register {
        width: 100%;
        background-color: green;
        border: none;
        padding: 12px;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        margin-top: 25px;
    }

    .btn-register:hover {
        background-color: darkgreen;
    }
</style>

</head>
<body>
    <div class="register-container">
        <div class="left-section">
            <img src="{{ asset('img/registerm.png') }}" alt="Illustration">
            <p>Success is not about how fast you reach the top,<br>but how strong you stand when you fall.<br>
            Every failure is a lesson, every struggle is a step forward.<br>
            Keep going, even when the road is tough, because greatness<br>is built through perseverance, not shortcuts.</p>
            
            <!-- Tambahkan teks "Already have an account?" -->
            <p class="already-account">Already have an account?</p>
            <a href="login" class="btn-login">LOGIN</a>
        </div>
        <div class="right-section">
            <h3>Sign Up</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nama" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" id="password-confirm" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn-register">REGISTER</button>
            </form>
        </div>
    </div>
</body>
</html>
