<?php
require '../config.php';
require '../admin/lib/header.php';

if (isset($_COOKIE['cookie_token'])) {
    $data = $conn->query("SELECT * FROM users WHERE cookie_token = '" . $_COOKIE['cookie_token'] . "'");
    if (mysqli_num_rows($data) > 0) {
        $hasil = mysqli_fetch_assoc($data);
        $_SESSION['user'] = $hasil;
    }
}

if (isset($_SESSION['user'])) {
    header("Location: " . $aang_url . "auth/check_session");
    exit();
} else {
    if (isset($_POST['login'])) {
        $post_kode_akses = $conn->real_escape_string(trim(filter($_POST['kode_akses'])));
        $post_password = $conn->real_escape_string(trim(filter($_POST['password'])));

        $check_user = $conn->query("SELECT * FROM users WHERE kode_akses = '$post_kode_akses'");
        $check_user_rows = mysqli_num_rows($check_user);
        $data_user = mysqli_fetch_assoc($check_user);

        $verif_pass = password_verify($post_password, $data_user['password']);

        if (!$post_kode_akses || !$post_password) {
            $_SESSION['response'] = array(
                'color' => 'danger', 
                'icon' => 'alert-octagon',
                'title' => 'Gagal Masuk', 
                'msg' => 'Harap mengisikan kode akses dan password.'
            );
        } else if ($check_user_rows == 0) {
            $_SESSION['response'] = array(
                'color' => 'danger', 
                'icon' => 'alert-octagon',
                'title' => 'Gagal Masuk', 
                'msg' => 'Akun tidak ditemukan atau kode akses salah.'
            );
        } else {
            if ($check_user_rows == 1) {
                if ($verif_pass == true) {
                    $remember = isset($_POST['remember']) ? TRUE : false;

                    if ($remember == TRUE) {
                        $cookie_token = md5($post_kode_akses, $email);
                        $conn->query("UPDATE users SET cookie_token = '" . $cookie_token . "' WHERE kode_akses = '" . $post_kode_akses . "'");
                        setcookie('cookie_token', $cookie_token, time() + 60 * 60 * 24 * 7, '/');
                    }

                    $_SESSION['user'] = $data_user;
                    $_SESSION['response'] = array(
                        'color' => 'success', 
                        'icon' => 'check-circle',
                        'title' => 'Berhasil Masuk', 
                        'msg' => 'Selamat datang <b>' . $data_user['name'] . '</b>'
                    );

                    exit(header("Location: " . $aang_url . "admin/"));
                } else {
                    $_SESSION['response'] = array(
                        'color' => 'danger', 
                        'icon' => 'alert-octagon',
                        'title' => 'Gagal Masuk', 
                        'msg' => 'Kode Akses atau password salah.'
                    );
                }
            }
        }

        exit(header("Location: " . $aang_url . "auth/login"));
    }
}
?>
    <?php if (isset($_SESSION['response'])) { ?>
        <div class="toast-container position-fixed top-0 end-0 p-3" data-original-class="toast-container position-absolute p-3">
            <div class="toast fade show bg-<?= $_SESSION['response']['color'] ?> text-white align-items-center mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    <strong class="d-flex mb-1">
                        <i class="mdi mdi-<?= $_SESSION['response']['icon'] ?> align-middle me-1"></i>
                        <?= $_SESSION['response']['title'] ?> 
                        <a type="button" class="btn-close me-1 m-auto" data-bs-dismiss="toast" aria-label="Close"></a>
                    </strong>
                    <p class="mt-2 mb-0"><?= $_SESSION['response']['msg'] ?></p>
                </div>
            </div>
        </div>
    <?php unset($_SESSION['response']); } ?>

    <div class="container-fluid vh-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-xl-4">
                <div class="card border shadow">
                    <div class="card-body">
                        <h2>
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </h2>
                        <form method="post">
                            <div class="row mt-4 mb-2">
                                <div class="col-lg-12 mb-3">
                                    <input class="form-control" type="text" name="kode_akses" placeholder="Masukan kode akses" required>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password">
                                        <a type="button" class="input-group-text" data-password="false">
                                            <span class="mdi mdi-eye"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <input class="form-check-input" id="rememberMe" type="checkbox" name="remember" value="" checked>
                                    <label class="form-check-label ms-1" for="rememberMe">Ingat Saya</label>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary w-100" type="submit" name="login">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="<?= $aang_url ?>admin/assets/js/vendor.min.js"></script>
    <script src="<?= $aang_url ?>admin/assets/vendor/lucide/umd/lucide.min.js"></script>
    <!-- App js -->
    <script src="<?= $aang_url ?>admin/assets/js/app.min.js"></script>

</body>
</html>