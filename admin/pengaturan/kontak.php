<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';

if (isset($_POST['simpan'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $wa = $conn->real_escape_string($_POST['wa']);
    $ig = $conn->real_escape_string($_POST['ig']);
    $tt = $conn->real_escape_string($_POST['tt']);
    $yt = $conn->real_escape_string($_POST['yt']);

    if ($conn->query("UPDATE kontak SET email = '$email', wa = '$wa', ig = '$ig', tt = '$tt', yt = '$yt' WHERE kode = 'aang'") == true) {
        $_SESSION['response'] = array(
            'color' => 'success',
            'icon' => 'check-circle',
            'title' => 'Berhasil',
            'msg' => 'Data kontak berhasil diubah.'
        );
    } else {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Data kontak gagal diubah.'
        );
    }

    header("Location: " . $aang_url . "admin/pengaturan/kontak");
    exit();
}

require '../lib/sidebar.php';
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="mdi mdi-contacts-outline me-1"></i> Link Kontak
                    </h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="<?= $data_kontak['email'] ?>" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="wa" class="form-label">WhatsApp</label>
                                <input type="text" name="wa" class="form-control" id="wa" value="<?= $data_kontak['wa'] ?>" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="ig" class="form-label">Instagram</label>
                                <input type="text" name="ig" class="form-control" id="ig" value="<?= $data_kontak['ig'] ?>" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="tt" class="form-label">TikTok</label>
                                <input type="text" name="tt" class="form-control" id="tt" value="<?= $data_kontak['tt'] ?>" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="yt" class="form-label">YouTube</label>
                                <input type="text" name="yt" class="form-control" id="yt" value="<?= $data_kontak['yt'] ?>" required>
                            </div>
                            <div class="col-lg-12 d-grid">
                                <button class="btn btn-primary" type="submit" name="simpan" id="simpan" disabled>
                                    <i class="mdi mdi-content-save-all-outline"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const initialEmail = '<?= addslashes($data_kontak['email']) ?>';
        const initialWa = '<?= addslashes($data_kontak['wa']) ?>';
        const initialIg = '<?= addslashes($data_kontak['ig']) ?>';
        const initialTt = '<?= addslashes($data_kontak['tt']) ?>';
        const initialYt = '<?= addslashes($data_kontak['yt']) ?>';

        const emailInput = document.getElementById('email');
        const waInput = document.getElementById('wa');
        const igInput = document.getElementById('ig');
        const ttInput = document.getElementById('tt');
        const ytInput = document.getElementById('yt');
        const simpanButton = document.getElementById('simpan');

        function checkChanges() {
            const isEmailChanged = emailInput.value !== initialEmail;
            const isWaChanged = waInput.value !== initialWa;
            const isIgChanged = igInput.value !== initialIg;
            const isTtChanged = ttInput.value !== initialTt;
            const isYtChanged = ytInput.value !== initialYt;

            if (isEmailChanged || isWaChanged || isIgChanged || isTtChanged || isYtChanged) {
                simpanButton.disabled = false;
            } else {
                simpanButton.disabled = true;
            }
        }

        emailInput.addEventListener('input', checkChanges);
        waInput.addEventListener('input', checkChanges);
        igInput.addEventListener('input', checkChanges);
        ttInput.addEventListener('input', checkChanges);
        ytInput.addEventListener('input', checkChanges);

        checkChanges();
    </script>

<?php 
require '../lib/footer.php';
?>