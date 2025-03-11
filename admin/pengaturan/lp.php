<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';

$get_sct1 = $conn->query("SELECT * FROM sctn WHERE kode = '" . $data_web['kode'] . "'");
$data_sct1 = $get_sct1->fetch_assoc();

if (isset($_POST['sctn_satu'])) {
    $nama = $conn->real_escape_string(filter(trim($_POST['nama'])));
    $bio = $conn->real_escape_string(filter($_POST['bio']));
    $quote = $conn->real_escape_string(filter($_POST['quote']));
    $deskripsi = $conn->real_escape_string(filter($_POST['deskripsi']));
    $alamat = $conn->real_escape_string(filter($_POST['alamat']));
    $map_lokasi = $conn->real_escape_string(filter($_POST['map_lokasi']));

    $uploadDir = '../../view/';
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    $maxFileSize = 10 * 1024 * 1024;

    $currentCV = $data_sct1['cv'];
    $CVName = $currentCV;

    $currentBanner = $data_sct1['foto_saya'];
    $foto_sayaName = $currentBanner;

    $uploadSuccess = true;

    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $CVFile = $_FILES['cv'];
        $CVExt = strtolower(pathinfo($CVFile['name'], PATHINFO_EXTENSION));

        if (in_array($CVExt, $allowedExtensions) && $CVFile['size'] <= $maxFileSize) {
            $CVFilename = bin2hex(random_bytes(16)) . '.' . $CVExt;
            $CVPath = $uploadDir . $CVFilename;
            $CVName = 'view/' . $CVFilename;

            if (move_uploaded_file($CVFile['tmp_name'], $CVPath)) {
                if (file_exists('../../' . $currentCV)) {
                    unlink('../../' . $currentCV);
                }
            } else {
                $uploadSuccess = false;
                $CVName = $currentCV;
            }
        } else {
            $uploadSuccess = false;
        }
    }

    if (isset($_FILES['foto_saya']) && $_FILES['foto_saya']['error'] === UPLOAD_ERR_OK) {
        $foto_sayaFile = $_FILES['foto_saya'];
        $foto_sayaExt = strtolower(pathinfo($foto_sayaFile['name'], PATHINFO_EXTENSION));

        if (in_array($foto_sayaExt, $allowedExtensions) && $foto_sayaFile['size'] <= $maxFileSize) {
            $foto_sayaFilename = bin2hex(random_bytes(16)) . '.' . $foto_sayaExt;
            $foto_sayaPath = $uploadDir . $foto_sayaFilename;
            $foto_sayaName = 'view/' . $foto_sayaFilename;

            if (move_uploaded_file($foto_sayaFile['tmp_name'], $foto_sayaPath)) {
                if (file_exists('../../' . $currentBanner)) {
                    unlink('../../' . $currentBanner);
                }
            } else {
                $uploadSuccess = false;
                $foto_sayaName = $currentBanner;
            }
        } else {
            $uploadSuccess = false;
        }
    }

    if (!$nama || !$bio || !$quote || !$deskripsi || !$alamat || !$map_lokasi) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Form tidak boleh ada yang kosong.'
        );
    } else {
        if ($conn->query("UPDATE sctn SET nama = '$nama', bio = '$bio', quote = '$quote', deskripsi = '$deskripsi', alamat = '$alamat', map_lokasi = '$map_lokasi', cv = '$CVName', foto_saya = '$foto_sayaName' WHERE kode = '" . $data_web['kode'] . "'") == true) {
            if ($uploadSuccess) {
                $_SESSION['response'] = array(
                    'color' => 'success',
                    'icon' => 'check-circle',
                    'title' => 'Berhasil',
                    'msg' => 'Section 1 berhasil diedit.'
                );
            } else {
                $_SESSION['response'] = array(
                    'color' => 'warning',
                    'icon' => 'image-remove-outline',
                    'title' => 'Sebagian Berhasil',
                    'msg' => 'Upload data berhasil namun upload foto gagal - #section1.'
                );
            }
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Section 1 gagal diedit. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/pengaturan/lp");
    exit();
}

require '../lib/sidebar.php';
?>

    <div class="row">
        <h4 class="mb-3">
            <i class="mdi mdi-card-account-details-outline me-1"></i> Tentang Anda
        </h4>

        <div class="col-lg-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="cv" class="form-label">CV <small>(PDF)</small></label>
                                <input type="file" accept="image/*" class="form-control" id="cv" name="cv">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="foto_saya" class="form-label">Foto <small>(1024x1024)</small></label>
                                <input type="file" accept="image/*" class="form-control" id="foto_saya" name="foto_saya">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama" value="<?= $data_sct1['nama'] ?>" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <input type="text" class="form-control" id="bio" name="bio" placeholder="Masukan bio" value="<?= $data_sct1['bio'] ?>" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="quote" class="form-label">Quote</label>
                                <input type="text" class="form-control" id="quote" name="quote" placeholder="Masukan kata singkat" value="<?= $data_sct1['quote'] ?>" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Masukan deskripsi"><?= $data_sct1['deskripsi'] ?></textarea>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat" value="<?= $data_sct1['alamat'] ?>" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="map_lokasi" class="form-label">Link Maps</label>
                                <input type="text" class="form-control" id="map_lokasi" name="map_lokasi" placeholder="Masukan url maps" value="<?= $data_sct1['map_lokasi'] ?>" required>
                            </div>
                            <div class="col-lg-12 d-grid mb-2">
                                <button class="btn btn-primary" type="submit" name="sctn_satu">
                                    <i class="mdi mdi-content-save-edit-outline"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
require '../lib/footer.php';
?>