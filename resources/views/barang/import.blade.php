<form action="{{ url('/barang/import_ajax') }}" method="POST" id="form-import" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    Import Data Barang
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Card Info & Template Download -->
                <div class="card border-0 shadow-sm bg-light mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-info-circle text-dark mr-2"></i>
                            <span class="text-dark small">Format File Excel:</span>
                        </div>
                
                        <div class="border rounded p-2 d-flex flex-wrap justify-content text-dark small mb-3" style="background-color: #f8f9fa;">
                            <div class="px-2"><strong>Kolom A:</strong> kategori_id</div>
                            <div class="px-2"><strong>Kolom B:</strong> barang_kode</div>
                            <div class="px-2"><strong>Kolom C:</strong> barang_nama</div>
                            <div class="px-2"><strong>Kolom D:</strong> harga_beli</div>
                            <div class="px-2"><strong>Kolom E:</strong> harga_jual</div>
                        </div>
                
                        <a href="{{ asset('assets/templates/template_barang.xlsx') }}"
                            class="btn btn-sm btn-outline-dark" download>
                            <i class="fa fa-file-excel text-green"></i> Download Template
                        </a>
                    </div>
                </div>      

                <!-- File Input -->
                <div class="form-group">
                    <label for="file_barang" class="font-weight-bold">
                        File Excel (.xlsx)
                    </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file_barang" name="file_barang" required>
                        <label class="custom-file-label" for="file_barang">
                            Pilih file...
                        </label>
                    </div>
                    <small id="error-file_barang" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary btn-sm">
                    Batal
                </button>
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fa fa-upload"></i> Upload
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    // Pastikan script ini dijalankan setelah modal selesai di-load
    $('#myModal').on('shown.bs.modal', function () {
        // Update label custom-file saat file dipilih
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $("#form-import").validate({
            rules: {
                file_barang: {
                    required: true,
                    extension: "xlsx"
                }
            },
            submitHandler: function (form) {
                var formData = new FormData(form); // Meng-handle file dengan FormData
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            // Jika sukses
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            }).then(() => {
                                location.reload();
                                tableBarang.ajax.reload();
                            });
                        } else {
                            // Jika terjadi error
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
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>