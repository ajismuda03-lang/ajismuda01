<?php
session_start();
if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Pinjaman</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 80px;">
        <h2 style="text-align: center;">Login Admin</h2>
        <form action="cek_login.php" method="POST">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 8px; margin-top: 5px;">
            </div>
            <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Login</button>
        </form>
    </div>
</body>
</html>