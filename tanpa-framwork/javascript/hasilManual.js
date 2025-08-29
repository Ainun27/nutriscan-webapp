// IndexedDB Setup
let db;
const request = indexedDB.open("NutriScanDB", 1);

// Memastikan struktur database
request.onupgradeneeded = function (event) {
    db = event.target.result;
    const objectStore = db.createObjectStore("products", { keyPath: "barcode" });
    objectStore.createIndex("name", "name", { unique: false });
    objectStore.createIndex("sugars", "sugars", { unique: false });
    objectStore.createIndex("calories", "calories", { unique: false });
};

// Ketika database berhasil dimuat
request.onsuccess = function (event) {
    db = event.target.result;
    console.log("Database loaded successfully!");
    loadHistory(); // Memuat riwayat pemindaian saat database berhasil dimuat
};

// Ketika ada kesalahan membuka database
request.onerror = function (event) {
    console.error("Failed to access the database:", event.target.errorCode);
};

// Mendapatkan data dari URL (parameter query)
const params = new URLSearchParams(window.location.search);
const barcode = params.get("barcode");
const productName = params.get("product_name");
const sugars = parseFloat(params.get("sugars")) || 0;
const calories = parseFloat(params.get("calories")) || 0;

// Menampilkan data produk pada halaman
document.getElementById("barcode").textContent = barcode || "-";
document.getElementById("productName").textContent = productName || "Tidak diketahui";
document.getElementById("productSugars").textContent = sugars;
document.getElementById("productCalories").textContent = calories;

// Menentukan tingkat peringatan untuk gula
function getSugarWarningLevel(sugars) {
    if (sugars > 200) return { color: "red", message: "Peringatan Tinggi (Gula Tinggi)" };
    if (sugars > 0) return { color: "yellow", message: "Peringatan Sedang (Gula Sedang)" };
    return { color: "green", message: "Aman untuk Dikonsumsi" };
}

// Menentukan tingkat peringatan untuk kalori
function getCalorieWarningLevel(calories) {
    if (calories > 250) return { color: "red", message: "Kalori Tinggi" };
    if (calories > 150) return { color: "yellow", message: "Kalori Sedang" };
    return { color: "green", message: "Kalori Rendah" };
}

// Menampilkan peringatan gula
const sugarWarning = getSugarWarningLevel(sugars);
const calorieWarning = getCalorieWarningLevel(calories);

document.getElementById("sugarWarning").textContent = sugarWarning.message;
document.getElementById("sugarWarning").classList.add(sugarWarning.color);

document.getElementById("calorieWarning").textContent = calorieWarning.message;
document.getElementById("calorieWarning").classList.add(calorieWarning.color);

// Menyimpan data ke IndexedDB
function saveToDatabase() {
    const transaction = db.transaction(["products"], "readwrite");
    const store = transaction.objectStore("products");

    const data = { barcode, name: productName, sugars, calories };

    const request = store.get(barcode);

    request.onsuccess = function (event) {
        const existingData = event.target.result;
        if (existingData) {
            // Jika data sudah ada, perbarui data
            const updateRequest = store.put(data);
            updateRequest.onsuccess = () => {
                alert("Data berhasil diperbarui ke riwayat!");
                loadHistory();
            };
            updateRequest.onerror = () => {
                alert("Gagal memperbarui data.");
            };
        } else {
            // Jika data belum ada, tambahkan data baru
            const addRequest = store.add(data);
            addRequest.onsuccess = () => {
                alert("Data berhasil disimpan ke riwayat!");
                loadHistory();
            };
            addRequest.onerror = () => {
                alert("Data sudah ada di riwayat!");
            };
        }
    };

    request.onerror = function () {
        alert("Gagal mencari data.");
    };
}

// Memuat riwayat pemindaian dari IndexedDB
function loadHistory() {
    const transaction = db.transaction(["products"], "readonly");
    const store = transaction.objectStore("products");
    const historyList = document.getElementById("historyList");

    historyList.innerHTML = ""; // Menghapus isi riwayat sebelumnya

    store.openCursor().onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            const { barcode, name, sugars, calories } = cursor.value;
            const listItem = document.createElement("li");
            listItem.innerHTML = `
                <strong>${name}</strong> (Barcode: ${barcode})<br>
                Gula: ${sugars} gram, Kalori: ${calories} kcal
            `;
            historyList.appendChild(listItem);
            cursor.continue(); // Melanjutkan iterasi ke data berikutnya
        } else {
            // Jika tidak ada riwayat
            if (historyList.children.length === 0) {
                historyList.innerHTML = "<li>Tidak ada riwayat pemindaian.</li>";
            }
        }
    };
}
