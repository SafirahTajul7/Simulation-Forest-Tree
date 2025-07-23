<?php
// Database connection
require ('mysqli_connect.php');

// Query to get species group and count of trees within diameter ranges
$q = "SELECT nf.*, sp.SpeciesGroup ,
    SUM(CASE WHEN Diameter >= 5 AND Diameter < 15 THEN 1 ELSE 0 END) AS `5-15(diameter)`,
    SUM(CASE WHEN Diameter >= 15 AND Diameter < 30 THEN 1 ELSE 0 END) AS `15-30(diameter)`,
    SUM(CASE WHEN Diameter >= 30 AND Diameter < 45 THEN 1 ELSE 0 END) AS `30-45(diameter)`,
    SUM(CASE WHEN Diameter >= 45 AND Diameter < 60 THEN 1 ELSE 0 END) AS `45-60(diameter)`,
    SUM(CASE WHEN Diameter >= 60 THEN 1 ELSE 0 END) AS `60+(diameter)`,
    COUNT(*) AS Total
    FROM newforest nf 
    JOIN species sp ON nf.SpeciesID = sp.SpeciesID
    GROUP BY sp.SpeciesGroup";

$r= mysqli_query($dbc, $q);

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
					<li class="dropdown"><a href='standtable2.php'>Assignment 2<i class="bi bi-chevron-down"></i></a><ul>
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
					<h2>Stand 1 Table</h2>
					<p>Table showing data of trees in stand 1.</p>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Species Group </th>
                                <th>Name</th>
                                <th>5-15(dbh cm)</th>
                                <th>15-30(dbh cm)</th>
                                <th>30-45(dbh cm)</th>
                                <th>45-60(dbh cm)</th>
                                <th>60+ (dbh cm)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                    <tr>
                        <?php 
                        while ($row = mysqli_fetch_assoc($r)) {
                            echo "<tr>
                                <td>{$row['SpeciesGroup']}</td>
                                <td></td> <!-- Insert name here if you have it in the database -->
                                <td>{$row['5-15(diameter)']}</td>
                                <td>{$row['15-30(diameter)']}</td>
                                <td>{$row['30-45(diameter)']}</td>
                                <td>{$row['45-60(diameter)']}</td>
                                <td>{$row['60+(diameter)']}</td>
                                <td>{$row['Total']}</td>
                            </tr>";
                        }

                    
                    ?>
				        </tbody>
						</table>

                       
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

</body>
</html>
