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
    $Check_sctn_partner = $conn->query("SELECT * FROM sctn_partner WHERE id = '$post_id'");
    $data_sctn_partner = $Check_sctn_partner->fetch_assoc();

    if (mysqli_num_rows($Check_sctn_partner) == 0) {
        exit("Data Tidak Ditemukan");
    } else {
?>

    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data_sctn_partner['id'] ?>">
                <div class="row">
                    <div class="col-lg-12 text-center mb-3">
                        <img src="<?= $aang_url . $data_sctn_partner['logo'] ?>" class="img-fluid rounded" alt="">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="logo" class="form-label d-flex justify-content-between align-items-center">
                            Logo
                            <small class="text-danger fs-10 ms-auto">* Abaikan jika tidak dirubah</small>
                        </label>
                        <input type="file" accept="image/*" class="form-control" id="logo" name="logo">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama" value="<?= $data_sctn_partner['nama'] ?>" required>
                    </div>
                    <div class="col-lg-12 d-grid">
                        <button class="btn btn-primary" type="submit" name="edit">
                            <i class="mdi mdi-pencil"></i> Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
    }
} else {
    exit("Anda tidak memiliki akses untuk membuka data ini.");
}
?>