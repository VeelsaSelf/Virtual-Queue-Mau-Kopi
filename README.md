# ☕ Mau Kopi — Laravel Ordering System

A fully functional coffee shop ordering web application built with Laravel 11, Blade templating, and TailwindCSS. Faithfully recreated from Figma designs.

---

## 🖥️ Pages Included

| Page | Route | Description |
|------|-------|-------------|
| Menu | `/` | Hero + category tabs + menu grid |
| Menu Detail | `/menu/{slug}` | Item customization (size, sugar, ice, add-ons) |
| Cart | `/cart` | Order summary, qty controls |
| Checkout | `/checkout` | Payment method, name, totals |
| Payment - Processing | `/payment/status/{id}` | Processing with countdown (Cash) |
| Payment - Failed | `/payment/status/{id}` | Failed state |
| Payment - Success | `/payment/status/{id}` | Success state |
| Receipt | `/payment/receipt/{id}` | Final receipt with order number |

---

## 🚀 Setup Instructions

### 1. Create a new Laravel project

```bash
composer create-project laravel/laravel mau-kopi
cd mau-kopi
```

### 2. Copy project files

Copy all files from this package into your Laravel project, matching the folder structure below.

### 3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

No database required — the app uses **Laravel sessions** for cart and order state.

### 4. Install TailwindCSS (via CDN)

TailwindCSS is loaded via CDN in `resources/views/layouts/app.blade.php`. No npm build step needed.

> For production, install via npm: `npm install -D tailwindcss && npx tailwindcss init`

### 5. Serve the application

```bash
php artisan serve
```

Visit: **http://localhost:8000**

---

## 📁 Project Structure

```
app/
  Http/
    Controllers/
      MenuController.php       ← Menu index + show
      CartController.php       ← Add, update, remove cart items
      CheckoutController.php   ← Checkout form + order creation
      PaymentController.php    ← Payment status + receipt

resources/
  views/
    layouts/
      app.blade.php            ← Main layout (navbar, coffee bean bg)
    components/
      navbar.blade.php         ← Top navigation bar
    menu/
      index.blade.php          ← Hero + menu grid
      show.blade.php           ← Item detail + customization
    cart/
      index.blade.php          ← Cart page
    checkout/
      index.blade.php          ← Checkout page
    payment/
      status.blade.php         ← Processing / Success / Failed states
      receipt.blade.php        ← Order receipt

routes/
  web.php                      ← All application routes
```

---

## 🎨 Design System

| Token | Value | Usage |
|-------|-------|-------|
| Background | `#1C1917` | Page background |
| Card | `#252220` | Card surfaces |
| Border | `#3A3733` | Dividers, borders |
| Accent | `#DDB892` | Prices, CTA, highlights |
| Text | `#F0EDE8` | Primary text |
| Muted | `rgba(255,255,255,0.4)` | Secondary text |

**Font:** Inter (Google Fonts)

---

## ⚡ Features

- ✅ Session-based cart (no database needed)
- ✅ Dynamic price calculation (size + add-on pricing)
- ✅ Payment method selection (Cash, QRIS, Transfer)
- ✅ Cash payment countdown timer (10 minutes)
- ✅ Payment simulation (success / failed) for demo
- ✅ Animated floating coffee beans background
- ✅ Responsive design
- ✅ Full MVC architecture

---

## 📝 Notes

- Item data is stored as arrays in `MenuController::getMenuItems()`. For production, migrate this to a database with Eloquent models.
- Session-based cart resets on session expiry. For persistent carts, implement database-backed cart with authentication.
- The payment processing is simulated. Integrate a real payment gateway (Midtrans, Xendit) for production.
