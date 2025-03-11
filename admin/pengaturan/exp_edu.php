<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';

if (isset($_POST['tambah'])) {
    $tipe = $conn->real_escape_string($_POST['tipe']);
    $periode = $conn->real_escape_string($_POST['periode']);
    $instansi = $conn->real_escape_string($_POST['instansi']);
    $sebagai = $conn->real_escape_string($_POST['sebagai']);
    
    if (!$tipe || !$periode || !$instansi || !$sebagai) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Harap mengisi semua form.'
        );
    } else {
        $query = "INSERT INTO exp_edu VALUES (NULL, '$tipe', '$periode', '$instansi', '$sebagai')";
        
        if ($conn->query($query)) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Data berhasil ditambahkan.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Data gagal ditambahkan. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/pengaturan/exp_edu");
    exit();
} else if (isset($_POST['edit'])) {
    $post_id = $conn->real_escape_string($_POST['id']);
    $tipe = $conn->real_escape_string($_POST['tipe']);
    $periode = $conn->real_escape_string($_POST['periode']);
    $instansi = $conn->real_escape_string($_POST['instansi']);
    $sebagai = $conn->real_escape_string($_POST['sebagai']);

    $cek_exp_edu = $conn->query("SELECT id FROM exp_edu WHERE id = '$post_id'");
    $row = $cek_exp_edu->fetch_assoc();

    if (!$tipe || !$periode || !$instansi || !$sebagai) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Harap mengisi semua form.'
        );
    } else if ($cek_exp_edu->num_rows == 0) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Data tidak ditemukan.'
        );
    } else {
        if ($conn->query("UPDATE exp_edu SET tipe = '$tipe', periode = '$periode', instansi = '$instansi', sebagai = '$sebagai' WHERE id = '$post_id'") == true) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Data berhasil diedit.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Data gagal diedit. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/pengaturan/exp_edu");
    exit();
} else if (isset($_POST['hapus'])) {
    $post_id = $conn->real_escape_string($_POST['id']);

    $cek_exp_edu = $conn->query("SELECT id FROM exp_edu WHERE id = '$post_id'");

    if ($cek_exp_edu->num_rows == 0) {
        $_SESSION['response'] = array(
            'color' => 'danger',
            'icon' => 'close-circle',
            'title' => 'Gagal',
            'msg' => 'Data tidak ditemukan.'
        );
    } else {
        if ($conn->query("DELETE FROM exp_edu WHERE id = '$post_id'") == true) {
            $_SESSION['response'] = array(
                'color' => 'success',
                'icon' => 'check-circle',
                'title' => 'Berhasil',
                'msg' => 'Data berhasil dihapus.'
            );
        } else {
            $_SESSION['response'] = array(
                'color' => 'danger',
                'icon' => 'close-circle',
                'title' => 'Gagal',
                'msg' => 'Data gagal dihapus. <hr />' . $conn->error
            );
        }
    }

    header("Location: " . $aang_url . "admin/pengaturan/exp_edu");
    exit();
}

require '../lib/sidebar.php';
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-badge-account-outline me-1"></i> Exp & Edu
                    </h4>
                    <a href="javascript:void(0)" onclick="OpenModal('<?= $aang_url ?>admin/pengaturan/ajax/tambah')" class="btn btn-sm btn-primary">
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
                                <select name="tampil_beberapa" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                    <option value="10" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 10 ? 'selected' : '' ?>>Default</option>
                                    <option value="20" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 20 ? 'selected' : '' ?>>20</option>
                                    <option value="50" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 50 ? 'selected' : '' ?>>50</option>
                                    <option value="100" <?= isset($_POST['tampil_beberapa']) && $_POST['tampil_beberapa'] == 100 ? 'selected' : '' ?>>100</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Berdasarkan Tipe</label>
                                <select name="tampil_tipe" class="form-control" onchange="document.getElementById('filterForm').submit()">
                                    <option value="Semua" <?= isset($_POST['tampil_tipe']) && $_POST['tampil_tipe'] == 'Semua' ? 'selected' : '' ?>>Semua</option>
                                    <option value="Pendidikan" <?= isset($_POST['tampil_tipe']) && $_POST['tampil_tipe'] == 'Pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
                                    <option value="Pengalaman" <?= isset($_POST['tampil_tipe']) && $_POST['tampil_tipe'] == 'Pengalaman' ? 'selected' : '' ?>>Pengalaman</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Cari Data</label>
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
                                    <td class="text-center">Tipe</td>
                                    <td style="min-width: 180px;">Instansi</td>
                                    <td style="min-width: 180px;">Sebagai</td>
                                    <td style="min-width: 180px;">Periode</td>
                                    <td class="text-center">Aksi</td>
                                </tr>
                            </thead>
                            <tbody id="body_data">
                                <?php
                                $limit = isset($_POST['tampil_beberapa']) ? (int)$_POST['tampil_beberapa'] : 10;
                                $tipe = isset($_POST['tampil_tipe']) ? $_POST['tampil_tipe'] : 'Semua';
                                $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
                                $offset = ($page - 1) * $limit;
                                $cari_data = isset($_POST['cari_data']) ? $_POST['cari_data'] : '';

                                $where_clause = [];

                                if (!empty($cari_data)) {
                                    $where_clause[] = "instansi LIKE '%{$conn->real_escape_string($cari_data)}%' OR sebagai LIKE '%{$conn->real_escape_string($cari_data)}%'";
                                }

                                if ($tipe !== 'Semua') {
                                    $where_clause[] = "tipe = '{$conn->real_escape_string($tipe)}'";
                                }

                                $where = count($where_clause) > 0 ? "WHERE " . implode(' AND ', $where_clause) : '';

                                $query = "SELECT * FROM exp_edu {$where} ORDER BY id DESC LIMIT {$limit} OFFSET {$offset}";
                                $result = $conn->query($query);
                                $total_query = "SELECT COUNT(*) as total FROM exp_edu {$where}";
                                $total_result = $conn->query($total_query);
                                $total_data = $total_result->fetch_assoc()['total'];

                                if ($result->num_rows > 0) {
                                    $no = $offset + 1;
                                    while ($row_data = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td class="align-middle"><?= $no++ ?></td>
                                            <td class="align-middle text-center">
                                                <span class="form-control"><?= $row_data['tipe'] ?></span>
                                            </td>
                                            <td class="align-middle">
                                                <input class="form-control" value="<?= $row_data['instansi'] ?>" disabled>
                                            </td>
                                            <td class="align-middle">
                                                <input class="form-control" value="<?= $row_data['sebagai'] ?>" disabled>
                                            </td>
                                            <td class="align-middle">
                                                <input class="form-control" value="<?= $row_data['periode'] ?>" disabled>
                                            </td>
                                            <td class="text-center align-middle">
                                                <form action="" method="post" id="deleteForm<?= $row_data['id'] ?>">
                                                    <input type="hidden" name="id" value="<?= $row_data['id'] ?>">
                                                    <input type="hidden" name="hapus" value="1">
                                                    <a href="javascript:void(0)" onclick="OpenModal('<?= $aang_url ?>admin/pengaturan/ajax/edit?id=<?= $row_data['id'] ?>')" class="btn btn-sm btn-primary">
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
                                        <td colspan="3" class="text-center">Data tidak tersedia.</td>
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
                        Data
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