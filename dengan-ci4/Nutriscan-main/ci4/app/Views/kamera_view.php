<!DOCTYPE html>
<html>
<head>
    <title>Scan Barcode</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= base_url('css/proses.css')?>" />
</head>
<body>
    <header>
        <h1>NutriScan</h1>
    </header>

    <div class="camera-container">
        <video id="video" autoplay></video>
        <div class="overlay">
            <div class="instruction">Arahkan barcode ke tengah layar</div>
            <div id="successIndicator" style="display:none; color: green;">✔️ Barcode berhasil dibaca!</div>
        </div>
    </div>

    <div class="buttons-container">
    <a href="<?= base_url('manual') ?>" class="button" id="manualButton">Pindai Manual</a>
    <a href="<?= base_url('dashboard') ?>" class="button" id="backButton">Kembali ke Beranda</a>
    </div>

    <script>
        const video = document.getElementById('video');
        const successIndicator = document.getElementById('successIndicator');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert("Gagal mengakses kamera.");
            });

        if (typeof Quagga !== "undefined") {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: video
                },
                decoder: {
                    readers: ["code_128_reader", "ean_reader"]
                }
            }, function (err) {
                if (err) {
                    console.error(err);
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected(result => {
                const barcode = result.codeResult.code;
                showSuccessIndicator();
                getNutritionInfo(barcode);
                Quagga.stop(); // Hentikan scan setelah satu deteksi
            });
        }

        function showSuccessIndicator() {
            successIndicator.style.display = 'block';
            setTimeout(() => {
                successIndicator.style.display = 'none';
            }, 2000);
        }

        function getNutritionInfo(barcode) {
            const url = `https://world.openfoodfacts.org/api/v0/product/${barcode}.json`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 1 && data.product) {
                        const product = data.product;
                        const product_name = product.product_name || "Tidak diketahui";
                        const sugars = product.nutriments?.sugars || "0";
                        const calories = product.nutriments?.energy_kcal || "0";

                        // Kirim ke server CI4
                        fetch('<?= base_url('barcode/save') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                barcode,
                                product_name,
                                sugars,
                                calories
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success && res.redirect ) {
                                window.location.href = res.redirect;
                            } else {
                                Swal.fire("Gagal", res.message, "error");
                            }
                        })
                        .catch(error => {
                            Swal.fire("Error", "Gagal menyimpan data.", "error");
                        });
                    } else {
                        Swal.fire("Tidak Ditemukan", "Produk tidak ditemukan!", "warning");
                    }
                });
        }
    </script>
</body>
</html>
