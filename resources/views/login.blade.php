<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Đăng Nhập</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 500px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Đăng Nhập</h2>
            <p>Vui lòng nhập thông tin của bạn</p>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="username">Tên người dùng</label>
                <input type="email" class="form-control" id="username" name="email" required />
                @error('email')
                    <small class="text-danger validate-error">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required />
                @error('password')
                    <small class="text-danger validate-error">{{ $message }}</small>
                @enderror
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="#">Quên mật khẩu?</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
