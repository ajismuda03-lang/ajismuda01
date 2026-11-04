<?php
session_start();
include '../database/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>
            alert('Username atau Password salah!');
            window.location.href = 'login.php';
        </script>";
    }
}
?>