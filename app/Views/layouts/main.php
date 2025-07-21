<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Dashboard') ?> | <?= esc(env('app.name') ?? 'Manajemen Hutang') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f1f3f6;
      margin: 0;
    }

    .sidebar {
      width: 250px;
      min-height: 100vh;
      background: linear-gradient(135deg, #ffffff 0%, #f4f7ff 100%);
      backdrop-filter: blur(10px);
      border-right: 1px solid #dee2e6;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1040;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar .logo {
      font-size: 1.4rem;
      font-weight: bold;
      text-align: center;
      padding: 1.5rem;
      color: #0d6efd;
      border-bottom: 1px solid #dee2e6;
    }

    .sidebar .nav-link {
      display: flex;
      align-items: center;
      padding: 0.75rem 1.25rem;
      color: #333;
      font-weight: 500;
      border-left: 4px solid transparent;
      transition: all 0.2s ease-in-out;
    }

    .sidebar .nav-link i {
      margin-right: 12px;
      font-size: 1.2rem;
    }

    .sidebar .nav-link:hover {
      background-color: #e9f0ff;
      border-left: 4px solid #0d6efd;
      color: #0d6efd;
    }

    .sidebar .nav-link.active {
      background-color: #dbeafe;
      color: #0d6efd;
      border-left: 4px solid #0d6efd;
    }

    .content-area {
      margin-left: 250px;
      padding: 2rem;
      transition: margin-left 0.3s ease-in-out;
    }

    .topbar {
      background-color: #ffffff;
      padding: 1rem;
      border-bottom: 1px solid #dee2e6;
    }

    .btn-toggle {
      font-size: 1.4rem;
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.show {
        transform: translateX(0);
      }

      .content-area {
        margin-left: 0;
        padding: 1rem;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar" class="sidebar shadow-sm">
  <div class="logo"><?= esc(env('app.name') ?? 'Manajemen Hutang') ?></div>
  <ul class="nav flex-column">
    <li><a href="/dashboard" class="nav-link <?= url_is('dashboard*') ? 'active' : '' ?>"><i class="bi bi-house-door"></i> Dashboard</a></li>
    <li><a href="/agents" class="nav-link <?= url_is('agents*') ? 'active' : '' ?>"><i class="bi bi-people"></i> Agen</a></li>
    <li><a href="/payment-methods" class="nav-link <?= url_is('payment-methods*') ? 'active' : '' ?>"><i class="bi bi-credit-card-2-back"></i> Metode Pembayaran</a></li>
    <li><a href="/hutang" class="nav-link <?= url_is('hutang*') ? 'active' : '' ?>"><i class="bi bi-file-earmark-text"></i> Hutang</a></li>
    <li><a href="/laporan" class="nav-link <?= url_is('laporan*') ? 'active' : '' ?>"><i class="bi bi-bar-chart-line"></i> Laporan</a></li>
    <li><a href="/users" class="nav-link <?= url_is('users*') ? 'active' : '' ?>"><i class="bi bi-person-gear"></i> User Management</a></li>
    <li><a href="/akun" class="nav-link <?= url_is('akun*') ? 'active' : '' ?>"><i class="bi bi-gear-wide-connected"></i> Pengaturan Akun</a></li>
    <li><a href="/logout" class="nav-link text-danger"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
  </ul>
</div>

<!-- Topbar (Mobile) -->
<nav class="topbar d-md-none">
  <button class="btn btn-outline-primary btn-toggle" id="toggleSidebar">
    <i class="bi bi-list"></i>
  </button>
</nav>

<!-- Main Content -->
<div class="content-area">
  <?= $this->renderSection('content') ?>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('show');
  });
</script>

</body>
</html>

selanjutnya mari kita lanjut ke menu agen.

untuk agen saya ingin tablenya terdiri dari : id, kode_agen, nama_agen, created_at, updated_at, dan deleted_at. buatkan file migrasi, model, seeder dan juga form untuk crud beserta route dan controllernya.
pada bagian index / 