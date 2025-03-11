<?php
require 'config.php';
require_once 'lib/header.php';
require_once 'lib/navbar.php';

if (!isset($_GET['keyword'])) {
    exit("Anda tidak memiliki akses. (Get)");
}

$post_keyword = $conn->real_escape_string(filter($_GET['keyword']));
$Check_post = $conn->query("SELECT * FROM postingan WHERE keyword = '$post_keyword'");
$data_post = $Check_post->fetch_assoc();

if (mysqli_num_rows($Check_post) == 0) {
    header("Location: " . $aang_url);
    exit();
} else {
?>

    <section id="about" class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="about-content-part wow fadeInUp delay-0-2s">
                        <img src="<?= $aang_url . $data_post['banner'] ?>" class="img-fluid" alt="">
                        <div class="d-flex justify-content-between align-items-center">
                            <span><?= $data_post['penulis'] ?></span>
                            <span>|</span>
                            <span><?= datetime_indo($data_post['datetime']) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-content-part wow fadeInUp delay-0-2s">
                        <h4 class="mt-3"><?= $data_post['judul'] ?></h4>
                        <p style="text-align: justify;"><?= $data_post['deskripsi'] ?></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-content-part wow fadeInUp delay-0-3s">
                        <h4 class="mb-3">Other Posts</h4>
                        <?php
                        $get_poost = $conn->query("SELECT * FROM postingan WHERE keyword != '" . $data_post['keyword'] . "' ORDER BY id LIMIT 5");
                        while ($post_data = $get_poost->fetch_assoc()) {
                        ?>
                            <div class="row">
                                <div class="col-lg-4 text-center">
                                    <a href="<?= $aang_url ?>detail?keyword=<?= $post_data['keyword'] ?>">
                                        <img src="<?= $aang_url . $post_data['banner'] ?>" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-8">
                                    <a href="<?= $aang_url ?>detail?keyword=<?= $post_data['keyword'] ?>">
                                        <h6><?= $post_data['judul'] ?></h6>
                                    </a>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                        <a href="<?= $aang_url ?>blog" class="theme-btn">
                            See More
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                <path d="M16.0037 9.41421L7.39712 18.0208L5.98291 16.6066L14.5895 8H7.00373V6H18.0037V17H16.0037V9.41421Z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
}
require_once 'lib/footer.php'; 
?>