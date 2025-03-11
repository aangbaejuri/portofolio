<?php
require 'config.php';
require_once 'lib/db.php';
require_once 'lib/header.php';
require_once 'lib/navbar.php';
?>
    
    <section id="about" class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="about-image-part wow fadeInUp delay-0-3s">
                        <div class="about-image-part2">
                            <img src="<?= $aang_url . $data_sct1['foto_saya'] ?>" alt="About Me" />
                        </div>
                        <h2><?= $data_sct1['nama'] ?></h2>
                        <p><?= $data_sct1['bio'] ?></p>
                        <div class="about-social text-center">
                            <ul>
                                <li>
                                    <a href="<?= $data_kontak['email'] ?>"><i class="ri-mail-fill"></i></a>
                                </li>
                                <li>
                                    <a href="<?= $data_kontak['ig'] ?>"><i class="ri-instagram-fill"></i></a>
                                </li>
                                <li>
                                    <a href="<?= $data_kontak['wa'] ?>"><i class="ri-whatsapp-fill"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-content-part wow fadeInUp delay-0-2s">
                        <p>Hello There!</p>
                        <h5 style="text-align: justify">
                            <?= nl2br($data_sct1['deskripsi']) ?>
                        </h5>
                        <div class="adress-field">
                            <ul>
                                <li><i class="ri-circle-fill"></i>Available For Hire</li>
                            </ul>
                        </div>
                        <div class="hero-btns">
                            <a href="<?= $aang_url . $data_sct1['cv'] ?>" target="_blank" class="theme-btn">Download CV <i class="ri-download-line"></i></a>
                        </div>
                    </div>
                    <div class="about-content-part-bottom wow fadeInUp delay-0-2s">
                        <div class="company-list">
                            <div class="scroller" data-direction="left" data-speed="fast">
                                <div class="scroller__inner">
                                    <h4><b>Quote</b></h4>
                                    <h4>"<?= $data_sct1['quote'] ?>"</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="resume" class="resume-area">
        <div class="container">
            <div class="resume-items">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="single-resume">
                            <h2>Experience</h2>
                            <?php
                            $get_exp = $conn->query("SELECT * FROM exp_edu WHERE tipe = 'Pengalaman' ORDER BY id DESC");
                            while ($row_exp = $get_exp->fetch_assoc()) {
                            ?>
                                <div class="experience-list">
                                    <div class="resume-item wow fadeInUp delay-0-3s">
                                        <div class="icon">
                                            <i class="ri-book-line"></i>
                                        </div>
                                        <div class="content">
                                            <span class="years"><?= $row_exp['periode'] ?></span>
                                            <h4><?= $row_exp['instansi'] ?></h4>
                                            <span class="company"><?= $row_exp['sebagai'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <div class="experience-list">
                            <div class="single-resume">
                                <h2>Education</h2>
                                <?php
                                $get_edu = $conn->query("SELECT * FROM exp_edu WHERE tipe = 'Pendidikan' ORDER BY id DESC");
                                while ($row_edu = $get_edu->fetch_assoc()) {
                                ?>
                                    <div class="resume-item wow fadeInUp delay-0-3s">
                                        <div class="icon">
                                            <i class="ri-book-line"></i>
                                        </div>
                                        <div class="content">
                                            <span class="years"><?= $row_edu['periode'] ?></span>
                                            <h4><?= $row_edu['instansi'] ?></h4>
                                            <span class="company"><?= $row_edu['sebagai'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="partner" class="client-logo-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section-title text-center pt-5 mb-65 wow fadeInUp delay-0-2s">
                        <h2>Partners</h2>
                        <p class="mt-0">Business Partners</p>
                    </div>
                </div>
            </div>
            <div class="client-logo-wrap">
                <?php 
                $get_partnert = $conn->query("SELECT * FROM sctn_partner ORDER BY id ASC");
                while ($row_partner = $get_partnert->fetch_assoc()) {
                ?>
                    <a class="client-logo-item wow fadeInUp delay-0-2s">
                        <img src="<?= $aang_url . $row_partner['logo'] ?>" alt="<?= $row_partner['nama'] ?>" title="<?= $row_partner['nama'] ?>" />
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <section id="blog" class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-title text-center wow fadeInUp delay-0-2s">
                        <h2>Stories</h2>
                        <p class="mt-0">Latest Posts</p>
                    </div>
                </div>
            </div>
            <?php
            $get_poost = $conn->query("SELECT * FROM postingan ORDER BY id LIMIT 5");
            while ($data_post = $get_poost->fetch_assoc()) {
            ?>
                <div class="row blog-post-box align-items-center">
                    <div class="col-lg-6">
                        <div class="blog-post-img">
                            <a href="<?= $aang_url ?>detail?keyword=<?= $data_post['keyword'] ?>">
                                <img src="<?= $aang_url . $data_post['banner'] ?>" alt="<?= $data_post['judul'] ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="blog-post-caption">
                            <h3 class="mt-1"><?= datetime_indo($data_post['datetime']) ?></h3>
                            <h2>
                                <a class="link-decoration" href="<?= $aang_url ?>detail?keyword=<?= $data_post['keyword'] ?>"><?= $data_post['judul'] ?></a>
                            </h2>
                            <a class="theme-btn theme-btn-two" href="<?= $aang_url ?>detail?keyword=<?= $data_post['keyword'] ?>">Read more <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-title text-center wow fadeInUp delay-0-2s">
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
    
    <section id="contact" class="contact-area">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="section-title text-center wow fadeInUp delay-0-2s">
                            <h2>Get in Touch with Me!</h2>
                            <p class="mt-0">contact</p>
                        </div>
                    </div>
                </div>
                <div class="contact-content-part  wow fadeInUp delay-0-2s">
                    <div class="single-contact wow fadeInUp" data-wow-delay=".2s">
                        <div class="contact-icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <h2>Alamat:</h2>
                        <p><?= $data_sct1['alamat'] ?></p>
                    </div>
                    <div class="single-contact wow fadeInUp text-center" data-wow-delay=".4s">
                        <a href="<?= $data_kontak['email'] ?>" class="mb-2 btn btn-danger">Email</a>
                        <a href="<?= $data_kontak['wa'] ?>" class="mb-2 btn btn-success">WhatsApp</a>
                        <a href="<?= $data_kontak['ig'] ?>" class="mb-2 btn btn-primary">Instagram</a>
                        <a href="<?= $data_kontak['tt'] ?>" class="mb-2 btn btn-secondary">TikTok</a>
                        <a href="<?= $data_kontak['yt'] ?>" class="mb-2 btn btn-dark">YouTube</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="map_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <h2 class="map_title">View My Live Map Location</h2>
                    <div class="map">
                        <iframe src="<?= $data_sct1['map_lokasi'] ?>" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        <h2 class="close_btn">Hide Map</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php require_once 'lib/footer.php'; ?>