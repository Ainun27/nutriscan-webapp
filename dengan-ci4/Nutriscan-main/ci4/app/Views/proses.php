<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Proses Pemindaian - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/proses.css') ?>" />
    <script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>
</head>
<body>

<header>
    <h1>NutriScan</h1>
</header>

<div class="camera-container">
    <video id="video" autoplay></video>
    <div class="overlay">
        <div class="instruction">Arahkan barcode ke tengah layar</div>
        <div class="success-indicator" id="successIndicator" style="display: none;">Barcode Terbaca!</div>
    </div>
    <div class="error-message" id="cameraError" style="display: none;">
        Gagal mengakses kamera. Mohon periksa izin akses kamera.
    </div>
</div>

<div class="buttons-container">
    <a href="<?= base_url('manual') ?>" class="button" id="manualButton">Pindai Manual</a>
    <a href="<?= base_url('dashboard') ?>" class="button" id="backButton">Kembali ke Beranda</a>
</div>

<!-- Inisialisasi BASE_URL untuk JS -->
<script>
    const BASE_URL = "<?= base_url() ?>";
</script>

<!-- File JavaScript Scanner -->
<script src="<?= base_url('js/scanner.js') ?>"></script>

</body>
</html>
