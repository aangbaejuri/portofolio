<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';

if (isset($_POST['tambah'])) {
    $nama = $conn->real_escape_string($_POST['nama']);
    $kode_akses = $conn->real_escape_string($_POST['kode_akses']);

    $cek_kode_akses = $conn->query("SELECT * FROM users WHERE kode_akses = '$kode_akses'");

    if (!$nama || !$kode_akses) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Harap mengisi semua form.'
        );
    } else if ($cek_kode_akses->num_rows > 0) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Kode akses <strong>' . $kode_akses . '</strong> sudah digunakan.'
        );
    } else {
        $hash_pass = password_hash($kode_akses, PASSWORD_DEFAULT);

        if ($conn->query("INSERT INTO users VALUES (NULL, '$nama', '$sess_nama', '$kode_akses', '$hash_pass', '', '$datetime')")) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Akun baru berhasil ditambahkan.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Akun gagal ditambahkan. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/akun");
    exit();
} else if (isset($_POST['edit'])) {
    $post_id = $conn->real_escape_string($_POST['id']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $password = $conn->real_escape_string($_POST['password']);

    if (!$nama) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Form tidak boleh kosong.'
        );
    } else {
        if (!empty($password)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($conn->query("UPDATE users SET nama = '$nama', password = '$password_hash' WHERE id = '$post_id'") == true) {
                $_SESSION['response'] = array(
                    'color' => 'success',
                    'icon' => 'check-circle',
                    'title' => 'Berhasil',
                    'msg' => 'Data akun berhasil diperbarui.'
                );
            }
        } else {
            if ($conn->query("UPDATE users SET nama = '$nama' WHERE id = '$post_id'") == true) {
                $_SESSION['response'] = array(
                    'color' => 'success',
                    'icon' => 'check-circle',
                    'title' => 'Berhasil',
                    'msg' => 'Data akun berhasil diperbarui.'
                );
            }
        }
    }

    header("Location: " . $aang_url . "admin/akun/");
    exit();
} else if (isset($_POST['hapus'])) {
    $post_id = $conn->real_escape_string($_POST['id']);

    $cek_akun = $conn->query("SELECT * FROM users WHERE id = '$post_id'");

    if ($cek_akun->num_rows == 0) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Akun tidak ditemukan.'
        );
    } else {
        $row = $cek_akun->fetch_assoc();

        if ($conn->query("DELETE FROM users WHERE id = '$post_id'") == true) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Akun berhasil dihapus.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Akun gagal dihapus. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/akun/");
    exit();
}

require '../lib/sidebar.php';
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group-outline me-1"></i> Akun Administrator
                    </h4>
                    <a href="javascript:;" onclick="OpenModal('<?= $aang_url ?>admin/akun/tambah')" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-plus"></i> Data
                    </a>
                </div>
                <div class="card-body custom-card-action">
                    <form id="filterForm" action="" method="post">
                        <input type="hidden" name="csrf_token" value="<?= $config['csrf_token'] ?>">
                        <input type="hidden" name="page" value="<?= isset($_POST['page']) ? (int)$_POST['page'] : 1 ?>">

                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Tampilkan Beberapa</label>
                                <select name="tampil_beberapa" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                    <option value="10" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 10 ? 'selected' : '' ?>>Default</option>
                                    <option value="20" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 20 ? 'selected' : '' ?>>20</option>
                                    <option value="50" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 100 ? 'selected' : '' ?>>100</option>
                                </select>
                            </div>
                            <div class="col-lg-8 mb-3">
                                <label class="form-label">Pencarian</label>
                                <div class="input-group">
                                    <input name="cari_data" type="search" class="form-control" placeholder="Cari..." value="<?= isset($_POST['cari_data']) ? htmlspecialchars($_POST['cari_data'], ENT_QUOTES) : '' ?>">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <td>#</td>
                                    <td style="min-width: 180px;">Nama</td>
                                    <td style="min-width: 180px;">Kode Akses</td>
                                    <td class="text-center">Aksi</td>
                                </tr>
                            </thead>
                            <tbody id="body_data">
                                <?php
                                $limit = isset($_POST['tampil_beberapa']) ? (int)$_POST['tampil_beberapa'] : 10;
                                $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
                                $offset = ($page - 1) * $limit;
                                $cari_data = isset($_POST['cari_data']) ? $_POST['cari_data'] : '';

                                $where_clause = [];

                                if (!empty($cari_data)) {
                                    $where_clause[] = "nama LIKE '%{$conn->real_escape_string($cari_data)}%'";
                                }

                                $where = count($where_clause) > 0 ? "WHERE " . implode(' AND ', $where_clause) : '';

                                $query = "SELECT * FROM users {$where} ORDER BY id DESC LIMIT {$limit} OFFSET {$offset}";
                                $result = $conn->query($query);
                                $total_query = "SELECT COUNT(*) as total FROM users {$where}";
                                $total_result = $conn->query($total_query);
                                $total_data = $total_result->fetch_assoc()['total'];

                                if ($result->num_rows > 0) {
                                    $no = $offset + 1;
                                    while ($row_data = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td class="align-middle"><?= $no++ ?></td>
                                            <td class="align-middle">
                                                <input class="form-control" value="<?= $row_data['nama'] ?>" disabled>
                                            </td>
                                            <td class="align-middle">
                                                <input class="form-control" value="<?= $row_data['kode_akses'] ?>" disabled>
                                            </td>
                                            <td class="text-center">
                                                <form action="" method="post" id="deleteForm<?= $row_data['id'] ?>">
                                                    <input type="hidden" name="id" value="<?= $row_data['id'] ?>">
                                                    <input type="hidden" name="hapus" value="1">
                                                    <a href="javascript:;" onclick="OpenModal('<?= $aang_url ?>admin/akun/edit?id=<?= $row_data['id'] ?>')" class="btn btn-sm btn-primary">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $row_data['id'] ?>)">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Data tidak tersedia.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p class="mb-0">
                        Data:
                        <span class="fw-semibold"><?= $total_data ?></span>
                    </p>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0" id="button_pagination">
                            <?php
                            $pages = ceil($total_data / $limit);
                            if ($total_data > $limit) {
                                if ($page > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(1)">First</a></li>';
                                    echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(' . ($page - 1) . ')"><i class="bi bi-arrow-left"></i></a></li>';
                                }
                                if ($page < $pages) {
                                    echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(' . ($page + 1) . ')"><i class="bi bi-arrow-right"></i></a></li>';
                                    echo '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="changePage(' . $pages . ')">Last</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg" tabindex="-1" aria-modal="true" role="dialog" style="display: block;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mt-0">
                        Data Akun
                    </h4>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body" id="modal-detail-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }

        function changePage(page) {
            const form = document.getElementById('filterForm');
            form.querySelector('input[name="page"]').value = page;
            form.submit();
        }
    </script>

<?php 
require '../lib/footer.php';
?>