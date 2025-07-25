<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  .page-title {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #2d2d2d;
  }

  .btn-primary {
    background: transparent;
    border: 1.5px solid #4f46e5;
    color: #4f46e5;
    font-weight: 500;
    border-radius: 8px;
    padding: 0.5rem 1.2rem;
    transition: 0.25s ease;
  }

  .btn-primary:hover {
    background-color: #4f46e5;
    color: white;
    border-color: #4f46e5;
  }

  .table-wrapper {
    background: #ffffff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    overflow-x: auto;
  }

  .table {
    border-collapse: separate;
    border-spacing: 0 0.4rem;
    width: 100%;
  }

  .table thead th {
    background-color: transparent;
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
    padding: 0.75rem;
    border: none;
  }

  .table tbody tr {
    background-color: #f9fafb;
    border-radius: 8px;
    transition: background 0.2s ease;
  }

  .table tbody tr:hover {
    background-color: #f3f4f6;
  }

  .table td {
    padding: 0.75rem;
    font-size: 0.9rem;
    color: #4b5563;
    border-top: none;
  }

  .table tbody tr td:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
  }

  .table tbody tr td:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
  }

  .action-btns {
    display: flex;
    gap: 0.5rem;
  }

  .btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    width: 36px;
    font-size: 1rem;
    border: none;
    border-radius: 50%;
    background-color: #f3f4f6;
    color: #374151;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 1px 3px rgba(0,0,0,0.08);
  }

  .btn-icon:hover {
    background-color: #e5e7eb;
  }

  .btn-icon.edit {
    background-color: #fff8e1;
    color: #f59e0b;
  }

  .btn-icon.edit:hover {
    background-color: #fff3c4;
  }

  .btn-icon.delete {
    background-color: #fee2e2;
    color: #ef4444;
  }

  .btn-icon.delete:hover {
    background-color: #fecaca;
  }

  .empty-state {
    text-align: center;
    padding: 2rem;
    font-style: italic;
    color: #9ca3af;
  }

  .empty-state svg {
    width: 40px;
    height: 40px;
    opacity: 0.2;
    margin-bottom: 0.5rem;
  }
</style>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
  <h1 class="page-title">Metode Pembayaran</h1>
  <a href="/payment-methods/create" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
    <i class="bi bi-plus-circle"></i>
    Tambah Metode
  </a>
</div>

<?php if (session()->getFlashdata('message')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<div class="table-wrapper">
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Kode Metode</th>
          <th>Nama Metode</th>
          <th>Dibuat</th>
          <th>Diperbarui</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($paymentMethods)): ?>
          <tr>
            <td colspan="6" class="empty-state">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2H0zm0 1v7a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5H0zm2 3a.5.5 0 0 1 .5-.5H5a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm0 2a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10z"/>
              </svg><br>
              Belum ada data metode pembayaran.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($paymentMethods as $index => $method): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= esc($method['kode_metode']) ?></td>
              <td><?= esc($method['nama_metode']) ?></td>
              <td><?= esc($method['created_at']) ?></td>
              <td><?= esc($method['updated_at']) ?></td>
              <td class="text-center">
                <div class="action-btns justify-content-center">
                  <a href="/payment-methods/edit/<?= $method['id'] ?>" class="btn-icon edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="/payment-methods/delete/<?= $method['id'] ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus metode ini?')" style="display:inline;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn-icon delete" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
