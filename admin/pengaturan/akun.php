<?php 
require '../../config.php';
require '../lib/session.php';
require '../lib/header.php';
require '../lib/sidebar.php';
?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-post-outline"></i> Postingan
                    </h4>
                    <a href="" class="btn btn-sm btn-primary">
                        <i class="mdi mdi-plus"></i> Data
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Tampilkan Beberapa</label>
                            <select class="form-select select2" data-toggle="select2">
                                <option value="10">Default</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-lg-8 mb-3">
                            <label class="form-label">Pencarian</label>
                            <input type="text" class="form-control" placeholder="Cari...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <td>#</td>
                                    <td>Judul</td>
                                    <td class="text-center">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">1</td>
                                    <td>
                                        <input class="form-control" value="Lorem ipsum dolor sit amet" disabled>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-sm btn-primary">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="" class="btn btn-sm btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <p class="mb-0">
                        Data:
                        <span class="fw-semibold">10</span>
                    </p>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);" aria-label="Previous">
                                    <span aria-hidden="true">First</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);"><</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);" aria-label="Next">
                                    <span aria-hidden="true">Last</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php 
require '../lib/footer.php';
?>