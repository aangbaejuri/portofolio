<?php 
require '../../config.php';
require '../lib/session.php';

$post_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
if ($post_id === 0) {
    $_SESSION['response'] = array(
        'color' => 'danger',
        'icon' => 'close-circle',
        'title' => 'Gagal',
        'msg' => 'Ada yang salah saat memilih data.'
    );

    header("Location: " . $aang_url . "admin/postingan");
    exit();
}

$get_data = $conn->query("SELECT * FROM postingan WHERE id = $post_id");
$row = $get_data->fetch_assoc();

if ($get_data->num_rows == 0) {
    $_SESSION['response'] = array(
        'color' => 'danger',
        'icon' => 'close-circle',
        'title' => 'Gagal',
        'msg' => 'Postingan tidak ditemukan.'
    );

    header("Location: " . $aang_url . "admin/postingan");
    exit();
}

if (isset($_POST['edit'])) {
    $post_id = $conn->real_escape_string($_POST['id']);
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $keyword = str_replace('+', '-', urlencode($judul));

    $uploadDir = '../../upload/postingan/';
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024;
    $currentBanner = $row['banner'];
    $bannerName = $currentBanner;
    $uploadSuccess = true;

    $deskripsi = saveImagesFromEditor($deskripsi, $uploadDir);

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $bannerFile = $_FILES['banner'];
        $bannerExt = strtolower(pathinfo($bannerFile['name'], PATHINFO_EXTENSION));

        if (in_array($bannerExt, $allowedExtensions) && $bannerFile['size'] <= $maxFileSize) {
            $bannerFilename = bin2hex(random_bytes(16)) . '.' . $bannerExt;
            $bannerPath = $uploadDir . $bannerFilename;
            $bannerName = 'upload/postingan/' . $bannerFilename;

            if (move_uploaded_file($bannerFile['tmp_name'], $bannerPath)) {
                if (file_exists('../../' . $currentBanner)) {
                    unlink('../../' . $currentBanner);
                }
            } else {
                $uploadSuccess = false;
                $bannerName = $currentBanner;
            }
        } else {
            $uploadSuccess = false;
        }
    }

    if (!$judul || !$deskripsi) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Judul dan deskripsi tidak boleh kosong.'
        );
    } else {
        if ($conn->query("UPDATE postingan SET banner = '$bannerName', judul = '$judul', deskripsi = '$deskripsi', keyword = '$keyword' WHERE id = '$post_id'") == true) {
            if ($uploadSuccess) {
                $_SESSION['response'] = array(
                    'color' => 'success',
                    'icon' => 'check-circle',
                    'title' => 'Berhasil',
                    'msg' => 'Postingan berhasil diedit.'
                );
            } else {
                $_SESSION['response'] = array(
                    'color' => 'warning',
                    'icon' => 'image-remove-outline',
                    'title' => 'Sebagian Berhasil',
                    'msg' => 'Upload data berhasil namun upload foto gagal.'
                );
            }
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Postingan gagal diedit. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/postingan/");
    exit();
}

require '../lib/header.php';
require '../lib/sidebar.php';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="mdi mdi-pencil-box-outline"></i> Edit Postingan
                </h4>
                <a href="<?= $aang_url ?>admin/postingan/" class="btn btn-sm btn-warning">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="syncEditorContent()">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="row">
                        <div class="col-lg-12 text-center mb-3">
                            <img src="<?= $aang_url . $row['banner'] ?>" class="img-fluid rounded" alt="">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="banner" class="form-label d-flex justify-content-between align-items-center">
                                Banner
                                <small class="text-danger fs-10 ms-auto">* Abaikan jika tidak dirubah</small>
                            </label>
                            <input type="file" accept="image/*" class="form-control" id="banner" name="banner">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan judul" value="<?= $row['judul'] ?>" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <div data-editor-target="deskripsi" id="snow-editor" style="height: 500px;"><?= $row['deskripsi'] ?></div>
                            <textarea name="deskripsi" id="deskripsi" style="display: none;"></textarea>
                        </div>
                        <div class="col-lg-12 d-grid">
                            <button class="btn btn-primary" type="submit" name="edit">
                                <i class="mdi mdi-tray-arrow-up"></i> Update Postingan
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

<script>
    function syncEditorContent() {
        document.getElementById('deskripsi').value = document.querySelector('#snow-editor .ql-editor').innerHTML;
    }
</script>
