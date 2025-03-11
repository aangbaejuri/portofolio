                </div>
            </div>
            
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Created by <b><?= $data_web['author'] ?></b>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="<?= $aang_url ?>admin/assets/js/vendor.min.js"></script>
    <script src="<?= $aang_url ?>admin/assets/vendor/lucide/umd/lucide.min.js"></script>
    <!-- Quill Editor js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/quill/quill.min.js"></script>
    <!-- Quill Demo js -->
    <script src="<?= $aang_url ?>admin/assets/js/pages/quilljs.init.js"></script>
    <!--  Select2 Plugin Js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/select2/js/select2.min.js"></script>
    <!-- Daterangepicker Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= $aang_url ?>admin/assets/vendor/daterangepicker/daterangepicker.js"></script>
    <!-- Bootstrap Datepicker Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap Timepicker Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <!-- Input Mask Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/jquery-mask-plugin/jquery.mask.min.js"></script>
    <!-- Bootstrap Touchspin Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Bootstrap Maxlength Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <!-- Typehead Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/handlebars/handlebars.min.js"></script>
    <script src="<?= $aang_url ?>admin/assets/vendor/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- Flatpickr Timepicker Plugin js -->
    <script src="<?= $aang_url ?>admin/assets/vendor/flatpickr/flatpickr.min.js"></script>
    <!-- Typehead Demo js -->
    <script src="<?= $aang_url ?>admin/assets/js/pages/typehead.init.js"></script>
    <!-- Timepicker Demo js -->
    <script src="<?= $aang_url ?>admin/assets/js/pages/timepicker.init.js"></script>
    <!-- Table Editable plugin-->
    <script src="<?= $aang_url ?>admin/assets/vendor/jquery-tabledit/jquery.tabledit.min.js"></script>
    <!-- Table editable init-->
    <script src="<?= $aang_url ?>admin/assets/js/pages/tabledit.init.js"></script>
    <!-- App js -->
    <script src="<?= $aang_url ?>admin/assets/js/app.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Modal -->
    <script type="text/javascript">
        function OpenModal(url) {
            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $('#modal-detail-body').html('Sedang memuat...');
                },
                success: function(result) {
                    $('#modal-detail-body').html(result);
                    $('#modal-detail').modal('show');
                },
                error: function() {
                    $('#modal-detail-body').html('Terjadi kesalahan.');
                }
            });
        }
    </script>

</body>
</html>