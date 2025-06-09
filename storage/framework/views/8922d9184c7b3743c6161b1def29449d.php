<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo e(route('homepage')); ?>">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
    </li>
    <?php if(auth()->guard()->guest()): ?>
    <li class="nav-item">
        <a class="nav-link text-primary" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Masuk</a>
    </li>
    <?php endif; ?>
    <?php if(auth()->guard()->check()): ?>
    <li class="nav-item">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="nav-link btn btn-link">Logout</button>
        </form>
    </li>
    <?php endif; ?>
</ul>
<?php /**PATH C:\Users\ASUS\Documents\Semester 4\AgroIndustri\ProjectPPL\Goatbiz2\resources\views/components/navbar.blade.php ENDPATH**/ ?>