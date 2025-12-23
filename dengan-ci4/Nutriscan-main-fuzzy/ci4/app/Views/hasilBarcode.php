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


    <!-- ============================= -->
    <!-- LOGIKA FUZZY (GULA & KALORI) -->
    <!-- ============================= -->
    <?php
    $g = floatval($data['sugars']);
    $k = floatval($data['calories']);

    // -------------------------------
    // Membership Function Gula
    // -------------------------------
    function gula_rendah($x){
        if($x <= 5) return 1;
        if($x <= 8) return (8 - $x)/3;
        return 0;
    }
    function gula_sedang($x){
        if($x > 5 && $x <= 10) return ($x - 5)/5;
        if($x > 10 && $x <= 15) return (15 - $x)/5;
        return 0;
    }
    function gula_tinggi($x){
        if($x >= 20) return 1;
        if($x >= 12) return ($x - 12)/8;
        return 0;
    }

    // -------------------------------
    // Membership Function Kalori
    // -------------------------------
    function kalori_rendah($x){
        if($x <= 40) return 1;
        if($x <= 60) return (60 - $x)/20;
        return 0;
    }
    function kalori_sedang($x){
        if($x > 40 && $x <= 70) return ($x - 40)/30;
        if($x > 70 && $x <= 100) return (100 - $x)/30;
        return 0;
    }
    function kalori_tinggi($x){
        if($x >= 130) return 1;
        if($x >= 90) return ($x - 90)/40;
        return 0;
    }

    // -------------------------------
    // Degree Membership
    // -------------------------------
    $gLow  = gula_rendah($g);
    $gMed  = gula_sedang($g);
    $gHigh = gula_tinggi($g);

    $kLow  = kalori_rendah($k);
    $kMed  = kalori_sedang($k);
    $kHigh = kalori_tinggi($k);

    // -------------------------------
    // Fuzzy Rules (Sugeno)
    // -------------------------------
    $rules   = [];
    $weights = [];

    // 1. Gula tinggi OR kalori tinggi → risiko tinggi
    $r1 = max($gHigh, $kHigh);
    $weights[] = $r1;  
    $rules[]   = $r1 * 90;

    // 2. Gula sedang OR kalori sedang → risiko sedang
    $r2 = max($gMed, $kMed);
    $weights[] = $r2;
    $rules[]   = $r2 * 60;

    // 3. Gula rendah AND kalori rendah → risiko rendah
    $r3 = min($gLow, $kLow);
    $weights[] = $r3;
    $rules[]   = $r3 * 20;

    // 4. Gula tinggi AND kalori rendah → risiko sedang
    $r4 = min($gHigh, $kLow);
    $weights[] = $r4;
    $rules[]   = $r4 * 60;

    // 5. Gula rendah AND kalori sedang → risiko sedang
    $r5 = min($gLow, $kMed);
    $weights[] = $r5;
    $rules[]   = $r5 * 60;

    // 6. Gula sedang AND kalori rendah → risiko sedang
    $r6 = min($gMed, $kLow);
    $weights[] = $r6;
    $rules[]   = $r6 * 60;

    // -------------------------------
    // Defuzzifikasi
    // -------------------------------
    $defuzz = (array_sum($rules) / array_sum($weights));

    // Tentukan label + warna
    if($defuzz >= 70){
        $fuzzy_label = "Risiko Tinggi";
        $fuzzy_color = "red";
    } elseif($defuzz >= 40){
        $fuzzy_label = "Risiko Sedang";
        $fuzzy_color = "yellow";
    } else {
        $fuzzy_label = "Risiko Rendah";
        $fuzzy_color = "green";
    }
    ?>

    <!-- ============================= -->
    <!-- OUTPUT DARI FUZZY -->
    <!-- ============================= -->
    <div class="warning <?= $fuzzy_color ?>">
        ⚙️ <strong><?= $fuzzy_label ?></strong>  
        (<?= round($defuzz, 2) ?>)
    </div>


    <div class="button-group">
        <button class="button" onclick="window.location.href='<?= base_url('dashboard') ?>'"> Kembali ke Beranda</button>
        <button class="button" onclick="window.location.href='<?= base_url('kamera_view') ?>'"> Pindai Lagi</button>
    </div>
</div>

<footer>&copy; 2024 NutriScan</footer>
</body>
</html>
