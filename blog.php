<?php
require 'config.php';
require_once 'lib/db.php';
require_once 'lib/header.php';
require_once 'lib/navbar.php';

$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';

if ($search) {
    $get_post = $conn->query("SELECT * FROM postingan WHERE judul LIKE '%$search%' OR keyword LIKE '%$search%' ORDER BY id LIMIT $start, $limit");
    $total_data = $conn->query("SELECT COUNT(*) FROM postingan WHERE judul LIKE '%$search%' OR keyword LIKE '%$search%'")->fetch_row()[0];
} else {
    $get_post = $conn->query("SELECT * FROM postingan ORDER BY id LIMIT $start, $limit");
    $total_data = $conn->query("SELECT COUNT(*) FROM postingan")->fetch_row()[0];
}

$pages = ceil($total_data / $limit);
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
                                <li><a href="<?= $data_kontak['email'] ?>"><i class="ri-mail-fill"></i></a></li>
                                <li><a href="<?= $data_kontak['ig'] ?>"><i class="ri-instagram-fill"></i></a></li>
                                <li><a href="<?= $data_kontak['wa'] ?>"><i class="ri-whatsapp-fill"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-content-part wow fadeInUp delay-0-2s">
                        <form action="" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari..." value="<?= $search ?>">
                                <button type="submit" class="btn btn-success"><i class="ri-search-fill"></i></button>
                            </div>
                        </form>
                    </div>

                    <?php if ($get_post->num_rows > 0) { ?>
                        <?php while ($data_post = $get_post->fetch_assoc()) { ?>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="blog-post-img">
                                                <a href="<?= $aang_url ?>detail?keyword=<?= $data_post['keyword'] ?>">
                                                    <img src="<?= $aang_url . $data_post['banner'] ?>" alt="<?= $data_post['judul'] ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <small class="mt-1"><?= datetime_indo($data_post['datetime']) ?></small>
                                            <h2>
                                                <a href="<?= $aang_url ?>detail?keyword=<?= $data_post['keyword'] ?>"><?= $data_post['judul'] ?></a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-center my-4">Tidak ada data yang ditemukan.</p>
                    <?php } ?>

                    <hr>

                    <ul class="pagination d-flex align-items-center" id="button_pagination">
                        <?php if ($pages > 1) { ?>
                            <?php if ($page > 1) { ?>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(1)">First</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(<?= $page - 1 ?>)"><i class="ri-arrow-left-line"></i></a></li>
                            <?php } ?>
                            <?php if ($page < $pages) { ?>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(<?= $page + 1 ?>)"><i class="ri-arrow-right-line"></i></a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(<?= $pages ?>)">Last</a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <script>
        function changePage(page) {
            const searchQuery = document.querySelector('input[name="search"]').value;
            let url = window.location.href.split('?')[0] + `?page=${page}`;

            if (searchQuery) {
                url += `&search=${encodeURIComponent(searchQuery)}`;
            }

            window.location.href = url;
        }
    </script>

<?php require_once 'lib/footer.php'; ?>
