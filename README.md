# 🥗 NutriScan WebApp

NutriScan adalah aplikasi web untuk **pemindaian produk makanan** berbasis barcode dengan tujuan memberikan informasi nutrisi (khususnya kadar gula & kalori) dan memberikan sistem peringatan warna (🟢 Aman, 🟡 Waspada, 🔴 Bahaya).  

Repo ini berisi **dua versi pengembangan NutriScan**:
1. 📘 **Versi Semester 3 (Tanpa Framework)** → Implementasi dasar dengan PHP Native & JavaScript.  
2. 📗 **Versi Semester 4 (Dengan CodeIgniter 4)** → Pengembangan lanjutan dengan arsitektur MVC menggunakan CI4.

---
## Dokumentasi Tampilan Halaman Web

### Halaman Registrasi
<img width="1280" height="656" alt="image" src="https://github.com/user-attachments/assets/13473b1a-55e0-4f65-8b2d-99c6a2bb10c7" />

### Halaman Login
<img width="1280" height="655" alt="image" src="https://github.com/user-attachments/assets/fb8248e2-41d8-4c8b-90ea-499dfb083a6e" />

### Halaman Utama
<img width="1200" height="1600" alt="image" src="https://github.com/user-attachments/assets/02c34d61-647b-4006-bc71-58323e434044" />

### Halaman Pilih Metode Scan
<img width="1200" height="1600" alt="image" src="https://github.com/user-attachments/assets/53920057-24ee-4036-a65f-aea3b326927d" />

### Halaman Scan Motode Camera
<img width="1331" height="634" alt="image" src="https://github.com/user-attachments/assets/e77f370b-d975-453c-b2e6-74e3cfc42c35" />

### Halaman Scan Motode Manual
<img width="1280" height="665" alt="image" src="https://github.com/user-attachments/assets/1c6b2591-e20f-428c-98c6-d3e91e35680b" />

### Halaman Hasil Scan

#### Hijau-Risiko Rendah
<img width="1334" height="638" alt="image" src="https://github.com/user-attachments/assets/3d24798e-5dea-40d4-a8c8-e2ae54c4bf52" />

#### Kuning-Risiko Sedang
<img width="1338" height="636" alt="image" src="https://github.com/user-attachments/assets/1c5adb4b-99c2-4e6b-b6ad-e7b383e779b9" />

#### Merah-Risiko Tinggi
<img width="1339" height="638" alt="image" src="https://github.com/user-attachments/assets/3dfdc4f1-914c-48fc-ba2a-6228d7f7d078" />

### Halaman Edit Profile
<img width="1280" height="661" alt="image" src="https://github.com/user-attachments/assets/251dae5f-29f2-46f6-8006-3f96012445a6" />

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
---

📌 *NutriScan adalah hasil karya & ide Ainun Dwi Permana yang terinspirasi dari aplikasi serupa.  
Proyek ini dipilih sebagai studi kasus untuk implementasi hasil pembelajaran, dengan tim berperan sebagai kolaborator teknis.*
