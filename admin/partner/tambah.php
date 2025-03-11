<?php
require '../../config.php';
require '../lib/session.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user'])) {
        exit("Anda tidak memiliki akses.");
    }
?>

    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" accept="image/*" class="form-control" id="logo" name="logo" required>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama" required>
                    </div>
                    <div class="col-lg-12 d-grid">
                        <button class="btn btn-primary" type="submit" name="upload">
                            <i class="mdi mdi-plus"></i> Tambahkan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
} else {
    exit("Anda tidak memiliki akses untuk membuka data ini.");
}
?>