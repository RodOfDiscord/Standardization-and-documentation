<?php

use models\Users;
/** @var string $Title */
/** @var string $Content */

if (empty($Title)) {
    $Title = "";
}
if (empty($Content)) {
    $Content = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= htmlspecialchars($Title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f0f8ff;
            color: #343a40;
        }
        .nav-link {
            font-weight: 500;
            color: #ffffff !important;
        }
        .nav-link:hover {
            color: #00050a !important;
        }
        header {
            background-color: #007bff;
        }
        .rounded-circle {
            border: 2px solid #ffffff;
        }
        .dropdown-menu {
            border-radius: 0.25rem;
            background-color: #007bff;
            color: #ffffff;
        }
        .dropdown-item:hover {
            background-color: #697dff;
            color: #ffffff;
        }
        .container h1 {
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 2.5rem;
            text-align: center;
            color: #6982ff;
        }
        .search-form {
            max-width: 200px;
        }
        footer {
            border-top: 1px solid #e9ecef;
            background-color: #007bff;
            color: #ffffff;
        }
        .footer-link {
            color: #ffffff !important;
        }
        .footer-link:hover {
            color: #6975ff !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start py-3 mb-4">
    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2">Головна</a></li>
        <?php if (Users::isAdmin()) : ?>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Адміністрування
                </a>
                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="/admin/edit">Редагувати фільми</a></li>
                    <li><a class="dropdown-item" href="/admin/add">Додати фільм</a></li>
                    <li><a class="dropdown-item" href="/admin/delete">Видалити фільм</a></li>
                </ul>
            </li>
        <?php endif; ?>

        <?php if (!Users::IsUserLogged()) : ?>
            <li><a href="/users/login" class="nav-link px-2">Увійти</a></li>
            <li><a href="/users/register" class="nav-link px-2">Зареєструватись</a></li>
        <?php endif; ?>
    </ul>

    <?php if (Users::IsUserLogged()) : ?>
        <div class="dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

            </a>
            <ul class="dropdown-menu text-small">
                <li><a class="dropdown-item" href="/users/profile">Профіль</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/users/logout">Вийти</a></li>
            </ul>
        </div>
    <?php endif; ?>
</header>

<div class="container">
    <h1><?= htmlspecialchars($Title) ?></h1>
    <?= $Content ?>
</div>

<footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 footer-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 footer-link">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 footer-link">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 footer-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 footer-link">About</a></li>
    </ul>
    <p class="text-center">© 2024 Company, Inc</p>
</footer>
</body>
</html>
