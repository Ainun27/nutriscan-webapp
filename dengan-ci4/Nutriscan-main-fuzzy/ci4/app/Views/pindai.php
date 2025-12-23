<?php if(session()->getFlashdata('error')): ?>
<script>
    alert("<?= session()->getFlashdata('error') ?>");
    window.location.href = "<?= base_url('pindai') ?>";  // setelah klik OK redirect ke pindai.php
</script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pindai Produk - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/pindai.css') ?>">
</head>
<body>

    <header>
        <h1>NutriScan</h1>
    </header>

    <div class="container">
        <h2>Pindai Produk</h2>
        
        <div class="notification">
            Izin akses kamera diperlukan untuk pemindaian. 
        </div>

        <div class="illustration">
            <img src="<?= base_url('css/sacan.jpg') ?>" alt="Ilustrasi Pemindaian">
        </div>

        <p>Tekan tombol di bawah ini untuk memulai pemindaian barcode produk.</p>

        <a href="<?= base_url('barcode') ?>" class="button">Mulai Pemindaian</a>
        <a href="<?= base_url('dashboard') ?>" class="button">Kembali</a>
    </div>

    <footer>
        &copy; 2024 NutriScan
    </footer>

</body>
</html>
