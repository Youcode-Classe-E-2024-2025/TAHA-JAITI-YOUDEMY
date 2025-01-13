<?php if (isset($_SESSION['error'])): ?>
    <div class="text-red-500 text-2xl">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>