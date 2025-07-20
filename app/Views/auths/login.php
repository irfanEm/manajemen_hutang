<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title)  . " | " . esc(env('app.name') ?? 'Manajemen Hutang') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      padding: 2.5rem;
    }

    .login-title {
      font-weight: 600;
      margin-bottom: 1.5rem;
      color: #343a40;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
      padding: 0.6rem;
      font-weight: 500;
    }

    .brand {
      font-size: 1.25rem;
      font-weight: 600;
      color: #0d6efd;
    }

    @media (max-width: 576px) {
      .login-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4 login-card">

      <div class="text-center mb-4">
        <div class="brand"><?= esc(env('app.name') ?? 'Manajemen Hutang') ?></div>
      </div>

      <h4 class="text-center login-title"><?= esc($title) ?></h4>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
      <?php endif; ?>

      <form action="/login" method="post" novalidate>
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
          <label for="email">Email</label>
        </div>

        <div class="form-floating mb-4">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Masuk</button>
      </form>

      <div class="mt-4 text-center small text-muted">
        Belum punya akun? <a href="#" class="text-decoration-none">Hubungi admin</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
