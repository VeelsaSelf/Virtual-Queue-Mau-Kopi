# Mau Kopi

A web-based ordering app for a local coffee shop in Malang, East Java. Customers can browse the menu, add items to their cart, pick a payment method, and get a digital receipt — all without waiting in line.

Built with Laravel 11 and Blade. No database needed, everything runs on session.

---

## What it does

- Browse menu by category — Coffee, Non-Coffee, Food, Desserts, Snacks
- Customize each item (size, sugar level, ice, add-ons, notes)
- Cart with quantity controls
- Checkout with payment method and order type (Dine In / Takeaway)
- Cash payments get a 10-second countdown timer
- QRIS/Transfer payments auto-confirm after processing
- Failed payments bring you back to checkout with your cart restored
- Digital receipt at the end

---

## Stack

- **Laravel 11** — routing, controllers, session
- **Blade** — templating
- **TailwindCSS** — via CDN, no build step needed
- **Inter** — Google Fonts

---

## Running locally

```bash
git clone https://github.com/VeelsaSelf/Virtual-Queue-Mau-Kopi.git
cd Virtual-Queue-Mau-Kopi

composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Then open `http://127.0.0.1:8000`.

---

## Pages

| Route | Page |
|-------|------|
| `/` | Menu |
| `/menu/{slug}` | Item detail |
| `/cart` | Cart |
| `/checkout` | Checkout |
| `/payment/{id}` | Payment status |
| `/payment/{id}/receipt` | Receipt |

---

Made for UKK — Mau Kopi, 22 Jalan Tanimbar, Malang.
