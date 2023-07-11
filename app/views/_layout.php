<?php
if (!isset($content)) {
    $content = '<p>no content</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Site</title>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://unpkg.com/htmx.org@1.9.2" integrity="sha384-L6OqL9pRWyyFU3+/bjdSri+iIphTN/bvYyM37tICVyOJkWZLpP2vGn6VUEXgzg6h" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.8"></script>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/about" hx-boost>About</a>
        </nav>
    </header>

    <main>
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; My Site - <?= date('Y'); ?></p>
    </footer>
</body>
</html>