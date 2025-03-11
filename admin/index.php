<?php 
require '../config.php';
require 'lib/session.php';
require 'lib/header.php';
require 'lib/sidebar.php';

if (!isset($_SESSION['user'])) {    
    exit(header("Location: " . $aang_url . "auth/login"));
} else {
?>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Experience</h4>
                </div>
                <div class="card-body">
                    <?php 
                    $get_exp = $conn->query("SELECT * FROM exp_edu WHERE tipe = 'Pengalaman' ORDER BY id DESC");
                    while ($row_exp = $get_exp->fetch_assoc()) {
                    ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4><?= $row_exp['instansi'] ?></h4>
                                <p class="my-0"><?= $row_exp['sebagai'] ?></p>
                            </div>
                            <h5><?= $row_exp['periode'] ?></h5>
                        </div>
                        <hr>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Education</h4>
                </div>
                <div class="card-body">
                    <?php 
                    $get_edu = $conn->query("SELECT * FROM exp_edu WHERE tipe = 'Pendidikan' ORDER BY id DESC");
                    while ($row_edu = $get_edu->fetch_assoc()) {
                    ?>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4><?= $row_edu['instansi'] ?></h4>
                                <p class="my-0"><?= $row_edu['sebagai'] ?></p>
                            </div>
                            <h5><?= $row_edu['periode'] ?></h5>
                        </div>
                        <hr>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php 
}
require 'lib/footer.php';
?>