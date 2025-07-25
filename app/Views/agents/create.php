<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  body {
    font-family: 'Inter', 'Segoe UI', sans-serif;
    background-color: #f5f7fb;
  }

  .form-container {
    max-width: 100%;
    margin: 4rem auto;
    background: #fff;
    padding: 2.5rem 2rem;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    animation: fadeInUp 0.5s ease;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .form-title {
    font-size: 1.75rem;
    font-weight: 700;
    text-align: center;
    color: #2c2f36;
    margin-bottom: 1.8rem;
  }

  .form-label {
    font-weight: 600;
    margin-bottom: 0.4rem;
    color: #444;
  }

  .form-control {
    border-radius: 10px;
    padding: 0.7rem 1rem;
    font-size: 0.95rem;
    border: 1px solid #ced4da;
    background-color: #fbfbfb;
    transition: all 0.2s ease-in-out;
  }

  .form-control:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.15rem rgba(79, 70, 229, 0.15);
  }

  .action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
  }

  .btn-custom {
    border: none;
    padding: 0.6rem 1.3rem;
    border-radius: 10px;
    font-weight: 500;
    transition: background-color 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
  }

  .btn-back {
    background-color: #f3f4f6;
    color: #333;
  }

  .btn-back:hover {
    background-color: #e5e7eb;
  }

  .btn-save {
    background-color: #4f46e5;
    color: white;
  }

  .btn-save:hover {
    background-color: #4338ca;
  }

  .btn-save svg,
  .btn-back svg {
    width: 16px;
    height: 16px;
  }
</style>

<div class="container">
  <div class="form-container">
    <h2 class="form-title">Tambah Agen Baru</h2>

    <form action="/agents/store" method="post">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label for="kode_agen" class="form-label">Kode Agen</label>
        <input type="text" class="form-control" id="kode_agen" name="kode_agen" placeholder="Contoh: AG001" required>
      </div>

      <div class="mb-3">
        <label for="nama_agen" class="form-label">Nama Agen</label>
        <input type="text" class="form-control" id="nama_agen" name="nama_agen" placeholder="Contoh: PT. Alpha Jaya" required>
      </div>

      <div class="action-buttons">
        <a href="/agents" class="btn-custom btn-back">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
          </svg>
          Kembali
        </a>
        <button type="submit" class="btn-custom btn-save">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-save">
            <path d="M8.5 1.5v5h-3v-5H2a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5V4.707a.5.5 0 0 0-.146-.354L12.146 1.146A.5.5 0 0 0 11.793 1H9a.5.5 0 0 0-.5.5zM9 2h2.5L14 4.5V14H2V2h1.5v5A.5.5 0 0 0 4 7.5h4a.5.5 0 0 0 .5-.5v-5z"/>
          </svg>
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
