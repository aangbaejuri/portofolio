<?php
require '../../config.php';
require '../lib/session.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user'])) {
        exit("Anda tidak memiliki akses.");
    }
?>

    <form action="" method="post">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama anggota" required>
            </div>
            <div class="col-lg-12 mb-3">
                <label class="form-label">Buat Kode Akses</label>
                <input type="text" name="kode_akses" class="form-control" placeholder="Contoh: AANG_123" required>
                <small class="mb-0">
                    <b>Note</b>: Kode Akses akan menjadi password default, edit jika ingin mengganti password.
                </small>
            </div>
            <div class="col-lg-12 d-grid">
                <button class="btn btn-primary" name="tambah"><i class="bi bi-plus"></i> Tambah Akun</button>
            </div>
        </div>
    </form>

<?php
} else {
    exit("Anda tidak memiliki akses untuk membuka data ini.");
}
?>