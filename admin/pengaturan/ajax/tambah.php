<?php
require '../../../config.php';
require '../../lib/session.php';

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (!isset($_SESSION['user'])) {
        exit("Anda tidak memiliki akses.");
    }
?>

    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="tipe" class="form-label">Tipe</label>
                        <select name="tipe" class="form-control" required>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Pengalaman">Pengalaman</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="periode" class="form-label">Periode</label>
                        <input type="text" class="form-control" id="periode" name="periode" placeholder="Masukan periode" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="instansi" placeholder="Masukan instansi" required>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="sebagai" class="form-label">Sebagai</label>
                        <input type="text" class="form-control" id="sebagai" name="sebagai" placeholder="Masukan sebagai" required>
                    </div>
                    <div class="col-lg-12 d-grid">
                        <button class="btn btn-primary" type="submit" name="tambah">
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