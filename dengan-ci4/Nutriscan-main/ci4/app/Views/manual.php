<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pindai Manual - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/manual.css') ?>" />
</head>
<body>
    <header>
        <h1>Pindai Manual</h1>
    </header>

    <div class="manual-container">
        <form action="<?= base_url('hasilManual') ?>" method="GET">
            <label for="barcodeInput">Masukkan Barcode Produk:</label>
            <input type="text" id="barcodeInput" name="barcode" placeholder="Contoh: 1234567890123" required />
            <button type="submit" id="searchButton">Cari Produk</button>
        </form>
    </div>

    <a href="<?= base_url('dashboard') ?>" class="back-button">Kembali ke Beranda</a>

    <footer>
        <p>&copy; 2024 NutriScan</p>
    </footer>
</body>
</html>
