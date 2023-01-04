<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= !empty($title) ? $title : 'Document'; ?></title>
    <link rel="stylesheet" href="<?= ASSET_URL . '/bootstrap/css/bootstrap.min.css'; ?>">
</head>
<body class="text-light" style="background-color: #002030;">
<div class="container">
    <?php require_once VIEW_DIR . '/nav.php' ?>
