<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/profile.css'); ?>">
</head>
<body>

<header>
    <h1>NutriScan</h1>
</header>

<div class="profile-container">
    <h2>Profil Pengguna</h2>
    <div class="profile-info">
        <strong>Nama:</strong> <?= esc($user['username']); ?><br>
        <strong>Email:</strong> <?= esc($user['email']); ?><br>
    </div>
    <button class="button" onclick="window.location.href='<?= base_url('edit-profile'); ?>'">Edit Profil</button>
    <button class="button" onclick="window.location.href='<?= base_url('dashboard'); ?>'">Beranda</button>
</div>

<footer>
    &copy; 2024 NutriScan
</footer>

<script src="<?= base_url('js/profile.js'); ?>"></script>

</body>
</html>
