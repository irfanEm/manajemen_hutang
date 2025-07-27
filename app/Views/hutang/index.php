<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- (style tetap sama seperti referensi sebelumnya, bisa kamu copy-paste dari agen) -->
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
  <h1 class="page-title">Data Hutang</h1>
  <a href="/hutang/create" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
    <i class="bi bi-plus-circle"></i>
    Tambah Hutang
  </a>
</div>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('message')): ?>
  <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<div class="table-wrapper">
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>ID Hutang</th>
          <th>Nama Agen</th>
          <th>Tanggal Hutang</th>
          <th>Metode Pembayaran</th>
          <th>Sisa Hutang</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($hutangs)): ?>
          <tr>
            <td colspan="7" class="empty-state">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                <path d="M6.854 5.146a.5.5 0 1 0-.708.708L7.293 7l-1.147 1.146a.5.5 0 0 0 .708.708L8 7.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 7l1.147-1.146a.5.5 0 0 0-.708-.708L8 6.293 6.854 5.146z"/>
                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13 4.5L9.5 1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
              </svg><br>
              Belum ada data hutang.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($hutangs as $index => $hutang): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= esc($hutang['id_hutang']) ?></td>
              <td><?= esc($hutang['nama_agen']) ?></td>
              <td><?= date('d-m-Y', strtotime($hutang['tanggal_hutang'])) ?></td>
              <td><?= esc($hutang['nama_metode']) ?></td>
              <td>Rp. <?= number_format($hutang['sisa_hutang'], 2, ',', '.') ?></td>
              <td class="text-center">
                <div class="action-btns justify-content-center">
                  <a href="/hutang/edit/<?= $hutang['id'] ?>" class="btn-icon edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="/hutang/delete/<?= $hutang['id'] ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data hutang ini?')" style="display:inline;">
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
