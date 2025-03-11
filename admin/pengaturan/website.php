<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';

if (isset($_POST['simpan'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $short_title = $conn->real_escape_string($_POST['short_title']);

    if ($conn->query("UPDATE website SET title = '$title', short_title = '$short_title' WHERE kode = 'aang'") == true) {
        $_SESSION['response'] = array(
            'color' => 'success',
            'icon' => 'check-circle',
            'title' => 'Berhasil',
            'msg' => 'Data website berhasil diubah.'
        );
    } else {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Data website gagal diubah.'
        );
    }

    header("Location: " . $aang_url . "admin/pengaturan/website");
    exit();
} else if (isset($_POST['simpan_favicon'])) {
    $favicon_updated = false;
    $favicon_url = $website_data['favicon'];

    if (!empty($_FILES['favicon']['name'])) {
        $target_dir = "../../upload/website/";
        $favicon_name = basename($_FILES['favicon']['name']);
        $target_file = $target_dir . $favicon_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES['favicon']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'File yang diunggah harus berupa gambar.'
            );
        }
        
        if ($_FILES['favicon']['size'] > 5000000) {
            $uploadOk = 0;
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Ukuran file terlalu besar, maksimal 5mb.'
            );
        }
        
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            $uploadOk = 0;
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Hanya file JPG, JPEG, dan PNG yang diizinkan.'
            );
        }
        
        if ($uploadOk == 1) {
            if (!empty($website_data['favicon']) && file_exists("../../" . $website_data['favicon'])) {
                if (!unlink("../../" . $website_data['favicon'])) {
                    $_SESSION['response'] = array(
                        'color' => 'danger',
                        'icon' => 'close-circle',
                        'title' => 'Gagal',
                        'msg' => 'Favicon lama gagal dihapus.'
                    );

                    header("Location: " . $aang_url . "admin/pengaturan/website");
                    exit();
                }
            }
            
            if (move_uploaded_file($_FILES['favicon']['tmp_name'], $target_file)) {
                $favicon_updated = true;
                $favicon_url = "upload/website/" . $favicon_name;
            } else {
                $_SESSION['response'] = array(
                    'color' => 'danger',
                    'icon' => 'close-circle',
                    'title' => 'Gagal',
                    'msg' => 'Terjadi kesalahan saat mengunggah file.'
                );
            }
        }
    }
    
    if ($favicon_updated) {
        $update_favicon = $conn->query("UPDATE website SET favicon = '$favicon_url' WHERE kode = 'aang'");
        if ($update_favicon) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Favicon berhasil diperbarui.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Favicon gagal diperbarui.'
            );
        }
    }
    
    header("Location: " . $aang_url . "admin/pengaturan/website");
    exit();
} else if (isset($_POST['simpan_navicon'])) {
    $navicon_updated = false;
    $navicon_url = $website_data['navicon'];

    if (!empty($_FILES['navicon']['name'])) {
        $target_dir = "../../upload/website/";
        $navicon_name = basename($_FILES['navicon']['name']);
        $target_file = $target_dir . $navicon_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES['navicon']['tmp_name']);
        if ($check === false) {
            $uploadOk = 0;
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'File yang diunggah harus berupa gambar.'
            );
        }
        
        if ($_FILES['navicon']['size'] > 5000000) {
            $uploadOk = 0;
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Ukuran file terlalu besar, maksimal 5mb.'
            );
        }
        
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            $uploadOk = 0;
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Hanya file JPG, JPEG, dan PNG yang diizinkan.'
            );
        }
        
        if ($uploadOk == 1) {
            if (!empty($website_data['navicon']) && file_exists("../../" . $website_data['navicon'])) {
                if (!unlink("../../" . $website_data['navicon'])) {
                    $_SESSION['response'] = array(
                        'color' => 'danger',
                        'icon' => 'close-circle',
                        'title' => 'Gagal',
                        'msg' => 'Navicon lama gagal dihapus.'
                    );

                    header("Location: " . $aang_url . "admin/pengaturan/website");
                    exit();
                }
            }
            
            if (move_uploaded_file($_FILES['navicon']['tmp_name'], $target_file)) {
                $navicon_updated = true;
                $navicon_url = "upload/website/" . $navicon_name;
            } else {
                $_SESSION['response'] = array(
                    'color' => 'danger',
                    'icon' => 'close-circle',
                    'title' => 'Gagal',
                    'msg' => 'Terjadi kesalahan saat mengunggah file.'
                );
            }
        }
    }
    
    if ($navicon_updated) {
        $update_navicon = $conn->query("UPDATE website SET navicon = '$navicon_url' WHERE kode = 'aang'");
        if ($update_navicon) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Navicon berhasil diperbarui.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Navicon gagal diperbarui.'
            );
        }
    }
    
    header("Location: " . $aang_url . "admin/pengaturan/website");
    exit();
}

