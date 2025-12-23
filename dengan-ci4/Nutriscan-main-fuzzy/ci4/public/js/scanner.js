const video = document.getElementById('video');
const successIndicator = document.getElementById('successIndicator');
const goToManualInput = document.getElementById('goToManualInput');

// Memastikan elemen-elemen HTML sudah tersedia
if (!video || !successIndicator || !goToManualInput) {
    console.error('Elemen HTML yang diperlukan tidak ditemukan.');
}

// Meminta akses kamera
navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        console.error("Error accessing camera: " + err);
        alert("Gagal mengakses kamera. Pastikan kamera terhubung dan Anda memberikan izin.");
    });

// Memastikan Quagga sudah terinstal dan tersedia
if (typeof Quagga === "undefined") {
    console.error("QuaggaJS tidak ditemukan.");
} else {
    // Menggunakan QuaggaJS untuk membaca barcode
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: video // Gunakan elemen video sebagai input
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader"] // Jenis barcode yang didukung
        }
    }, function (err) {
        if (err) {
            console.error("Terjadi kesalahan saat menginisialisasi Quagga:", err);
            return;
        }
        Quagga.start();
    });

    // Menangani deteksi barcode
    Quagga.onDetected(result => {
        const barcode = result.codeResult.code; // Ambil kode barcode
        console.log("Kode Barcode:", barcode);

        // Tampilkan indikator keberhasilan
        showSuccessIndicator();

        // Ambil informasi nutrisi produk
        getNutritionInfo(barcode);
    });
}

// Menampilkan indikator pemindaian berhasil
function showSuccessIndicator() {
    successIndicator.style.display = 'block';
    setTimeout(() => {
        successIndicator.style.display = 'none';
    }, 2000);
}

// Fungsi untuk mendapatkan informasi nutrisi
function getNutritionInfo(barcode) {
    const url = `https://world.openfoodfacts.org/api/v0/product/${barcode}.json`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log to check the data structure

            if (data.status === 1 && data.product) {
                // Mengambil informasi produk dan nutrisi
                const product = data.product;
                const product_name = product.product_name || "Tidak diketahui";
                const sugars = product.nutriments?.sugars || "0";
                const calories = product.nutriments?.energy_kcal || "0";

                const queryParams = new URLSearchParams({
                    barcode,
                    product_name,
                    sugars,
                    calories,
                });
                window.location.href = `${BASE_URL}hasilManual?${queryParams.toString()}`;



            } else {
                // Jika produk tidak ditemukan, tampilkan pesan menggunakan modal atau alert
                showErrorMessage("Produk tidak ditemukan. Mohon periksa barcode Anda.");
            }
        })
        .catch(error => {
            console.error("Terjadi kesalahan:", error);
            showErrorMessage("Terjadi kesalahan saat menghubungi API. Silakan coba lagi.");
        });
}

// Fungsi untuk menampilkan pesan error dengan menggunakan alert
function showErrorMessage(message) {
    alert(message);  // Tampilkan pesan alert kepada pengguna

    // Gunakan setTimeout untuk menunda eksekusi kode setelah alert ditutup
    setTimeout(() => {
        // Redirect ke halaman dashboard setelah menekan OK di alert
        window.location.href = "dashboard.php";  // Atau bisa diganti dengan aksi lain yang diinginkan
    }, 500);  // Delay 500ms agar alert sempat ditutup sebelum eksekusi lanjut
}

// Fungsi untuk menampilkan pesan error dengan SweetAlert2
function showErrorMessage(message) {
    // Gunakan SweetAlert2 untuk menampilkan pesan kesalahan
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message,
    }).then(() => {
        // Navigasi ke halaman dashboard setelah modal ditutup
        window.location.href = "dashboard.php";
    });
}


