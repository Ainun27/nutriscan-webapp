<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/dashboard.css"> 

    <?php if (session()->getFlashdata('success')) : ?>
    <script>
        alert("<?= session()->getFlashdata('success') ?>");
    </script>
    <?php endif; ?>

</head>
<body>

    <header>
        <h1>NutriScan</h1>
    </header>

    <div class="container">
        <h2>Selamat Datang di NutriScan!</h2>
        <p>Gunakan aplikasi ini untuk memindai produk dan mendapatkan informasi nutrisi.</p>
        <div class="illustration">
            <img src="/css/ntrs.jpeg" alt="Ilustrasi Pemindaian">
        </div>

        <a href="<?= base_url('pindai'); ?>" class="button">Pindai Produk</a>
        <a href="<?= base_url('history'); ?>" class="button">Riwayat Pemindaian</a>
        <a href="<?= base_url('profile'); ?>" class="button">Profil Saya</a>

    </div>

    <footer>
        &copy; 2024 NutriScan
    </footer>
</body>
</html>