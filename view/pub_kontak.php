<!-- Konten Halaman Kontak -->
<div class="container mt-4" style="min-height: 70vh;">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header">
                <h5 class="card-title">Kontak Kami</h5>
            </div>
            <div class="card-body">
                <form action="proses_kontak.php" method="post">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan</label>
                        <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>