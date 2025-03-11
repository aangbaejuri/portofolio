<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';

if (isset($_POST['upload'])) {
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = trim($conn->real_escape_string($_POST['deskripsi']));
    $keyword = str_replace('+', '-', urlencode($judul));

    $uploadDir = '../../upload/postingan/';
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 10 * 1024 * 1024;

    $uploadSuccess = true;
    $bannerName = '';

    $deskripsi = saveImagesFromEditor($deskripsi, $uploadDir);

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $bannerFile = $_FILES['banner'];
        $bannerExt = strtolower(pathinfo($bannerFile['name'], PATHINFO_EXTENSION));

        if (in_array($bannerExt, $allowedExtensions) && $bannerFile['size'] <= $maxFileSize) {
            $bannerFilename = generateRandomFilename($bannerExt);
            $bannerPath = $uploadDir . $bannerFilename;
            $bannerName = 'upload/postingan/' . $bannerFilename;

            if (!move_uploaded_file($bannerFile['tmp_name'], $bannerPath)) {
                $uploadSuccess = false;
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
            'msg' => 'Harap mengisi form judul dan deskripsi.'
        );
    } else {
        if ($conn->query("INSERT INTO postingan VALUES (NULL, '$bannerName', '$judul', '$deskripsi', '$sess_nama', '$datetime', '$keyword')")) {
            if ($uploadSuccess) {
                $_SESSION['response'] = array(
                    'color' => 'success',
                    'icon' => 'check-circle',
                    'title' => 'Berhasil',
                    'msg' => 'Postingan baru berhasil ditambahkan.'
                );
            } else {
                $_SESSION['response'] = array(
                    'color' => 'warning',
                    'icon' => 'image-remove-outline',
                    'title' => 'Sebagian Berhasil',
                    'msg' => 'Berhasil membuat postingan namun upload banner gagal.'
                );
            }
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Postingan gagal ditambahkan. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/postingan");
    exit();
}

require '../lib/sidebar.php';
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-plus"></i> Buat Postingan
                    </h4>
                    <a href="<?= $aang_url ?>admin/postingan/" class="btn btn-sm btn-warning">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="syncEditorContent()">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="banner" class="form-label">Banner</label>
                                <input type="file" accept="image/*" class="form-control" id="banner" name="banner" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan judul" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <div data-editor-target="deskripsi" class="form-control" id="snow-editor" style="height: 500px;" name="deskripsi" placeholder="Masukan deskripsi" required></div>
                                <textarea name="deskripsi" id="deskripsi" style="display: none;"></textarea>
                            </div>
                            <div class="col-lg-12 d-grid">
                                <button class="btn btn-primary" type="submit" name="upload">
                                    <i class="mdi mdi-tray-arrow-up"></i> Upload
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