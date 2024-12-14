# OG War Rig  
**E-Commerce Platform for Selling Computer Components**  

![License](https://img.shields.io/badge/license-MIT-green)  
OG War Rig adalah platform e-commerce yang dirancang untuk menjual komponen komputer. Aplikasi ini mencakup berbagai fitur seperti manajemen pengguna, manajemen produk, pemrosesan pesanan, dan sistem pelaporan untuk admin.

---

## 📝 Fitur  
- **Manajemen Pengguna:** Registrasi, login, dan pengelolaan profil pengguna.  
- **Manajemen Produk:** Menambah, mengedit, dan menghapus produk dari katalog.  
- **Pemrosesan Pesanan:** Menangani keranjang belanja, checkout, dan riwayat pesanan.  
- **Review Produk:** Pengguna dapat memberikan ulasan untuk produk yang dibeli.  
- **Sistem Pelaporan:** Laporan penjualan dan aktivitas pengguna untuk admin.  

---

## 🚀 Instalasi  
1. Clone repositori ini:  
   ```bash
   git clone https://github.com/habstrakT808/COMPUTER-E-COMMERCE-WITH-PHP-MVC.git
   cd COMPUTER-E-COMMERCE-WITH-PHP-MVC
   ```  
2. Buat database dan impor tabel dari file `database.sql`.  
3. Konfigurasi koneksi database di `includes/db_connect.php`:  
   ```php
   <?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "og_war_rig";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```  
4. Jalankan server lokal Anda (misalnya, menggunakan XAMPP atau WAMP).  
5. Buka aplikasi di browser:  
   ```
   http://localhost/COMPUTER-E-COMMERCE-WITH-PHP-MVC
   ```  

---

## 🛠️ Tools & Teknologi  
- **Bahasa Pemrograman:** PHP, HTML, CSS, JavaScript  
- **Database:** MySQL  
- **Framework:** Bootstrap (untuk UI)  
- **IDE:** Visual Studio Code atau IDE lain yang Anda sukai  

---

## 📂 Struktur Proyek  
```
OG War Rig/
├── admin/
│   ├── admin_edit_products.php
│   ├── admin_manage_products.php
│   ├── admin_manage_users.php
│   ├── admin_orders.php
│   ├── admin_reports.php
│   └── ...
├── includes/
│   ├── db_connect.php
│   ├── functions.php
│   └── ...
├── templates/
│   ├── header.php
│   ├── footer.php
│   └── ...
├── aboutus.php
├── contactus.php
├── index.php
├── product_catalog.php
├── cart.php
└── ...
```

---

## 💡 Peningkatan di Masa Depan  
- Implementasi notifikasi untuk pesanan baru.  
- Penambahan fitur wishlist untuk pengguna.  
- Integrasi dengan gateway pembayaran.  
- Optimasi SEO untuk meningkatkan visibilitas di mesin pencari.  

---

## 🔑 Lisensi  
Proyek ini dilisensikan di bawah lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.  

---

## 🖼️ Tangkapan Layar
### BEBERAPA HALAMAN BELUM DITAMPILKAN
| Halaman Utama | Halaman Daftar Produk | Halaman Detail Produk |  
|---------------|----------------|-------------------|  
| ![Halaman Utama](https://github.com/user-attachments/assets/34109aaa-c09a-44d6-8bee-297e408f4e21) | ![Halaman Daftar Barang](https://github.com/user-attachments/assets/1ff44ba1-ba5e-4959-b059-d467c96bb4bf) | ![Halaman Detail Barang](https://github.com/user-attachments/assets/01ecba06-7233-412b-b3de-f0ec63cfe21b) |  

| Halaman Keranjang | Halaman Checkout | Halaman Profil |  
|------------------|---------------|-----------------|  
| ![Halaman Kerangjang](https://github.com/user-attachments/assets/9c2e0b9d-79e2-43f6-b41e-9de3e3634c6e) | ![Halaman Payment](https://github.com/user-attachments/assets/9ea97295-65de-4f44-81df-b5d0709236cb) | ![Halaman Edit Profil](https://github.com/user-attachments/assets/0e33424d-2445-49ea-89c8-c461514d09d7) |  

---

## 🙌 Kontribusi  
Kontribusi sangat diterima!  
- Fork repositori ini.  
- Buat branch baru untuk fitur/perbaikan Anda:  
  ```bash
  git checkout -b nama-fitur
  ```  
- Commit perubahan Anda dan push ke branch Anda:  
  ```bash
  git push origin nama-fitur
  ```  
- Buat pull request.  

---

## 🧑‍💻 Penulis  
**Hafiyan Al Muqaffi Umary**  
[GitHub](https://github.com/habstrakT808) | [LinkedIn](#)  

---

Jika Anda membutuhkan bantuan lebih lanjut untuk mengisi placeholder gambar atau informasi lainnya, beri tahu saya!
