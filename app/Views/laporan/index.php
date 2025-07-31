<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  body {
    background-color: #f0f2f5;
    font-family: 'Inter', sans-serif;
  }

  .page-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1.5rem;
  }

  .btn-primary {
    background: linear-gradient(90deg, #6366f1, #4f46e5);
    border: none;
    color: #fff;
    font-weight: 500;
    padding: 0.5rem 1.3rem;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background: linear-gradient(90deg, #4f46e5, #4338ca);
  }

  .filter-section {
    background: #ffffffcc;
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.05);
    margin-bottom: 2rem;
  }

  .filter-section .form-label {
    font-weight: 600;
    color: #334155;
  }

  .section-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1rem;
  }

  .table-wrapper {
    background: #ffffff;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
    margin-bottom: 2.5rem;
    overflow-x: auto;
  }

  .table {
    border-collapse: separate;
    border-spacing: 0 0.7rem;
  }

  .table th {
    background-color: #f1f5f9;
    color: #475569;
    font-weight: 600;
    font-size: 0.9rem;
    border: none;
    padding: 0.75rem 1rem;
  }

  .table td {
    color: #334155;
    vertical-align: middle;
    font-size: 0.93rem;
    background-color: #f9fafb;
    border: none;
    padding: 0.75rem 1rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    border-radius: 10px;
  }

  .table tbody tr {
    transition: background 0.2s ease;
  }

  .table tbody tr:hover td {
    background-color: #f1f5f9;
  }

  .table tbody tr td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
  }

  .table tbody tr td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
  }

  .list-group-item {
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f9fafb;
    border: none;
    border-bottom: 1px solid #e2e8f0;
    padding: 0.75rem 1.2rem;
  }

  .badge {
    font-size: 0.9rem;
    background-color: #6366f1;
    padding: 0.4rem 0.8rem;
    border-radius: 12px;
  }

  .empty-state {
    text-align: center;
    padding: 2rem;
    color: #94a3b8;
    font-style: italic;
    font-size: 0.95rem;
  }

  .btn-sm {
    font-size: 0.85rem;
    padding: 0.35rem 0.9rem;
    border-radius: 6px;
  }

  .form-select,
  .form-control {
    border-radius: 10px;
    font-size: 0.95rem;
    padding: 0.6rem 0.9rem;
  }
</style>


<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
  <h1 class="page-title">📊 Laporan Hutang</h1>
  <div>
    <a href="/laporan/export/pdf" class="btn btn-primary btn-sm me-2">📄 Export PDF</a>
    <a href="/laporan/export/excel" class="btn btn-primary btn-sm">📊 Export Excel</a>
  </div>
</div>

<!-- FILTER -->
<div class="filter-section">
  <form method="get" action="/laporan" class="row g-3">
    <div class="col-md-3">
      <label class="form-label">Tanggal</label>
      <input type="date" name="tanggal" class="form-control" value="<?= esc($_GET['tanggal'] ?? '') ?>">
    </div>
    <div class="col-md-3">
      <label class="form-label">Agen</label>
      <select name="agen" class="form-select">
        <option value="">Semua Agen</option>
        <?php foreach ($agents as $a): ?>
          <option value="<?= $a['id'] ?>" <?= ($_GET['agen'] ?? '') == $a['id'] ? 'selected' : '' ?>>
            <?= esc($a['nama_agen']) ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Metode Pembayaran</label>
      <select name="metode" class="form-select">
        <option value="">Semua Metode</option>
        <?php foreach ($metode_pembayaran as $metode): ?>
          <option value="<?= $metode['id'] ?>" <?= ($_GET['metode'] ?? '') == $metode['id'] ? 'selected' : '' ?>>
            <?= esc($metode['nama_metode']) ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col-md-3 d-flex align-items-end">
      <button class="btn btn-primary w-100">🔍 Filter</button>
    </div>
  </form>
</div>

<!-- TABEL HUTANG -->
<div class="table-wrapper">
  <h5 class="section-title">📌 Daftar Hutang</h5>
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Agen</th>
          <th>Tanggal</th>
          <th>Nominal Hutang</th>
          <th>Metode</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($hutangs)): ?>
          <tr>
            <td colspan="5" class="empty-state">Tidak ada data hutang ditemukan.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($hutangs as $i => $h): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= esc($h['nama_agen']) ?></td>
              <td><?= date('d-m-Y', strtotime($h['tanggal_hutang'])) ?></td>
              <td>Rp. <?= number_format($h['sisa_hutang'], 2, ',', '.') ?></td>
              <td><?= esc($h['nama_metode'] ?? '-') ?></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<!-- REKAP PEMBAYARAN -->
<div class="table-wrapper">
  <h5 class="section-title">💳 Rekap Transaksi Hutang / Pembayaran</h5>
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Agen</th>
          <th>Tipe</th>
          <th>Nominal</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($riwayats)): ?>
          <tr>
            <td colspan="5" class="empty-state">Tidak ada riwayat transaksi.</td>
          </tr>
        <?php else: ?>
          <?php foreach ($riwayats as $i => $r): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= esc($agents[array_search($r['id_agent'], array_column($agents, 'id'))]['nama_agen'] ?? '-') ?></td>
              <td><?= ucfirst($r['tipe_pembayaran']) ?></td>
              <td>Rp. <?= number_format($r['nominal'], 2, ',', '.') ?></td>
              <td><?= date('d-m-Y', strtotime($r['tanggal_pembayaran'])) ?></td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<!-- TOTAL HUTANG -->
<div class="table-wrapper">
  <h5 class="section-title">📈 Total Hutang Aktif per Agen</h5>
  <ul class="list-group">
    <?php foreach ($agents as $a): ?>
      <li class="list-group-item">
        <?= esc($a['nama_agen']) ?>
        <span class="badge">Rp. <?= number_format($a['sisa_hutang'], 2, ',', '.') ?></span>
      </li>
    <?php endforeach ?>
  </ul>
</div>

<?= $this->endSection() ?>
