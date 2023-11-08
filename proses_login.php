<?php
session_start();

$servername = "localhost";
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: website/index.html"); 
        exit();
    } else {
        // mengatur variabel sesi untuk menunjukkan login gagal
        $_SESSION['login_fail'] = true;
        header("Location: ../LoginDefault/index.html?error=1");
        exit();
    }
}
?>
