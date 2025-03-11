<?php
require '../../config.php';
require '../lib/session.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user'])) {
        exit("Anda tidak memiliki akses.");
    }

    if (!isset($_GET['id'])) {
        exit("Anda tidak memiliki akses. (Get)");
    }

    $post_id = $conn->real_escape_string(filter($_GET['id']));
    $Check_akun = $conn->query("SELECT * FROM users WHERE id = '$post_id'");
    $data_akun = $Check_akun->fetch_assoc();

    if (mysqli_num_rows($Check_akun) == 0) {
        exit("Data Tidak Ditemukan");
    } else {
?>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $data_akun['id'] ?>">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="form-label">Ditambahkan oleh</label>
                <span class="form-control"><?= $data_akun['ref'] ?></span>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="form-label">Terdaftar</label>
                <span class="form-control"><?= datetime_indo($data_akun['terdaftar']) ?></span>
            </div>
            <div class="col-lg-12 mb-3">
                <label class="form-label">Kode Akses</label>
                <span class="form-control"><?= $data_akun['kode_akses'] ?></span>
            </div>
            <hr>
            <div class="col-lg-12 mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="<?= $data_akun['nama'] ?>" required>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="banner" class="form-label d-flex justify-content-between align-items-center">
                    Password
                    <small class="text-danger fs-10 ms-auto">* Abaikan jika tidak dirubah</small>
                </label>
                <input type="text" name="password" class="form-control" placeholder="Buat password baru" value="">
            </div>
            <div class="col-lg-12 d-grid">
                <button class="btn btn-primary" name="edit"><i class="bi bi-pencil"></i> Edit</button>
            </div>
        </div>
    </form>

<?php
    }
} else {
    exit("Anda tidak memiliki akses untuk membuka data ini.");
}
?>