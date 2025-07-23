<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Forest Tree</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/icon.png" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        .table {
            width: 80%;
            font-size: 12px;
            margin: 0 auto;
        }
        .table th,
        .table td {
            padding: 8px;
        }
        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }
        .page-item {
            margin: 5px;
        }
        .page-link {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #fff;
            color: #007bff;
            transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .page-link:hover {
            background-color: #007bff;
            color: #fff;
        }
        .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>

<header id="header" class="fixed-top">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-9 d-flex align-items-center justify-content-lg-between">
                <h1 class="logo me-auto me-lg-0"><a href="index.php">Forest Tree</a></h1>
                <nav id="navbar" class="navbar order-last order-lg-0">
                    <ul>
                        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                        <li><a class="nav-link scrollto" href='forest.php'>View Data</a></li>
                        <li class="dropdown"><a href="#"><span>Stand Table</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href='standtable1.php'>Assignment 1</a></li>
                                <li class="dropdown"><a href='standtable2.php'>Assignment 2<i class="bi bi-chevron-down"></i></a>
                                    <ul>
                                        <li><a href='trees_to_fell.php'>Trees To Fell</a></li>
                                        <li><a href='production_damage_growth.php'>Production,Damage and Growth</a></li>
                                        <li><a href='production_year30.php'>Production Timber Year 30</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a class="nav-link scrollto" href='tree_distribution.php'>Tree Distribution</a></li>
                        <li><a class="nav-link scrollto" href='about.php'>About Us</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
                <a href="random2.php" class="get-started-btn scrollto">Generate Data</a>
            </div>
        </div>
    </div>
</header>

<section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <h1>Stand Table 1 - Diameter Breast Height</h1>
                <a href="#about" class="glightbox play-btn mb-4"></a>
            </div>
        </div>
    </div>
</section>

<main id="main">
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Trees to Fell</h2>
                <p>Table showing trees to fell based on criteria.</p>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    // Database connection
                    require('mysqli_connect.php');

                    $query = "SELECT SpeciesID, speciesName, CoordinateX, CoordinateY, Diameter, Cut_Angle FROM newforest WHERE (SpeciesID IN (1, 2, 3, 5)) AND (Diameter >= 45)";
                    $result = mysqli_query($dbc, $query);

                    if ($result) {
                        echo "<table border='1' class='table'>
                                <tr>
                                    <th>SpeciesID</th>
                                    <th>Species Name</th>
                                    <th>CoordinateX</th>
                                    <th>CoordinateY</th>
                                    <th>Diameter</th>
                                    <th>Felling Direction (Cut Angle)</th>
                                </tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$row['SpeciesID']}</td>
                                    <td>{$row['speciesName']}</td>
                                    <td>{$row['CoordinateX']}</td>
                                    <td>{$row['CoordinateY']}</td>
                                    <td>{$row['Diameter']}</td>
                                    <td>{$row['Cut_Angle']}</td>
                                  </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>Error: " . mysqli_error($dbc) . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>
