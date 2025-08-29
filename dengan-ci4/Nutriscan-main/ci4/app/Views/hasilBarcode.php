<!DOCTYPE html>
<html>
<head>
    <title>Hasil Scan</title>
    <link rel="stylesheet" href="<?= base_url('css/hasilManual.css') ?>" />
</head>
<body>
    <header>
        <h1>Hasil Pindai</h1>
    </header>

    <div class="result-container">
        <h2>Informasi Produk</h2>
        <div class="info-line">
            <span class="label">📦 Nama Produk:</span>
            <span class="value"><?= esc($data['product_name']) ?></span>
        </div>
        <div class="info-line">
            <span class="label">🍬 Gula:</span>
            <span class="value"><?= esc($data['sugars']) ?> g</span>
        </div>
        <div class="info-line">
            <span class="label">🔥 Kalori:</span>
            <span class="value"><?= esc($data['calories']) ?> kcal</span>
        </div>

        <!-- Gula indicator -->
        <?php if (is_numeric($data['sugars'])): ?>
            <?php if ($data['sugars'] > 20): ?>
                <div class="warning red"> Kandungan gula tinggi</div>
            <?php elseif ($data['sugars'] >= 10): ?>
                <div class="warning yellow"> Kandungan gula sedang</div>
            <?php else: ?>
                <div class="warning green"> Kandungan gula rendah</div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (is_numeric($data['calories'])): ?>
            <?php if ($data['calories'] > 20): ?>
                <div class="warning red"> Kandungan Kalori tinggi</div>
            <?php elseif ($data['calories'] >=10): ?>
                <div class="warning yellow"> Kandungan Kalori sedang</div>
            <?php else: ?>
                <div class="warning green"> Kandungan Kalori rendah</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="button-group">
            <button class="button" onclick="window.location.href='<?= base_url('dashboard') ?>'"> Kembali ke Beranda</button>
            <button class="button" onclick="window.location.href='<?= base_url('kamera_view') ?>'"> Pindai Lagi</button>
        </div>
    </div>


    <footer>&copy; 2024 NutriScan</footer>
</body>
</html>
