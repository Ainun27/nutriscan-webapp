const searchButton = document.getElementById("searchButton");
const barcodeInput = document.getElementById("barcodeInput");

searchButton.addEventListener("click", () => {
const barcode = barcodeInput.value.trim();

if (barcode === "") {
    alert("Mohon masukkan barcode terlebih dahulu!");
    return;
}

const url = `https://world.openfoodfacts.org/api/v0/product/${barcode}.json`;

fetch(url)
    .then((response) => response.json())
    .then((data) => {
    if (data.status === 1) {
        const product = data.product;
        const queryParams = new URLSearchParams({
        barcode,
        product_name: product.product_name || "Tidak diketahui",
        sugars: product.nutriments.sugars || "0",
        calories: product.nutriments.energy_kcal || "0",
        });
        window.location.href = `/html/hasilManual.html?${queryParams.toString()}`;
    } else {
        alert("Produk tidak ditemukan. Mohon periksa barcode Anda.");
    }
    })
    .catch((error) => {
    console.error("Terjadi kesalahan:", error);
    alert("Terjadi kesalahan saat menghubungi API. Silakan coba lagi.");
    });
});
