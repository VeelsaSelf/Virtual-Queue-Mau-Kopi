<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mau Kopi — Edit Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>

  <style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg:         #F7F3EE;
    --white:      #FFFFFF;
    --brown:      #2C1503;
    --brown-2:    #7A4520;
    --caramel:    #C17A3A;
    --caramel-lt: #F0DEC8;
    --text:       #1A0E04;
    --muted:      #9A8070;
    --border:     #E5DAD0;
    --sidebar-w:  240px;
    --topbar-h:   70px;
  }

  html, body {
    height: 100%; min-height: 100vh;
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    overflow-x: hidden;
  }

  /* ══════════ LAYOUT SHELL ══════════ */
  .shell { display: flex; min-height: 100vh; }

  /* ══════════ SIDEBAR ══════════ */
  .sidebar {
    width: var(--sidebar-w);
    position: fixed; top: 0; left: 0; height: 100vh;
    background: var(--white);
    border-right: 1.5px solid var(--border);
    display: flex; flex-direction: column;
    z-index: 200;
  }

  .sidebar-logo {
    display: flex; align-items: center; gap: 10px;
    padding: 28px 22px 26px;
    border-bottom: 1.5px solid var(--border);
    flex-shrink: 0;
  }
  .sidebar-logo .logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: #3d2609;
    letter-spacing: -.2px;
  }

  .sidebar nav {
    flex: 1; padding: 16px 12px;
    display: flex; flex-direction: column; gap: 2px;
    overflow-y: auto;
  }

  .nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 12px; border-radius: 9px;
    font-size: 13.5px; font-weight: 500; color: var(--muted);
    text-decoration: none; transition: background .15s, color .15s;
    white-space: nowrap;
  }
  .nav-item svg { flex-shrink: 0; width: 18px; height: 18px; }
  .nav-item:hover { background: #F5EDE2; color: var(--text); }
  .nav-item.active { background: #FFF0E0; color: var(--brown); font-weight: 600; }

  .sidebar-foot {
    padding: 14px 12px 20px;
    border-top: 1.5px solid var(--border);
    flex-shrink: 0;
  }
  .btn-signout {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px; border-radius: 9px;
    color: #B93A2A; font-size: 13.5px; font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    background: none; border: none; cursor: pointer;
    width: 100%; text-decoration: none; transition: background .15s;
  }
  .btn-signout:hover { background: #FFF0EE; }
  .btn-signout i { font-size: 18px; }

  /* ══════════ MAIN ══════════ */
  .main {
    margin-left: var(--sidebar-w);
    flex: 1;
    display: flex; flex-direction: column;
    min-height: 100vh;
    width: calc(100% - var(--sidebar-w));
  }

  /* ══════════ TOPBAR ══════════ */
  .topbar {
    height: var(--topbar-h);
    min-height: var(--topbar-h);
    background: var(--white);
    border-bottom: 1.5px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 30px;
    position: sticky; top: 0; z-index: 100;
    flex-shrink: 0;
  }

  .topbar-left h1 {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 700; color: var(--text);
    line-height: 1.2;
  }
  .topbar-left p { font-size: 12.5px; color: var(--muted); margin-top: 2px; }

  .topbar-right { display: flex; align-items: center; gap: 14px; }

  .notif-btn {
    position: relative; width: 38px; height: 38px; border-radius: 50%;
    border: 1.5px solid var(--border); background: var(--bg);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--muted); font-size: 19px;
    transition: background .15s; flex-shrink: 0;
  }
  .notif-btn:hover { background: var(--caramel-lt); }
  .notif-dot {
    position: absolute; top: 7px; right: 7px;
    width: 8px; height: 8px;
    background: #3B82F6; border-radius: 50%; border: 2px solid white;
  }

  .user-chip {
    display: flex; align-items: center; gap: 9px;
    padding: 5px 14px 5px 5px; border-radius: 30px;
    border: 1.5px solid var(--border); background: var(--bg);
    cursor: pointer; text-decoration: none; transition: background .15s;
    flex-shrink: 0;
  }
  .user-chip:hover { background: var(--caramel-lt); }
  .user-av {
    width: 36px; height: 36px; border-radius: 50%;
    border: 2px solid var(--border); overflow: hidden;
    background: var(--caramel-lt); flex-shrink: 0;
  }
  .user-av img { width: 100%; height: 100%; object-fit: cover; display: block; }
  .user-name { font-size: 13px; font-weight: 600; color: var(--text); line-height: 1.2; }
  .user-role { font-size: 11px; color: var(--muted); }

  /* ══════════ PAGE CONTENT ══════════ */
  .content {
    flex: 1;
    padding: 24px 30px;
    /* content mengisi sisa lebar main, tidak ada pembatas */
  }

  /* ══════════ PROFILE CARD ══════════
     Lebar penuh konten, sama persis seperti referensi */
  .profile-card {
    background: var(--white);
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 36px 40px 40px;
    box-shadow: 0 2px 16px rgba(44,21,3,.05);
    width: 100%;           /* penuh, tanpa max-width */
  }

  /* ══════════ AVATAR ══════════ */
  .avatar-section {
    display: flex; justify-content: center;
    margin-bottom: 32px;
  }
  .avatar-wrap {
    position: relative; width: 180px; height: 180px;
    cursor: pointer; flex-shrink: 0;
  }
  .avatar-wrap img {
    width: 100%; height: 100%; object-fit: cover;
    border-radius: 14px; border: 1.5px solid var(--border); display: block;
  }
  .avatar-overlay {
    position: absolute; inset: 0; border-radius: 14px;
    background: rgba(26,14,4,.45);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity .2s;
  }
  .avatar-wrap:hover .avatar-overlay { opacity: 1; }
  .avatar-overlay i { font-size: 32px; color: #fff; }
  #avatarInput { display: none; }

  /* ══════════ SECTION HEADER ══════════ */
  .section-header {
    font-size: 11px; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 18px;
  }

  /* ══════════ FORM ══════════ */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px 28px;
    margin-bottom: 28px;
  }

  .fg { display: flex; flex-direction: column; gap: 7px; }

  .fl { font-size: 13.5px; font-weight: 600; color: var(--text); }

  .fc {
    width: 100%; padding: 12px 15px;
    border: 1.5px solid var(--border); border-radius: 9px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px; color: var(--text);
    background: var(--bg); outline: none;
    transition: border-color .2s, box-shadow .2s;
  }
  .fc:focus {
    border-color: var(--caramel);
    box-shadow: 0 0 0 3px rgba(193,122,58,.12);
  }
  .fc:disabled {
    background: #EDE5DA; color: var(--muted); cursor: not-allowed;
  }
  .fc::placeholder { color: var(--muted); }

  .pw-wrap { position: relative; }
  .pw-wrap .fc { padding-right: 46px; }
  .pw-eye {
    position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer;
    color: var(--muted); font-size: 18px;
    display: flex; align-items: center; line-height: 1;
  }
  .pw-eye:hover { color: var(--text); }

  /* ══════════ ACTION BUTTONS ══════════ */
  .form-actions {
    display: flex; gap: 10px; justify-content: flex-end;
    margin-top: 4px;
  }

  .btn-cancel {
    padding: 11px 26px; border-radius: 9px;
    border: 1.5px solid #F5C0C8; background: #FDEEF0;
    color: #B93A2A; font-family: 'DM Sans', sans-serif;
    font-size: 13.5px; font-weight: 600; cursor: pointer;
    text-decoration: none; display: inline-flex; align-items: center;
    transition: background .15s;
  }
  .btn-cancel:hover { background: #f8d6da; }

  .btn-save {
    padding: 11px 26px; border-radius: 9px; border: none;
    background: var(--brown); color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px; font-weight: 600; cursor: pointer;
    box-shadow: 0 2px 10px rgba(44,21,3,.25);
    transition: background .15s, transform .15s, box-shadow .15s;
  }
  .btn-save:hover {
    background: var(--brown-2);
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(44,21,3,.28);
  }
  .btn-save:active { transform: translateY(0); }
  </style>
</head>
<body>
<div class="shell">

  {{-- ════════════════════ SIDEBAR ════════════════════ --}}
  <aside class="sidebar">
    <div class="sidebar-logo">
      <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
        <rect width="28" height="28" rx="7" fill="#8B5E1A"/>
        <path d="M14 6C10.134 6 7 9.134 7 13C7 16.866 10.134 20 14 20C17.866 20 21 16.866 21 13C21 9.134 17.866 6 14 6ZM14 8C16.761 8 19 10.239 19 13C19 15.761 16.761 18 14 18C11.239 18 9 15.761 9 13C9 10.239 11.239 8 14 8Z" fill="white"/>
        <path d="M14 10C14 10 12 11.5 12 13C12 14.105 12.895 15 14 15C15.105 15 16 14.105 16 13C16 11.5 14 10 14 10Z" fill="white"/>
      </svg>
      <span class="logo-text">MAU KOPI</span>
    </div>

    @php
      $cr = request()->routeIs('dashboard')        ? 'dashboard'
          : (request()->routeIs('orders')           ? 'orders'
          : (request()->routeIs('payments')         ? 'payments'
          : (request()->routeIs('menu-management')  ? 'menu-management'
          : (request()->routeIs('staff-management') ? 'staff-management'
          : (request()->routeIs('sales-report')     ? 'sales-report' : '')))));
    @endphp

    <nav>
      <a href="{{ route('dashboard') }}"        class="nav-item {{ $cr==='dashboard'        ? 'active':'' }}">
        <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="2" width="7" height="7" rx="2" fill="currentColor"/><rect x="11" y="2" width="7" height="7" rx="2" fill="currentColor"/><rect x="2" y="11" width="7" height="7" rx="2" fill="currentColor"/><rect x="11" y="11" width="7" height="7" rx="2" fill="currentColor"/></svg>
        Dashboard
      </a>
      <a href="{{ route('orders') }}"           class="nav-item {{ $cr==='orders'           ? 'active':'' }}">
        <svg viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.6"/><path d="M6.5 10h7M10 6.5v7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        Orders
      </a>
      <a href="{{ route('payments') }}"         class="nav-item {{ $cr==='payments'         ? 'active':'' }}">
        <svg viewBox="0 0 20 20" fill="none"><rect x="2" y="5" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M2 9h16" stroke="currentColor" stroke-width="1.6"/><rect x="5" y="12" width="4" height="2" rx="0.5" fill="currentColor"/></svg>
        Payments
      </a>
      <a href="{{ route('menu-management') }}"  class="nav-item {{ $cr==='menu-management'  ? 'active':'' }}">
        <svg viewBox="0 0 20 20" fill="none"><circle cx="10" cy="6" r="3" stroke="currentColor" stroke-width="1.6"/><path d="M4 17c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        Menu Management
      </a>
      <a href="{{ route('staff-management') }}" class="nav-item {{ $cr==='staff-management' ? 'active':'' }}">
        <svg viewBox="0 0 20 20" fill="none"><circle cx="7.5" cy="6" r="2.5" stroke="currentColor" stroke-width="1.6"/><circle cx="13" cy="6" r="2.5" stroke="currentColor" stroke-width="1.6"/><path d="M2 17c0-3.038 2.462-5.5 5.5-5.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M9 17c0-2.761 1.79-5.118 4.25-5.43C16.134 11.853 18 14.21 18 17" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
        Staff Management
      </a>
      <a href="{{ route('sales-report') }}"     class="nav-item {{ $cr==='sales-report'     ? 'active':'' }}">
        <svg viewBox="0 0 20 20" fill="none"><rect x="3" y="3" width="14" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M6 13l3-3 2 2 3-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Sales Report
      </a>
    </nav>

    <div class="sidebar-foot">
      <a href="{{ route('logout') }}" class="btn-signout"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="ph ph-sign-out"></i> Sign Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
        @csrf
      </form>
    </div>
  </aside>

  {{-- ════════════════════ MAIN ════════════════════ --}}
  <div class="main">

    {{-- TOPBAR --}}
    <header class="topbar">
      <div class="topbar-left">
        <h1>Edit Profile</h1>
        <p>Update your personal information and account details</p>
      </div>
      <div class="topbar-right">
        <button class="notif-btn" type="button">
          <i class="ph ph-bell"></i>
          <span class="notif-dot"></span>
        </button>
        <a href="{{ route('edit-profile') }}" class="user-chip">
          <div class="user-av">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Miguela Veloso">
          </div>
          <div>
            <div class="user-name">Miguela Veloso</div>
            <div class="user-role">Cashier</div>
          </div>
        </a>
      </div>
    </header>

    {{-- CONTENT --}}
    <div class="content">
      <div class="profile-card">

        {{-- Avatar --}}
        <div class="avatar-section">
          <div class="avatar-wrap" onclick="document.getElementById('avatarInput').click()">
            <img id="avatarPreview"
                 src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop"
                 alt="Profile Photo">
            <div class="avatar-overlay"><i class="ph ph-image-square"></i></div>
          </div>
          <input type="file" id="avatarInput" accept="image/*" onchange="previewAvatar(event)">
        </div>

        <form action="{{ route('edit-profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Staff Information --}}
          <div class="section-header">Staff Information</div>
          <div class="form-grid">
            <div class="fg">
              <label class="fl" for="fullName">Full Name</label>
              <input class="fc" type="text" id="fullName" name="full_name" value="Miguela Veloso" required>
            </div>
            <div class="fg">
              <label class="fl" for="username">Username</label>
              <input class="fc" type="text" id="username" name="username" value="mico.ela" required>
            </div>
            <div class="fg">
              <label class="fl" for="phone">Phone Number</label>
              <input class="fc" type="tel" id="phone" name="phone" value="+1-418-543-8090" required>
            </div>
            <div class="fg">
              <label class="fl" for="email">Email Address</label>
              <input class="fc" type="email" id="email" name="email" value="m.veloso23@gmail.com" required>
            </div>
            <div class="fg">
              <label class="fl" for="role">Role</label>
              <input class="fc" type="text" id="role" value="Cashier" disabled>
            </div>
          </div>

          {{-- Authentication --}}
          <div class="section-header">Authentication</div>
          <div class="form-grid">
            <div class="fg">
              <label class="fl" for="password">Password</label>
              <div class="pw-wrap">
                <input class="fc" type="password" id="password" name="password" value="password123">
                <button type="button" class="pw-eye" onclick="togglePw('password','eye1')">
                  <i id="eye1" class="ph ph-eye-slash"></i>
                </button>
              </div>
            </div>
            <div class="fg">
              <label class="fl" for="passwordConfirm">Confirm Password</label>
              <div class="pw-wrap">
                <input class="fc" type="password" id="passwordConfirm" name="password_confirmation" value="password">
                <button type="button" class="pw-eye" onclick="togglePw('passwordConfirm','eye2')">
                  <i id="eye2" class="ph ph-eye-slash"></i>
                </button>
              </div>
            </div>
          </div>

          {{-- Actions --}}
          <div class="form-actions">
            <a href="{{ route('staff-management') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-save">Save Changes</button>
          </div>
        </form>

      </div>{{-- /profile-card --}}
    </div>{{-- /content --}}
  </div>{{-- /main --}}
</div>{{-- /shell --}}

<script>
function previewAvatar(e) {
  const file = e.target.files[0];
  if (!file) return;
  const r = new FileReader();
  r.onload = ev => document.getElementById('avatarPreview').src = ev.target.result;
  r.readAsDataURL(file);
}
function togglePw(inputId, iconId) {
  const inp  = document.getElementById(inputId);
  const icon = document.getElementById(iconId);
  if (inp.type === 'password') { inp.type = 'text';     icon.className = 'ph ph-eye'; }
  else                         { inp.type = 'password'; icon.className = 'ph ph-eye-slash'; }
}
</script>
</body>
</html>