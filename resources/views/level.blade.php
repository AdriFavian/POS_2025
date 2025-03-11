<div class="container">
    <h2>Level User</h2>
    <table id="levelUserTable" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Level</th>
                <th>Nama Level</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#levelUserTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('level-user.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'id_level', name: 'id_level' },
                { data: 'nama_level', name: 'nama_level' }
            ]
        });
    });
</script>

{{--
<!DOCTYPE html>
<html>

<head>
    <title>Data Level Pengguna</title>
</head>

<body>
    <h1>Data Level Pengguna</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->level_id }}</td>
            <td>{{ $d->level_kode }}</td>
            <td>{{ $d->level_nama }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html> --}}