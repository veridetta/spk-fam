<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container">
        <a class="navbar-brand" href="#">SI MONI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=pub_tentang">Tentang Kami</a>
                </li>
                <?php 
                if(isset($_SESSION['user_id'])){
                    if($_SESSION['role'] == 'admin'){
                        echo '<li class="nav-item">
                                <a class="nav-link" href="?page=admin_beranda">Admin</a>
                            </li>';
                    }else{
                        echo '<li class="nav-item">
                                <a class="nav-link" href="?page=pub_testimoni">Testimoni</a>
                            </li>';
                    }
                    echo '<li class="nav-item">
                            <a class="nav-link" href="action/logout.php">Logout</a>
                        </li>';
                }else{
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=pub_daftar">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=pub_login">Login</a>
                    </li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="?page=pub_kontak">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>