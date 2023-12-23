<?php
// alihkan jika bukan admin atau belum login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php?page=pub_login');
}
?>
<div class="col-12 p-4 mt-4">
    <h2>Data Aturan</h2>
    <div class="mb-3">
        <a type="button" class="btn btn-info" href="?page=admin_rule_tambah">
            Tambah Aturan
        </a>
    </div>
    <table class="table" id="kriteriaTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Nilai</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data Kriteria akan ditampilkan di sini -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTable
        var table = $('#kriteriaTable').DataTable({
            ajax: {
                url: 'ajax/get_rule.php', // Ganti dengan URL sesuai kebutuhan
                dataSrc: ''
            },
            columns: [
                { data: null },
                { data: 'nama' },
                { data: 'kode' },
                { data: 'nilai' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<button class="btn btn-warning btn-sm" onclick="editKriteria(' + row.id + ')">Ubah</button>' +
                            ' <button class="btn btn-danger btn-sm" onclick="hapusKriteria(' + row.id + ')">Hapus</button>';
                    }
                }
            ],
            columnDefs: [
                {
                    targets: 0,
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }
            ],
        });

        // Filter Pencarian
        $('#kriteriaTable').on('keyup', 'tfoot input', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });
    });

    // Fungsi untuk menghandle aksi ubah
    function editKriteria(id) {
        // Redirect atau tampilkan modal untuk ubah data
        window.location.href = '?page=admin_rule_edit&id=' + id;
    }

    // Fungsi untuk menghandle aksi hapus
    function hapusKriteria(id) {
        // Implementasikan logika hapus data (misalnya menggunakan konfirmasi)
        if (confirm('Apakah Anda yakin ingin menghapus kriteria ini?')) {
            // Redirect atau jalankan skrip hapus data
            window.location.href = 'action/rule_hapus.php?id=' + id;
        }
    }
</script>
