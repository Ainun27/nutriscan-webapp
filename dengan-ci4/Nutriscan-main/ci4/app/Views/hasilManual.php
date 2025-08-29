<?php if (isset($found) && $found === false): ?>
<script>
    alert('Produk tidak ditemukan. Silakan coba pindai ulang.');
    window.location.href = '<?= base_url('pindai') ?>';
</script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hasil Pemindaian - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet" />
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
            <span class="value"><?= esc($product_name) ?></span>
        </div>
        <div class="info-line">
            <span class="label">🍬 Gula:</span>
            <span class="value"><?= esc($sugars) ?> g</span>
        </div>
        <div class="info-line">
            <span class="label">🔥 Kalori:</span>
            <span class="value"><?= esc($calories) ?> kcal</span>
        </div>

        <!-- Gula indicator -->
        <?php if (is_numeric($sugars)): ?>
            <?php if ($sugars > 20): ?>
                <div class="warning red"> Kandungan gula tinggi</div>
            <?php elseif ($sugars >= 10): ?>
                <div class="warning yellow"> Kandungan gula sedang</div>
            <?php else: ?>
                <div class="warning green"> Kandungan gula rendah</div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (is_numeric($calories)): ?>
            <?php if ($calories > 20): ?>
                <div class="warning red"> Kandungan Kalori tinggi</div>
            <?php elseif ($calories >= 10): ?>
                <div class="warning yellow"> Kandungan Kalori sedang</div>
            <?php else: ?>
                <div class="warning green"> Kandungan Kalori rendah</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="button-group">
            <button class="button" onclick="window.location.href='<?= base_url('dashboard') ?>'"> Kembali ke Beranda</button>
            <button class="button" onclick="window.location.href='<?= base_url('proses') ?>'"> Pindai Lagi</button>
        </div>
    </div>

    <footer>&copy; 2024 NutriScan</footer>
</body>
</html>
