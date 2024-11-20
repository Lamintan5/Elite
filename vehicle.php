<title>Elite Car Rental</title>
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style2.css">
    <style>
        .section2{
            margin-top: 100px;
            background-color: #fff;
        }
    </style>
</head>
<body>
<header>
        <h2 class="logo"><span>E</span>lite <span>C</span>ar <span>R</span>ental</h2>
        <nav class="navigation">
            
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'Admin'): ?>
                <!-- Show Dashboard if user is logged in and user type is Admin -->
                <a href="dashboard.php">Dashboard</a>
            <?php endif; ?>

        </nav>
        <?php if (isset($_SESSION['user'])): ?>
            <!-- Show Log out if user is logged in -->
            <a href="logout.php" class="btn-talk">Log out</a>
        <?php else: ?>
            <!-- Show Log in if no user session -->
            <a href="auth.html" class="btn-talk">Log in</a>
        <?php endif; ?>
    </header>

    <section id="vehicles" class="vehicles-section section2">
        <div class="position-relative d-flex align-items-center justify-content-center">
            <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Vehicles</h1>
            <h1 class="position-absolute text-uppercase text-primary color:#7d2ae8">Our Vehicles</h1>
        </div>
        <div class="vehicles-grid">
            <!-- Vehicle cards will be populated here -->
        </div>
        <br>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>