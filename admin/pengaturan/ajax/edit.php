<?php 
require '../../../config.php';
require '../../lib/session.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user'])) {
        exit("Anda tidak memiliki akses.");
    }

    if (!isset($_GET['id'])) {
        exit("Anda tidak memiliki akses. (Get)");
    }

    $post_id = $conn->real_escape_string(filter($_GET['id']));
    $Check_exp_edu = $conn->query("SELECT * FROM exp_edu WHERE id = '$post_id'");
    $data_exp_edu = $Check_exp_edu->fetch_assoc();

    if (mysqli_num_rows($Check_exp_edu) == 0) {
        exit("Data Tidak Ditemukan");
    } else {
?>

    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $data_exp_edu['id'] ?>">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="tipe" class="form-label">Tipe</label>
                        <select name="tipe" class="form-control" required>
                            <option value="Pendidikan" <?= $data_exp_edu['tipe'] == 'Pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
                            <option value="Pengalaman" <?= $data_exp_edu['tipe'] == 'Pengalaman' ? 'selected' : '' ?>>Pengalaman</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="text" class="form-control" id="periode" name="periode" placeholder="Masukan periode" value="<?= $data_exp_edu['periode'] ?>" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Masukan instansi" value="<?= $data_exp_edu['instansi'] ?>" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="sebagai" class="form-label">Sebagai</label>
                        <input type="text" class="form-control" id="sebagai" name="sebagai" placeholder="Masukan sebagai" value="<?= $data_exp_edu['sebagai'] ?>" required>
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