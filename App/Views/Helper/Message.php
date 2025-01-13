<?php if (isset($_SESSION['error'])): ?>
    <div class="text-red-500 text-xl mt-4 flex justify-center items-center w-full">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="text-green-500 text-xl mt-4 flex justify-center items-center w-full">
        <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>