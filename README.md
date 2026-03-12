# ☕ Mau Kopi

Web ordering system untuk kedai kopi lokal **Mau Kopi**, Malang — Jawa Timur.

---

## Tentang Project

Mau Kopi adalah aplikasi pemesanan berbasis web yang memungkinkan pelanggan melihat menu, memilih item, dan melakukan pembayaran secara mandiri. Dibangun menggunakan Laravel 11 dengan tampilan yang direkonstruksi dari desain Figma.

---

## Fitur

- 🍽️ Halaman menu dengan kategori (Coffee, Non-Coffee, Food, Desserts, Snacks)
- 🛒 Keranjang belanja dengan update qty real-time
- 📋 Halaman checkout dengan pilihan metode pembayaran dan tipe pesanan
- 💳 Status pembayaran (Cash dengan countdown timer, QRIS/Transfer)
- ✅ Halaman sukses dan struk digital
- ❌ Halaman gagal dengan opsi kembali ke checkout

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 11 |
| Templating | Blade |
| Styling | TailwindCSS (CDN) |
| Session | Laravel Session (tanpa database) |
| Font | Inter (Google Fonts) |

---

## Cara Menjalankan

```bash
# 1. Clone repo
git clone https://github.com/VeelsaSelf/Virtual-Queue-Mau-Kopi.git
cd Virtual-Queue-Mau-Kopi

# 2. Install dependencies
composer install

# 3. Copy .env
cp .env.example .env

# 4. Generate key
php artisan key:generate

# 5. Jalankan server
php artisan serve
```

Buka browser ke `http://127.0.0.1:8000`

---

## Struktur Halaman

```
/                        → Menu utama
/menu/{slug}             → Detail menu
/cart                    → Keranjang
/checkout                → Checkout
/payment/{id}            → Status pembayaran
/payment/{id}/receipt    → Struk
```

---

## Informasi Kedai

**Mau Kopi**  
22 Jalan Tanimbar, Malang, Jawa Timur  
Senin – Sabtu, 09.00 – 17.00

---

## Lisensi

Project ini dibuat untuk keperluan UKK. Tidak untuk diperjualbelikan.
