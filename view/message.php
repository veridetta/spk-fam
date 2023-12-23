<?php if ($pesan): ?>
    <div class="mb-0 alert alert-<?php echo $pesan['jenis']; ?> alert-dismissible fade show" role="alert">
        <?php echo $pesan['pesan']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
