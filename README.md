# 🥗 NutriScan WebApp

NutriScan adalah aplikasi web untuk **pemindaian produk makanan** berbasis barcode dengan tujuan memberikan informasi nutrisi (khususnya kadar gula & kalori) dan memberikan sistem peringatan warna (🟢 Aman, 🟡 Waspada, 🔴 Bahaya).  

Repo ini berisi **dua versi pengembangan NutriScan**:
1. 📘 **Versi Semester 3 (Tanpa Framework)** → Implementasi dasar dengan PHP Native & JavaScript.  
2. 📗 **Versi Semester 4 (Dengan CodeIgniter 4)** → Pengembangan lanjutan dengan arsitektur MVC menggunakan CI4.  

---

## 📌 Catatan Penting
💡 **Ide, konsep, dan rancangan NutriScan berasal dari Ainun Dwi Permana.**  
Meskipun **terinspirasi dari aplikasi serupa yang sudah ada**, NutriScan dibuat sebagai **studi kasus implementasi hasil belajar** dalam mata kuliah.  
Tim pengembang lain berperan sebagai kolaborator dalam tahap implementasi & pengembangan teknis.  

---

## 🚀 Fitur Utama
### Semester 3 – Tanpa Framework
- Login & Registrasi sederhana  
- Pemindaian barcode (manual / kamera)  
- Menampilkan informasi nutrisi produk  
- Sistem peringatan warna (gula & kalori)  
- Penyimpanan riwayat scan  

### Semester 4 – Dengan CI4
- Semua fitur dari versi Semester 3  
- Struktur MVC yang lebih terorganisir  
- Manajemen pengguna lebih rapi  
- Integrasi penuh dengan **Open Food Facts API**  
- Tampilan modern & responsif dengan Bootstrap  
- Dokumentasi & ERD untuk database  

---

## 🛠️ Tech Stack
- **Semester 3**: HTML, CSS, JavaScript, IndexedDB  
- **Semester 4**: CodeIgniter 4, PHP 8.2, MySQL, Bootstrap 5, QuaggaJS, Open Food Facts API  

---

## 📊 Database (ERD – Semester 4)
- **Users**: id, username, email, password, created_at  
- **ScanHistory**: id, user_id, barcode, product_name, sugars, calories, scanned_at  
(Relasi: `users.id` → `scan_history.user_id`)  

---

## 👨‍💻 Pengembang
- **Ainun Dwi Permana** – *Founder & Original Creator* (Ide, Konsep, Rancangan, Fullstack Dev)  
- **Agus Sunardi** – Backend Developer (kontributor)  
- **Andhika Ulhaq Faturrahman** – Database & ERD (kontributor)  
- **Dita Tiara Putri** – Frontend (kontributor)  
- **Nur Laila** – Frontend (kontributor)  
- **Suci Maolia** – Backend (kontributor)  

---

📌 *NutriScan adalah hasil karya & ide Ainun Dwi Permana yang terinspirasi dari aplikasi serupa.  
Proyek ini dipilih sebagai studi kasus untuk implementasi hasil pembelajaran, dengan tim berperan sebagai kolaborator teknis.*
