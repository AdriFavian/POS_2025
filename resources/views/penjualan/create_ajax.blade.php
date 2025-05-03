<form action="{{ url('/penjualan/ajax') }}" method="POST" id="form-tambah-penjualan">
    @csrf
    {{-- Hapus div modal-dialog dan modal-content dari sini --}}
    <div class="modal-header">
        <h5 class="modal-title">Tambah Transaksi Penjualan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Kasir/User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">- Pilih User -</option>
                @foreach($users as $user)
                    <option value="{{ $user->user_id }}">{{ $user->nama }}</option>
                @endforeach
            </select>
            <small id="error-user_id" class="error-text form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label>Pembeli</label>
            <input type="text" name="pembeli" id="pembeli" class="form-control" required placeholder="Nama Pembeli">
            <small id="error-pembeli" class="error-text form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="datetime-local" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" required>
            <small id="error-penjualan_tanggal" class="error-text form-text text-danger"></small>
        </div>

        <hr>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <label class="font-weight-bold">Detail Barang</label>
            <button type="button" class="btn btn-success btn-sm" id="add-barang">
                <i class="fas fa-plus"></i> Tambah Item
            </button>
        </div>

        <div id="barang-list">
            <div class="card mb-2 barang-item">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label>Pilih Barang</label>
                            <select name="barang_id[]" class="form-control select-barang" required> {{-- Tambah class
                                select-barang --}}
                                <option value="">- Pilih Barang -</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">
                                        {{ $b->barang_nama }}</option> {{-- Tambah data-harga --}}
                                @endforeach
                            </select>
                            <small class="error-text form-text text-danger"></small>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Harga</label>
                            <input type="number" name="harga[]" class="form-control input-harga" placeholder="Harga"
                                min="0" required> {{-- Tambah class input-harga --}}
                            <small class="error-text form-text text-danger"></small>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" min="1"
                                required>
                            <small class="error-text form-text text-danger"></small>
                        </div>
                        <div class="col-md-1 form-group">
                            <label class="d-block" style="visibility: hidden;">Aksi</label>
                            <button type="button" class="btn btn-danger btn-sm remove-barang">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    {{-- Hapus penutup div modal-dialog dan modal-content dari sini --}}
</form>

<script>
    $(document).ready(function () {
        // Set tanggal sekarang sebagai default
        let now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        $('#penjualan_tanggal').val(now.toISOString().slice(0, 16));

        // Fungsi untuk mengambil harga barang saat dipilih
        function setHargaBarang(selectElement) {
            let selectedOption = $(selectElement).find('option:selected');
            let harga = selectedOption.data('harga') || ''; // Ambil harga dari data attribute
            $(selectElement).closest('.barang-item').find('.input-harga').val(harga);
        }

        // Event listener untuk select barang yang sudah ada
        $('.select-barang').each(function () {
            setHargaBarang(this); // Set harga awal jika ada
        });

        // Event listener untuk perubahan select barang (termasuk yang baru ditambahkan)
        $(document).on('change', '.select-barang', function () {
            setHargaBarang(this);
        });

        $('#add-barang').click(function () {
            let html = $('.barang-item:first').clone();
            html.find('input,select').val('');
            html.find('.error-text').text('');
            html.find('.select-barang').val(''); // Pastikan select direset
            html.find('.input-harga').val(''); // Kosongkan harga
            $('#barang-list').append(html);
        });

        $(document).on('click', '.remove-barang', function () {
            if ($('.barang-item').length > 1) $(this).closest('.barang-item').remove();
            else Swal.fire('Info', 'Minimal harus ada 1 item barang.', 'info'); // Info jika hanya 1 item
        });

        $("#form-tambah-penjualan").validate({
            rules: {
                user_id: { required: true },
                pembeli: { required: true },
                penjualan_tanggal: { required: true },
                "barang_id[]": { required: true },
                "harga[]": { required: true, number: true, min: 0 },
                "jumlah[]": { required: true, number: true, min: 1 }
            },
            messages: { // Pesan error kustom
                user_id: "Kasir harus dipilih.",
                pembeli: "Nama pembeli harus diisi.",
                penjualan_tanggal: "Tanggal penjualan harus diisi.",
                "barang_id[]": "Barang harus dipilih.",
                "harga[]": {
                    required: "Harga harus diisi.",
                    number: "Harga harus berupa angka.",
                    min: "Harga tidak boleh negatif."
                },
                "jumlah[]": {
                    required: "Jumlah harus diisi.",
                    number: "Jumlah harus berupa angka.",
                    min: "Jumlah minimal 1."
                }
            },
            submitHandler: function (form) {
                // Tambahkan konfirmasi sebelum submit
                Swal.fire({
                    title: 'Konfirmasi Simpan',
                    text: "Apakah Anda yakin ingin menyimpan transaksi ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: $(form).serialize(),
                            beforeSend: function () { // Tambahkan loading indicator
                                Swal.fire({
                                    title: 'Menyimpan...',
                                    text: 'Mohon tunggu sebentar.',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading()
                                    }
                                });
                            },
                            success: function (response) {
                                Swal.close(); // Tutup loading indicator
                                if (response.success) {
                                    $('#myModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message,
                                        timer: 1500, // Tutup otomatis setelah 1.5 detik
                                        showConfirmButton: false
                                    });
                                    // Reload tabel
                                    $('#table_penjualan').DataTable().ajax.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message || 'Terjadi kesalahan saat menyimpan data.'
                                    });
                                }
                            },
                            error: function (xhr) {
                                Swal.close(); // Tutup loading indicator jika error
                                $('.error-text').text(''); // Bersihkan error sebelumnya
                                let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                                if (xhr.responseJSON) {
                                    if (xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }
                                    if (xhr.responseJSON.errors) {
                                        errorMessage = 'Silakan periksa kembali form isian Anda.';
                                        $.each(xhr.responseJSON.errors, function (key, value) {
                                            // Handle array fields like barang_id.0, harga.1 etc.
                                            let elementKey = key.replace(/\./g, '_'); // Ganti titik dengan underscore jika ada
                                            let errorContainer = $('#form-tambah-penjualan').find('[name="' + elementKey + '"]').closest('.form-group').find('.error-text');
                                            if (errorContainer.length === 0) { // Fallback for array fields
                                                let parts = key.split('.');
                                                if (parts.length === 2) {
                                                    let baseName = parts[0] + '[]';
                                                    let index = parseInt(parts[1]);
                                                    errorContainer = $('#form-tambah-penjualan').find('[name="' + baseName + '"]').eq(index).closest('.form-group').find('.error-text');
                                                }
                                            }
                                            if (errorContainer.length > 0) {
                                                errorContainer.text(value[0]);
                                            } else {
                                                // Jika tidak ketemu, tampilkan di tempat umum atau log
                                                console.error("Cannot find error container for:", key);
                                            }
                                        });
                                    }
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    text: errorMessage
                                });
                            }
                        });
                    }
                });
                return false; // Cegah submit form standar
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                // Tempatkan error di dalam small.error-text yang sesuai
                element.closest('.form-group').find('.error-text').text(error.text());
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
                // Hapus teks error saat valid
                $(element).closest('.form-group').find('.error-text').text('');
            }
        });
    });
</script>