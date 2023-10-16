<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo SITE_NAME; ?>
    </title>

    <link rel="stylesheet" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>

    <header>
        <div class="row app-title-row">
            <div class="col-9 center-block text-center app-title">
                <?php echo SITE_NAME; ?>
            </div>
            <div class="col-3 user-menu">
                <ul>
                <?php if(!auth()->check()) : ?>
                    <li>
                        <a href="<?php echo route($routes->get('login')) ?>">
                            Belépés
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo route($routes->get('register')) ?>">
                            Regisztráció
                        </a>
                    </li>
                    <?php else : ?>
                    <li>
                        <a href="<?php echo route($routes->get('logout')) ?>">
                            Kilépés |
                        </a>
                    </li>
                    <li>
                        <?php echo Auth()->user()->name ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item <?php echo isRoute($routes->get('home')) ? 'active' : '' ?>">
                            <a class="nav-link" href="<?php echo route($routes->get('home')) ?>">Home</a>
                        </li>
                        <li class="nav-item <?php echo isRoute($routes->get('notebooks.index')) ? 'active' : '' ?>">
                            <a class="nav-link" href="<?php echo route($routes->get('notebooks.index')) ?>">Notebookok</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main class="overflow-x-hidden flex-grow">