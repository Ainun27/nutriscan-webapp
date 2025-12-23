<?php
$db = \Config\Database::connect();
if ($db->connID) {
    echo "Koneksi database berhasil!";
} else {
    echo "Koneksi database gagal!";
}
