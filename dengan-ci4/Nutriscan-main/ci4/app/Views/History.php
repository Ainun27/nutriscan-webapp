<?php if (count($history) > 0): ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pindai Produk - NutriScan</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/history.css') ?>">
</head>
<body>

    <h1>Riwayat Pemindaian Produk</h1>

    <table>
        <tr>
            <th>Barcode</th>
            <th>Nama Produk</th>
            <th>Gula</th>
            <th>Kalori</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($history as $row): ?>
        <tr>
            <td><?= esc($row['barcode']) ?></td>
            <td><?= esc($row['product_name']) ?></td>
            <td><?= esc($row['sugars']) ?></td>
            <td><?= esc($row['calories']) ?></td>
            <td><?= esc($row['scanned_at']) ?></td>
            <td>
                <form method="post" action="<?= base_url('/history/delete/' . $row['id']) ?>" onsubmit="return confirm('Yakin ingin menghapus?');">
                    <button type="submit">🗑️ Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Tombol kembali pindah ke sini -->
    <div class="button-wrapper">
        <a href="<?= base_url('/dashboard') ?>" class="back-button">← Kembali ke Beranda</a>
    </div>

<?php else: ?>
    <p class="empty-message">Tidak ada riwayat pemindaian ditemukan.</p>
    <div class="button-wrapper">
        <a href="<?= base_url('/dashboard') ?>" class="back-button"> Kembali ke Beranda</a>
    </div>
<?php endif; ?>

<footer>
    &copy; 2024 NutriScan. Seluruh hak cipta dilindungi.
</footer>

</body>
</html>
