<!-- Konten Halaman Login -->
<div class="container mt-4" style="min-height: 70vh;">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header">
                <h5 class="card-title">Login</h5>
            </div>
            <div class="card-body">
                <!-- Formulir Login -->
                <form action="action/login.php" method="post">
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="mt-3 btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>