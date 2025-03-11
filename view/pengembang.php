<?php
require '../config.php';
require_once '../lib/header.php';
require_once '../lib/navbar.php';
?>

    <section id="about" class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-content-part wow fadeInUp delay-0-2s">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?= $aang_url ?>view/aangbaejuri.png" class="rounded" alt="PM: Aang Baejuri">
                            </div>
                            <div class="col-lg-8">
                                <div class="pl-120">
                                    <h2 class="mb-0">HMTI</h2>
                                    <h5>Himpunan Mahasiswa Teknologi Informasi</h5>
                                    <p style="text-align: justify;">
                                        Website ini dirancang dan dikembangkan oleh komunitas Belajar Ngoding Bareng (BNB) yang merupakan bagian dari Himpunan Mahasiswa Teknologi Informasi (HMTI), di bawah naungan divisi Pengembangan Minat Bakat (PMB). Ini merupakan salah satu bentuk nyata kontribusi kami dalam membangun ekosistem pembelajaran dan pengembangan keterampilan di bidang teknologi informasi.
                                    </p>
                                </div>
                                <hr>
                                <div class="pl-120">
                                    <h3 class="mt-0">
                                        Aang Baejuri 
                                        <small class="text-primary" style="font-size: 16px;">| Project Manager</small>
                                    </h3>
                                    <p style="text-align: justify;">
                                        Sebagai Project Manager, saya berharap website ini dapat bermanfaat. Melalui pengembangan website ini, kami ingin menunjukkan bahwa setiap usaha dan kerja keras yang dilakukan tidak hanya berakhir di dalam forum saja, tetapi dapat memberikan dampak yang lebih luas. Semoga proyek ini menjadi salah satu pencapaian yang membanggakan dan akan terus berkembang.
                                    </p>
                                </div>
                                <div class="hero-btns">
                                    <a href="https://wa.me/628993123999" class="theme-btn">Hubungi Saya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div crss="about-content-part-bottom wow fadeInUp delay-0-2s mt-5">
                        <div class="company-list">
                            <div class="scroller" data-direction="left" data-speed="fast">
                                <div class="scroller__inner">
                                    <h4>
                                        <img src="<?= $aang_url ?>view/kampus.png" width="120" alt="Kampus" title="Institut Teknologi dan Bisnis Banten" class="img-fluid my-0">
                                    </h4>
                                    <h4>
                                        <img src="<?= $aang_url ?>view/organisasi.png" width="100" alt="Organisasi" title="Himpunan Mahasiswa Teknologi Informasi" class="img-fluid my-0">
                                    </h4>
                                    <h4>
                                        <img src="<?= $aang_url ?>view/komunitas.png" width="100" alt="Komunitas" title="Belajar Ngoding Bareng" class="img-fluid my-0">
                                    </h4>
                                    <h4>
                                        <img src="<?= $aang_url ?>view/pengembang.png" width="120" alt="Pengembang" title="Aang Baejuri" class="img-fluid my-0">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require_once '../lib/footer.php'; ?>