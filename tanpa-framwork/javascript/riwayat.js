let db;

        // Buka IndexedDB
        const request = indexedDB.open("NutriScanDB", 1);

        request.onsuccess = function (event) {
            db = event.target.result;
            loadHistory();
        };

        request.onerror = function () {
            console.error("Database gagal dibuka.");
        };

        function loadHistory() {
            const transaction = db.transaction(["products"], "readonly");
            const store = transaction.objectStore("products");
            const historyList = document.getElementById("historyList");
            historyList.innerHTML = "";

            store.openCursor().onsuccess = function (event) {
                const cursor = event.target.result;
                if (cursor) {
                    const { barcode, name, sugars, calories } = cursor.value;
                    const listItem = document.createElement("li");
                    listItem.innerHTML = `
                        <strong>${name}</strong> (Barcode: ${barcode})<br>
                        Gula: ${sugars} gram, Kalori: ${calories} kcal
                        <button class="delete-btn" onclick="deleteHistory('${barcode}')">Hapus</button>
                    `;
                    historyList.appendChild(listItem);
                    cursor.continue();
                } else if (!historyList.children.length) {
                    historyList.innerHTML = "<li>Belum ada riwayat.</li>";
                }
            };
        }

        function deleteHistory(barcode) {
            const transaction = db.transaction(["products"], "readwrite");
            transaction.objectStore("products").delete(barcode).onsuccess = () => {
                loadHistory();
            };
        }