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

    <style>
        /* CARD FUZZY BARU — VISUAL LEBIH BAGUS */
        .fuzzy-card {
            margin-top: 25px;
            padding: 20px;
            border-radius: 18px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            border-left: 8px solid;
            animation: fadeIn 0.4s ease-in-out;
        }
        .fuzzy-icon {
            font-size: 38px;
        }
        .fuzzy-title {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }
        .fuzzy-value {
            margin: 4px 0 10px;
            font-size: 15px;
            color: #333;
        }
        .fuzzy-desc {
            margin: 0;
            font-size: 14px;
            opacity: 0.8;
        }
        .fuzzy-card.green {
            background: #eaffea;
            border-left-color: #4CAF50;
        }
        .fuzzy-card.yellow {
            background: #fff9e6;
            border-left-color: #ffcc33;
        }
        .fuzzy-card.red {
            background: #ffeaea;
            border-left-color: #ff4444;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

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

    <!-- ============================= -->
    <!-- LOGIKA FUZZY NUTRIScan -->
    <!-- ============================= -->
    <?php  
    $g = floatval($sugars);
    $k = floatval($calories);

    // Membership Gula
    function gula_rendah($x){ if($x <= 5) return 1; if($x <= 8) return (8-$x)/3; return 0; }
    function gula_sedang($x){ if($x > 5 && $x <= 10) return ($x-5)/5; if($x > 10 && $x <=15) return (15-$x)/5; return 0; }
    function gula_tinggi($x){ if($x >= 20) return 1; if($x >=12) return ($x-12)/8; return 0; }

    // Membership Kalori
    function kalori_rendah($x){ if($x <=40) return 1; if($x <=60) return (60-$x)/20; return 0; }
    function kalori_sedang($x){ if($x >40 && $x <=70) return ($x-40)/30; if($x >70 && $x <=100) return (100-$x)/30; return 0; }
    function kalori_tinggi($x){ if($x >=130) return 1; if($x >=90) return ($x-90)/40; return 0; }

    // Hitung membership
    $gLow = gula_rendah($g); $gMed = gula_sedang($g); $gHigh = gula_tinggi($g);
    $kLow = kalori_rendah($k); $kMed = kalori_sedang($k); $kHigh = kalori_tinggi($k);

    // RULES
    $weights = []; $outputs = [];

    $r1 = max($gHigh, $kHigh); if($r1>0){ $weights[]=$r1; $outputs[]=90; }
    $r2 = max($gMed, $kMed); if($r2>0){ $weights[]=$r2; $outputs[]=60; }
    $r3 = min($gLow, $kLow); if($r3>0){ $weights[]=$r3; $outputs[]=20; }
    $r4 = min($gHigh, $kLow); if($r4>0){ $weights[]=$r4; $outputs[]=60; }
    $r5 = min($gLow, $kMed); if($r5>0){ $weights[]=$r5; $outputs[]=60; }
    $r6 = min($gMed, $kLow); if($r6>0){ $weights[]=$r6; $outputs[]=60; }

    // DEFUZZIFIKASI
    if(array_sum($weights)==0){
        $defuzz = 20;
    } else {
        $sum=0;
        foreach($weights as $i=>$w){ $sum += $w * $outputs[$i]; }
        $defuzz = $sum / array_sum($weights);
    }

    // FIX RANGE
    if($defuzz <20) $defuzz=20;
    if($defuzz >90) $defuzz=90;

    // Label
    if($defuzz >=70){ $fuzzy_label="Risiko Tinggi"; $fuzzy_color="red"; }
    elseif($defuzz >=40){ $fuzzy_label="Risiko Sedang"; $fuzzy_color="yellow"; }
    else { $fuzzy_label="Risiko Rendah"; $fuzzy_color="green"; }
    ?>

    <!-- ============================= -->
    <!-- OUTPUT FUZZY CARD BARU -->
    <!-- ============================= -->
    <div class="fuzzy-card <?= $fuzzy_color ?>">
        <div class="fuzzy-icon">⚙️</div>
        <div>
            <h3 class="fuzzy-title"><?= $fuzzy_label ?></h3>
            <p class="fuzzy-value">Nilai Fuzzy: <strong><?= round($defuzz,2) ?></strong></p>
            <p class="fuzzy-desc">
                <?= $fuzzy_label == "Risiko Tinggi" ? "Produk ini memiliki risiko tinggi terkait kandungan gula dan kalori." : "" ?>
                <?= $fuzzy_label == "Risiko Sedang" ? "Produk ini berada pada kategori sedang, konsumsi sebaiknya dibatasi." : "" ?>
                <?= $fuzzy_label == "Risiko Rendah" ? "Produk ini aman dikonsumsi, kandungan nutrisi tergolong rendah." : "" ?>
            </p>
        </div>
    </div>


    <div class="button-group">
        <button class="button" onclick="window.location.href='<?= base_url('dashboard') ?>'"> Kembali ke Beranda</button>
        <button class="button" onclick="window.location.href='<?= base_url('proses') ?>'"> Pindai Lagi</button>
    </div>
</div>

<footer>&copy; 2024 NutriScan</footer>

</body>
</html>