require '../lib/sidebar.php';
?>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-image-edit me-1"></i> Icon
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-4">
                        <li class="nav-item">
                            <a href="#navicon_tab" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                                Navicon
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#favicon_tab" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                Favicon
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="navicon_tab">
                            <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 text-center mb-3">
                                        <img class="img-fluid border" src="<?= $aang_url . $data_web['navicon'] ?>" alt="">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Navicon</label>
                                        <input type="file" accept="image/*" name="navicon" class="form-control" id="navicon">
                                    </div>
                                    <div class="col-lg-12 d-grid">
                                        <button type="submit" name="simpan_navicon" class="btn btn-primary" id="btn_navicon">
                                            <i class="mdi mdi-image-edit-outline"></i> Ganti Navicon
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="favicon_tab">
                            <form class="forms-sample" method="POST" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 text-center mb-3">
                                        <img class="img-fluid border" src="<?= $aang_url . $data_web['favicon'] ?>" alt="">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Favicon</label>
                                        <input type="file" accept="image/*" name="favicon" class="form-control" id="favicon">
                                    </div>
                                    <div class="col-lg-12 d-grid">
                                        <button type="submit" name="simpan_favicon" class="btn btn-primary" id="btn_favicon">
                                            <i class="mdi mdi-image-edit-outline"></i> Ganti Favicon
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="mdi mdi-web align-middle me-1"></i> Website
                    </h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="short_title" class="form-label">Short Title</label>
                                <input type="text" name="short_title" class="form-control" id="short_title" placeholder="Insert short title website" value="<?= $data_web['short_title'] ?>" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Insert title website" value="<?= $data_web['title'] ?>" required>
                            </div>
                            <div class="col-lg-12 d-grid">
                                <button class="btn btn-primary" type="submit" name="simpan" id="simpan">
                                    <i class="mdi mdi-content-save-all-outline"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Icon
        const faviconInput = document.getElementById('favicon');
        const naviconInput = document.getElementById('navicon');
        const btnFavicon = document.getElementById('btn_favicon');
        const btnNavicon = document.getElementById('btn_navicon');

        function checkFileChange(input, button) {
            if (input.files.length > 0) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        }
        
        faviconInput.addEventListener('change', function() {
            checkFileChange(faviconInput, btnFavicon);
        });
        
        naviconInput.addEventListener('change', function() {
            checkFileChange(naviconInput, btnNavicon);
        });
        
        checkFileChange(faviconInput, btnFavicon);
        checkFileChange(naviconInput, btnNavicon);

        // Website
        const initialTitle = '<?= addslashes($data_web['title']) ?>';
        const initialShortTitle = '<?= addslashes($data_web['short_title']) ?>';
        
        const titleInput = document.getElementById('title');
        const short_titleInput = document.getElementById('short_title');
        const simpanButton = document.getElementById('simpan');
        
        function checkChanges() {
            const isTitleChanged = titleInput.value !== initialTitle;
            const isShortTitleChanged = short_titleInput.value !== initialShortTitle;
            
            if (isTitleChanged || isShortTitleChanged) {
                simpanButton.disabled = false;
            } else {
                simpanButton.disabled = true;
            }
        }
        
        titleInput.addEventListener('input', checkChanges);
        short_titleInput.addEventListener('input', checkChanges);
        
        checkChanges();
    </script>

<?php 
require '../lib/footer.php';
?>