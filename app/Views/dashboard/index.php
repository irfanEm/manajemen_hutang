<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
  <h1>Hai, <?= esc($user) ?> 👋</h1>
  <p>Selamat datang di dashboard Manajemen Hutang.</p>
<?= $this->endSection() ?>
