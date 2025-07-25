<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="dashboard-container fade-in">
  <!-- Header -->
  <div class="mb-4">
    <h2 class="fw-bold text-primary">Selamat Datang, <?= session('user_name') ?> 👋</h2>
    <p class="text-muted">Ringkasan informasi keuangan hutang kamu.</p>
  </div>

  <!-- Cards -->
  <div class="row g-4 mb-4">
    <?php
      $cards = [
        ['label' => 'Total Agen', 'count' => '12', 'icon' => 'people-fill', 'color' => 'primary'],
        ['label' => 'Metode Pembayaran', 'count' => '5', 'icon' => 'credit-card-2-front-fill', 'color' => 'success'],
        ['label' => 'Hutang Aktif', 'count' => '18', 'icon' => 'file-earmark-excel-fill', 'color' => 'warning'],
        ['label' => 'Hutang Lunas', 'count' => '42', 'icon' => 'file-earmark-check-fill', 'color' => 'info'],
      ];
    ?>
    <?php foreach ($cards as $index => $card): ?>
      <div class="col-sm-6 col-lg-3 fade-in delay-<?= $index ?>">
        <div class="card border-0 shadow-sm h-100 hover-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="text-muted small"><?= $card['label'] ?></h6>
                <h3 class="fw-bold"><?= $card['count'] ?></h3>
              </div>
              <i class="bi bi-<?= $card['icon'] ?> text-<?= $card['color'] ?> fs-2"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>

  <!-- Chart -->
  <div class="card border-0 shadow-sm fade-in delay-1 mb-4">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-3">Statistik Hutang Per Bulan</h5>
      <canvas id="hutangChart" height="100"></canvas>
    </div>
  </div>

  <!-- Recent Transactions -->
  <div class="card border-0 shadow-sm fade-in delay-2">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-3">Hutang Terbaru</h5>
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Ahmad</td>
              <td>Rp1.000.000</td>
              <td><span class="badge bg-warning text-dark">Aktif</span></td>
              <td>2025-07-19</td>
            </tr>
            <tr>
              <td>Sinta</td>
              <td>Rp500.000</td>
              <td><span class="badge bg-success">Lunas</span></td>
              <td>2025-07-18</td>
            </tr>
            <!-- Tambahkan data lainnya -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('hutangChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
      datasets: [{
        label: 'Total Hutang',
        data: [3, 6, 4, 8, 2, 9],
        fill: true,
        backgroundColor: 'rgba(13, 110, 253, 0.1)',
        borderColor: '#0d6efd',
        tension: 0.3
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>

<!-- Animasi & Custom CSS -->
<style>
  .dashboard-container {
    animation: fadeInMain 0.6s ease;
  }

  .hover-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
  }

  .fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.5s ease forwards;
  }

  .fade-in.delay-1 { animation-delay: 0.1s; }
  .fade-in.delay-2 { animation-delay: 0.2s; }
  .fade-in.delay-3 { animation-delay: 0.3s; }

  @keyframes fadeUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeInMain {
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
  }
</style>

<?= $this->endSection() ?>
