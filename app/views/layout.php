<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="site e-commerce">
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?? '' ?>">
    <title><?= e($title) ?? 'Mon App' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/form.css">
    <script src="/js/main.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>
<?php
$uri = trim($_SERVER['REQUEST_URI'], '/');
$segments = explode('/', $uri);

// Ignorer les segments numériques (IDs)
$staticSegments = array_filter($segments, fn($seg) => !is_numeric($seg));

// Construire un identifiant de page dynamique
$pageId = implode('_', $staticSegments);

if (empty($pageId)) {
    $pageId = 'index';
}
?>

<body data-page="<?= e($pageId) ?>">
    <?php include_once 'partials/navbar.php' ?>
    <?php include_once 'partials/flashmessage.php' ?>
    <main class="container-fluid flex-col">
        <?= $content ?>
    </main>
</body>

</html>