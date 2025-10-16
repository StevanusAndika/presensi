# 📚 API Presensi Laravel - Dokumentasi

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![API](https://img.shields.io/badge/API-RESTful-success?style=for-the-badge)

## 📋 Deskripsi Proyek

API Presensi Laravel adalah sistem manajemen kehadiran yang komprehensif untuk mengatur data pengguna, jadwal kehadiran standar, dan pencatatan presensi harian. Sistem ini menyediakan endpoint RESTful API yang mudah diintegrasikan dengan berbagai frontend.

## ✨ Fitur Utama

### 👥 Manajemen Pengguna
- ✅ Tambah, lihat, edit, hapus data pengguna
- ✅ Autentikasi berbasis NIP dan sandi
- ✅ Level akses pengguna yang dapat dikustomisasi

### 📅 Peta Kehadiran
- ✅ Atur jam masuk dan pulang untuk setiap hari (Senin-Minggu)
- ✅ Jadwal fleksibel dengan nomor hari 1-7
- ✅ Management jadwal standar kehadiran

### ✅ Presensi Harian
- ✅ Pencatatan waktu masuk dan pulang
- ✅ Tracking IP address untuk keamanan
- ✅ Integrasi dengan jadwal standar
- ✅ Keterangan hari (Hari kerja/Libur)

## 🚀 Instalasi dan Setup

### Prerequisites
- PHP 8.0+
- Composer
- MySQL 5.7+
- Laravel 9.x

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/your-username/presensi-api-laravel.git
cd presensi-api-laravel
```

2. **Install Dependencies**
```bash
composer install
```

3. **Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=presensi_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Jalankan Migrasi**
```bash
php artisan migrate
php artisan db:seed
```

6. **Jalankan Server**
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 📚 Dokumentasi API

### Base URL
```
http://localhost:8000/api
```

### 🔗 Koleksi Postman

File koleksi Postman tersedia di: 
[`Presensi API Laravel.postman_collection.json`](Presensi%20API%20Laravel.postman_collection.json)

### Endpoint Groups

#### 👥 Manajemen Pengguna

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/pengguna/list-data` | Ambil semua data pengguna |
| `POST` | `/pengguna/simpan-data` | Tambah pengguna baru |
| `GET` | `/pengguna/ambil-data/{nip}` | Ambil data pengguna by NIP |
| `DELETE` | `/pengguna/hapus-data/{nip}` | Hapus data pengguna |
| `GET` | `/pengguna/cek-koneksi` | Cek koneksi database |

#### 📅 Peta Kehadiran

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/peta-kehadiran/list-data` | Ambil semua jadwal |
| `POST` | `/peta-kehadiran/simpan-data` | Tambah jadwal baru |
| `GET` | `/peta-kehadiran/ambil-data/{id}` | Ambil jadwal by ID |
| `DELETE` | `/peta-kehadiran/hapus-data/{id}` | Hapus jadwal |

#### ✅ Presensi Harian

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `GET` | `/presensi-harian/list-data` | Ambil semua presensi |
| `POST` | `/presensi-harian/simpan-data` | Catat presensi baru |
| `DELETE` | `/presensi-harian/hapus-data/{id}` | Hapus data presensi |
| `GET` | `/presensi-harian/cek-koneksi` | Cek koneksi database |

## 💻 Dokumentasi Interaktif

### Tampilan Web Documentation

Proyek ini menyertakan dokumentasi interaktif yang dapat diakses melalui browser:

1. **Akses Dokumentasi**: Buka `http://localhost:8000` setelah menjalankan server
2. **Fitur Dokumentasi**:
   - 🎨 Tema dark/light mode
   - ⚡ Testing endpoint langsung dari browser
   - 📱 Responsive design
   - 📋 Copy-paste contoh kode
   - 🔍 Format JSON response yang rapi


## 🗃️ Struktur Database

### Tabel `pengguna`
| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | BIGINT | Primary key |
| `nip` | VARCHAR | Nomor Induk Pegawai (unique) |
| `nama` | VARCHAR | Nama lengkap pengguna |
| `level` | VARCHAR | Level akses (A, B, C, dll) |
| `sandi` | VARCHAR | Password terenkripsi |

### Tabel `peta_kehadiran`
| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | BIGINT | Primary key |
| `no_hari` | TINYINT | Nomor hari (1-7) |
| `jam_masuk` | TIME | Jam masuk standar |
| `jam_keluar` | TIME | Jam pulang standar |

### Tabel `presensi_harian`
| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | BIGINT | Primary key |
| `tgl_masuk` | DATETIME | Waktu masuk |
| `tgl_pulang` | DATETIME | Waktu pulang |
| `ket_hari` | VARCHAR | Keterangan hari |
| `nip` | VARCHAR | NIP pengguna |
| `ip_masuk` | VARCHAR | IP address saat masuk |
| `ip_keluar` | VARCHAR | IP address saat pulang |
| `peta_kehadiran_id` | BIGINT | Foreign key ke jadwal |

## 🔧 Penggunaan API

### Contoh Request

#### 1. Tambah Pengguna Baru
```http
POST /api/pengguna/simpan-data
Content-Type: application/json

{
    "nip": "123456789",
    "nama": "Stevanus Andika Galih Setiawan",
    "level": "A",
    "sandi": "Andi124443"
}
```

#### 2. Buat Jadwal Kehadiran
```http
POST /api/peta-kehadiran/simpan-data
Content-Type: application/json

{
    "no_hari": 1,
    "jam_masuk": "07:00:00",
    "jam_keluar": "17:00:00"
}
```

#### 3. Catat Presensi
```http
POST /api/presensi-harian/simpan-data
Content-Type: application/json

{
    "tgl_masuk": "2024-01-16 08:05:00",
    "tgl_pulang": "2024-01-16 17:10:00",
    "ket_hari": "H",
    "nip": "123456789",
    "ip_masuk": "192.168.1.101",
    "ip_keluar": "192.168.1.101",
    "peta_kehadiran_id": 1,
    "jam_harus_masuk": "08:00:00",
    "jam_harus_pulang": "17:00:00"
}
```

### Contoh Response
```json
{
    "status": "success",
    "data": {
        "id": 1,
        "nip": "123456789",
        "nama": "Stevanus Andika Galih Setiawan",
        "level": "A",
        "created_at": "2024-01-16T10:30:00.000000Z",
        "updated_at": "2024-01-16T10:30:00.000000Z"
    },
    "message": "Data berhasil disimpan"
}
```

## 🛠️ Development

### Menjalankan Tests
```bash
php artisan test
```

### Menjalankan Seeder
```bash
php artisan db:seed
```

### Generate Documentation
```bash
# Generate API documentation
php artisan l5-swagger:generate
```

### Code Style
```bash
# Fix code style
./vendor/bin/pint
```

## 📦 Dependencies

### Main Dependencies
- **Laravel 9.x** - PHP Framework
- **MySQL** - Database
- **Bootstrap 5** - Frontend Framework
- **Font Awesome** - Icons

### Development Dependencies
- **PHPUnit** - Testing
- **Laravel Sail** - Docker development
- **Laravel Sanctum** - API Authentication

## 🔐 Keamanan

- Validasi input pada semua endpoint
- Enkripsi password menggunakan bcrypt
- Protection terhadap SQL injection
- CORS configuration
- IP address tracking untuk audit

## 🤝 Kontribusi

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 Lisensi

Distributed under the MIT License. See `LICENSE` for more information.

## 👨‍💻 Developer

**Stevanus Andika Galih Setiawan**
- Email: your.email@example.com
- GitHub: [@yourusername](https://github.com/yourusername)

## 🆕 Changelog

### v1.0.0 (2025-10-16)
- ✅ Initial release
- ✅ CRUD operations for all entities
- ✅ Interactive documentation
- ✅ Postman collection
- ✅ Dark/Light theme support

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

1. 📧 Email: stevcomp58@gmail.com
2. 🐛 Issues: [GitHub Issues](https://github.com/StevanusAndika)
3. 💬 Discussion: [GitHub Discussions](https://github.com/StevanusAndika)

---

<div align="center">

**⭐ Jangan lupa beri bintang pada repository ini jika project ini membantu Anda!**

</div>
