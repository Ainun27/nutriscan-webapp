# 📚 Project Semester 4 – Pemrograman Web 2

Repo ini berisi rangkaian project **Semester 4 – Pemrograman Web 2**.  
Project dikembangkan dengan pendekatan bertahap:  
1. 📰 Artikel Web (CRUD dengan CI4)  
2. 🥗 NutriScan App (versi awal, tanpa framework)  
3. 🥗 NutriScan WebApp (versi final, dengan CodeIgniter 4)

---

## 📰 1. Artikel Web (CRUD dengan CI4)
Proyek awal semester 4 untuk memahami **CodeIgniter 4** melalui aplikasi CRUD sederhana artikel.

### ✨ Fitur
- Login & autentikasi
- CRUD Artikel (Create, Read, Update, Delete)
- Pencarian artikel
- Tampilan responsive dengan Bootstrap

### 🛠️ Teknologi
- CodeIgniter 4
- PHP 8.2
- MySQL
- Bootstrap 5

---

## 🥗 2. NutriScan App (Tanpa Framework)
Implementasi pertama dari aplikasi NutriScan, dibuat dengan **PHP native + JavaScript**.  
Tujuannya membangun dasar aplikasi sebelum beralih ke framework.

### ✨ Fitur
- Register & Login sederhana
- Pemindaian barcode produk (manual / kamera)
- Informasi nutrisi (kalori, gula)
- Sistem peringatan warna (🟢🟡🔴)
- Riwayat pemindaian

### 🛠️ Teknologi
- HTML, CSS, JavaScript
- PHP native
- IndexDB
- Open Food Facts API

### 📂 Struktur
- `css/` → Styling halaman  
- `js/` → Logika interaktif  
- `html/` → Halaman aplikasi  
- `php/` → Backend sederhana  
- `assets/` → Gambar & ikon  

---

## 🥗 3. NutriScan WebApp (CI4 – Versi Final)
Versi lanjutan NutriScan yang dibangun menggunakan **CodeIgniter 4** untuk arsitektur MVC yang lebih rapi.

### ✨ Fitur
- Semua fitur dari versi sebelumnya
- Struktur MVC dengan CI4
- Pengelolaan user & history lebih terstruktur
- Desain modern & responsif
- Integrasi penuh dengan **Open Food Facts API**

### 🛠️ Teknologi
- CodeIgniter 4 (PHP 8.2)
- MySQL
- JavaScript, Bootstrap 5
- QuaggaJS (scanner barcode)
- Open Food Facts API

### 📂 Struktur (Ringkas)

- app/Controllers -> Logika aplikasi
- app/Models -> Query database
- app/Views -> Tampilan halaman
- public/ -> Aset publik (CSS, JS, Images)


---

## 📊 Database ERD (NutriScan)
**Tabel utama**:  
- `users` → menyimpan data pengguna  
- `scan_history` → menyimpan riwayat pemindaian produk  

Relasi:  
`users.id` → `scan_history.user_id` (One-to-Many)

---

## 📽️ Dokumentasi
- 🎥 Demo Video: [YouTube](https://youtu.be/oP8PMnEmvN0?si=l5yl-JjJKQHIvdDt)  
- 🎨 Mockup Design: [Figma](https://www.figma.com/design/sOzEong42y12htRO6h4Vm9/Mockup-Nutriscan?node-id=0-1)  
- 🖼️ Poster Proyek: [Poster NutriScan](https://drive.google.com/file/d/1_VvuvXlZxHOhdg1myhZWVl6iqjUjA6dV/view?usp=sharing)

---

## 👨‍💻 Tim Pengembang
**Artikel Web CI4**:  
- Ainun Dwi Permana – Fullstack  

**NutriScan App & WebApp** (Dengan Framwork):  
- Ainun Dwi Permana – Frontend & Backend  
- Agus Sunardi – Backend  
- Andhika Ulhaq Faturrahman – Database ERD  
- Suci Maolia – Backend  

---

📌 *Seluruh project ini merupakan bagian dari mata kuliah **Pemrograman Web 2 – Semester 4 (Teknik Informatika)**.*

