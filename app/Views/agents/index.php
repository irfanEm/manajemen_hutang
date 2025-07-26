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
    background-color: #4f46e5;
    border-color: #4f46e5;
    border-radius: 8px;
  }

  .btn-primary:hover {
    background-color: #4338ca;
  }

  .table-wrapper {
    background: #fff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
  }

  .table thead th {
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
    font-size: 0.9rem;
  }

  .table td {
    font-size: 0.9rem;
    vertical-align: middle;
    color: #4b5563;
  }

  .action-btns {
    display: flex;
    gap: 0.5rem;
  }

  .btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.4rem 0.6rem;
    font-size: 0.85rem;
    border-radius: 6px;
    transition: 0.2s ease;
  }

  .btn-icon.edit {
    background-color: #facc15;
    color: #1f2937;
  }

  .btn-icon.edit:hover {
    background-color: #eab308;
  }

  .btn-icon.delete {
    background-color: #f87171;
    color: white;
  }

  .btn-icon.delete:hover {
    background-color: #ef4444;
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

/* Tombol ikon */
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

/* Edit icon */
.btn-icon.edit {
  background-color: #fff8e1;
  color: #f59e0b;
}
.btn-icon.edit:hover {
  background-color: #fff3c4;
}

/* Delete icon */
.btn-icon.delete {
  background-color: #fee2e2;
  color: #ef4444;
}
.btn-icon.delete:hover {
  background-color: #fecaca;
}

/* Table modern */
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

/* Aksi tombol di kanan tetap align */
.table .text-center {
  text-align: center;
}

</style>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
  <h1 class="page-title">Data Agen</h1>
  <a href="/agents/create" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
  <i class="bi bi-plus-circle"></i>
  Tambah Agen
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
          <th>Kode Agen</th>
          <th>Nama Agen</th>
          <th>Tanggal Input Saldo</th>
          <th>Sisa Hutang Terakhir</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($agents)): ?>
          <tr>
            <td colspan="6" class="empty-state">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                <path d="M8 9a3 3 0 1 0-2.93-2.482 5.5 5.5 0 0 0-3.943 5.75A.5.5 0 0 0 1.62 13h8.759a.5.5 0 0 0 .493-.597 5.5 5.5 0 0 0-3.875-4.883A3 3 0 0 0 8 9z"/>
                <path d="M11.854 5.146a.5.5 0 0 1 .707 0L14 6.586l1.439-1.44a.5.5 0 0 1 .707.708L14.707 7.293l1.439 1.439a.5.5 0 0 1-.707.707L14 8.007l-1.439 1.44a.5.5 0 1 1-.707-.708l1.439-1.439-1.439-1.44a.5.5 0 0 1 0-.707z"/>
              </svg><br>
              Belum ada data agen.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($agents as $index => $agent): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= esc($agent['kode_agen']) ?></td>
              <td><?= esc($agent['nama_agen']) ?></td>
              <td><?= esc(date("d-m-Y", strtotime($agent['tanggal_input_saldo']))) ?></td>
              <td>Rp. <?= number_format(esc($agent['sisa_hutang']),2,',', '.') ?></td>
              <td class="text-center">
                <div class="action-btns justify-content-center">
                  <a href="/agents/edit/<?= $agent['id'] ?>" class="btn-icon edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="/agents/delete/<?= $agent['id'] ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus agen ini?')" style="display:inline;">
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
