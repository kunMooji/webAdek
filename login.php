<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //CEK USER
    $stmt = $pdo->prepare('SELECT * FROM data_pengguna WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // CEK USER DAN PASSWORDNYA
    if ($user && $password === $user['password']) {
        $_SESSION['loggedin'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="css/LogRes.css" rel="stylesheet"> 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <?php if (isset($error)) { echo "<p class='error text-center'>$error</p>"; } ?>
        </form>
        <div class="text-center mt-3">
            <a href="register.php">Don't have an account? Register</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/scripts.js"></script>
</body>
</html>