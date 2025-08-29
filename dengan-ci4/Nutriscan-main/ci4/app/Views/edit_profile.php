<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/editProfile.css') ?>">
</head>
<body>

<header>
    <h1>Edit Profil</h1>
</header>

<div class="form-container">
    <h2>Perbarui Informasi Anda</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form method="post" action="<?= base_url('edit-profile') ?>">
        <div class="form-group">
            <label for="username">Nama:</label>
            <input type="text" id="username" name="username" value="<?= esc($user['username']) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= esc($user['email']) ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Kata Sandi (kosongkan jika tidak ingin mengubah):</label>
            <input type="password" id="password" name="password">
        </div>
        <button class="button" type="submit">Simpan Perubahan</button>
        <button type="button" class="button" onclick="window.location.href='<?= base_url('dashboard') ?>'">
    Batal 
</button>

    </form>
</div>

<footer>
    &copy; 2024 NutriScan
</footer>

<script src="<?= base_url('javascript/editProfile.js') ?>"></script>
</body>
</html>
