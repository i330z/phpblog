<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="style.css">
    <title>php Blog</title>
</head>
<body>
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Pizza House</a>
        </div>
        <?php if(isset($_SESSION['email'])) : ?>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li>
                    <a href="add.php" class="btn brand z-depth-0">Add a Post</a>
                </li>
            </ul>

        <?php endif ?>
    </nav>