<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang | Manajemen Hutang</title>
    
    <!-- Inter Font for Minimalist Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: 'Inter', sans-serif;
        background-color: #ffffff;
        color: #333;
        overflow: hidden;
      }

      .welcome-container {
        position: relative;
        z-index: 2;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
      }

      .welcome-box {
        background: #fff;
        padding: 3rem;
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.07);
        max-width: 480px;
        width: 100%;
        text-align: center;
        animation: fadeIn 1s ease;
      }

      .icon {
        width: 60px;
        height: 60px;
        fill: #0d6efd;
        margin-bottom: 1.2rem;
      }

      .welcome-box h1 {
        font-weight: 600;
        font-size: 1.75rem;
        margin-bottom: 1rem;
        line-height: 1.4;
      }

      .btn-login {
        padding: 0.6rem 2rem;
        font-size: 1rem;
        border-radius: 30px;
        background-color: #0d6efd;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
      }

      .btn-login:hover {
        background-color: #0b5ed7;
      }

      .credit {
        font-size: 0.9rem;
        margin-top: 1.5rem;
        color: #888;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      #particles-js {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
      }
    </style>
  </head>

  <body>
    <!-- Partikel latar -->
    <div id="particles-js"></div>

    <!-- Konten Utama -->
    <div class="welcome-container">
      <div class="welcome-box">
        <!-- SVG Grafik -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24">
          <path d="M3 17h2v-7H3v7zm4 0h2v-4H7v4zm4 0h2V7h-2v10zm4 0h2v-2h-2v2zm4 0h2v-9h-2v9z"/>
        </svg>

        <h1>Selamat datang di<br /><strong>Manajemen Hutang</strong></h1>
        <a href="/login" class="btn btn-login mt-3">Masuk ke Aplikasi</a>

        <div class="credit">dev by <strong>irfanEm</strong></div>
      </div>
    </div>

    <!-- JS Bootstrap dan Particles -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
      particlesJS("particles-js", {
        particles: {
          number: { value: 40 },
          color: { value: "#0d6efd" },
          shape: { type: "circle" },
          opacity: { value: 0.1 },
          size: { value: 4 },
          line_linked: {
            enable: true,
            distance: 120,
            color: "#0d6efd",
            opacity: 0.2,
            width: 1,
          },
          move: {
            enable: true,
            speed: 1.6,
          },
        },
      });
    </script>
  </body>
</html>
