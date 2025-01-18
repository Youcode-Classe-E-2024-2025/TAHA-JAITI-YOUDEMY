<?php if (isset($_SESSION['error'])): ?>
    <div class="flex items-center justify-center w-full mt-4 text-xl text-red-500">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="flex items-center justify-center w-full mt-4 text-xl text-green-500">
        <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>