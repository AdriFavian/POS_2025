<form action="{{ url('/barang/import_ajax') }}" method="POST" id="form-import" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mb-0">
                    <i class="fa fa-upload mr-2"></i> Import Data Barang
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Download Template -->
                <div class="form-group">
                    <label>Download Template</label><br>
                    <a href="{{ asset('assets/templates/template_barang.xlsx') }}" class="btn btn-info btn-sm" download>
                        <i class="fa fa-file-excel"></i> Download Template
                    </a>
                    <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                </div>

                <!-- Input File -->
                <div class="form-group">
                    <label for="file_barang">Pilih File Excel (.xlsx)</label>
                    <input type="file" class="form-control" id="file_barang" name="file_barang" required>
                    <small id="error-file_barang" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>

        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#form-import").validate({
            rules: {
                file_barang: {
                    required: true,
                    extension: "xlsx|xls"
                }
            },
            submitHandler: function (form) {
                var formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            }).then(() => {
                                tableBarang.ajax.reload();
                            });
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });

        // Update label input file saat file dipilih
        $('#file_barang').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });
    });
</script>
