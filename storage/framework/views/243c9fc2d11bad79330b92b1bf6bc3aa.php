<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Uly Dala Journal'); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li><a href="<?php echo e(route('about')); ?>">About</a></li>
                <li><a href="<?php echo e(route('articles.index')); ?>">Articles</a></li>
                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                    <li><a href="<?php echo e(route('submit.article')); ?>">Submit Article</a></li>
                    <li><a href="<?php echo e(route('profile')); ?>">Profile</a></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer>
        <p>&copy; <?php echo e(date('Y')); ?> Uly Dala Journal. All rights reserved.</p>
    </footer>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH /Users/syrymtolesh/Desktop/Online academic Journal/uly-dala/resources/views/layouts/app.blade.php ENDPATH**/ ?>