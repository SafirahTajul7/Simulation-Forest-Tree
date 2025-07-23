<?php
require('mysqli_connect.php');

// Calculate the total number of records
$total_records_sql = "SELECT COUNT(*) as total_records FROM newforest nf JOIN species sp ON nf.SpeciesID = sp.SpeciesID";
$total_records_result = mysqli_query($dbc, $total_records_sql);
$total_records_row = mysqli_fetch_assoc($total_records_result);
$total_records = $total_records_row['total_records'];

// Calculate the number of pages
$records_per_page = 10; // You can adjust this value to display more or fewer records per page
$total_pages = ceil($total_records / $records_per_page);

// Get the current page number
if (isset($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

// Calculate the offset for the LIMIT clause
$offset = ($current_page - 1) * $records_per_page;

// Fetch the records for the current page
$q = "SELECT DISTINCT nf.*, sp.SpeciesGroup 
      FROM newforest nf 
      JOIN species sp ON nf.SpeciesID = sp.SpeciesID 
      ORDER BY nf.BlockX ASC 
      LIMIT $records_per_page OFFSET $offset";
$r = mysqli_query($dbc, $q);
?>


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
    <header id="header" class="fixed-top ">
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
                            <li><a class="nav-link scrollto" href='tree_distribution.php'>Tree Distibution</a></li>
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
                    <h1>Forest Tree - Experience Nature's Symphony</h1>
                    <a href="#about" class="glightbox play-btn mb-4"></a>
                </div>
            </div>
        </div>
    </section>

    <main id="main">
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Stand Table 2</h2>
                    <p>Table showing data tree with damaged crown, damaged tree.</p>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Species Group </th>
                                    <th>Volume</th>
                                    <th>Number</th>
                                    <th>Production </th>
                                    <th>Diameter </th>
                                    <th>Coordinate X </th>
                                    <th>Coordinate Y </th>
                                    <th>Status</th>
                                    <th>Damage Stem</th>
                                    <th>Damage Crown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($r)) {
                                    echo "<tr>
                                            <td>{$row['SpeciesGroup']}</td>
                                            <td>{$row['Volume']}</td>
                                            <td>{$row['TreeNum']}</td>
                                            <td>{$row['PROD']}</td>
                                            <td>{$row['Diameter']}</td>
                                            <td>{$row['CoordinateX']}</td>
                                            <td>{$row['CoordinateY']}</td>
                                            <td>{$row['Status']}</td>
                                            <td>{$row['Damage_STEM']}</td>
                                            <td>{$row['Damage_Crown']}</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Pagination navigation -->
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php
                                // Determine the number of pages to show in the pagination
                                $pages_to_show = 5;

                                // Calculate the start and end page numbers based on the current page
                                $start_page = max(1, $current_page - floor($pages_to_show / 2));
                                $end_page = min($total_pages, $start_page + $pages_to_show - 1);

                                // Only show the page numbers within the start and end range
                                if ($start_page > 1) {
                                    echo '<li class="page-item"><a href="' . $_SERVER['PHP_SELF'] . '?page=1" class="page-link">&laquo;</a></li>';
                                    echo '<li class="page-item"><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($current_page - 1) . '" class="page-link">&lt;</a></li>';
                                }

                                for ($i = $start_page; $i <= $end_page; $i++) {
                                    echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '" class="page-link">' . $i . '</a></li>';
                                }

                                if ($end_page < $total_pages) {
                                    echo '<li class="page-item"><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($current_page + 1) . '" class="page-link">&gt;</a></li>';
                                    echo '<li class="page-item"><a href="' . $_SERVER['PHP_SELF'] . '?page=' . $total_pages . '" class="page-link">&raquo;</a></li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

</body>

</html>
