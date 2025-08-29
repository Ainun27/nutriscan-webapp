<?php
// tes koneksi PDO langsung dari file php, non-CodeIgniter

$host = 'localhost';
$db   = 'projeks';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "Berhasil konek ke database pakai PDO!";
} catch (PDOException $e) {
    echo "Gagal konek: " . $e->getMessage();
}
