<?php
require('mysqli_connect.php');

// Limit the number of records fetched
$limit = 1000;
$q = "SELECT nf.CoordinateX, nf.CoordinateY, sp.SpeciesGroup 
      FROM newforest nf 
      JOIN species sp ON nf.SpeciesID = sp.SpeciesID
      LIMIT $limit";
$r = mysqli_query($dbc, $q);

$tree_data = [];
while ($row = mysqli_fetch_assoc($r)) {
    $tree_data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Tree Distribution</title>
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
    
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        #plot {
            width: 80%;
            height: 600px;
            margin: auto;
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
                <h2>Tree Distribution</h2>
                <p>Visual representation of tree distribution within the forest.</p>
            </div>

            <div id="plot"></div>

            <script>
                // Get tree data from PHP
                const treeData = <?php echo json_encode($tree_data); ?>;

                // Extract coordinates and labels
                const x = treeData.map(tree => tree.CoordinateX);
                const y = treeData.map(tree => tree.CoordinateY);
                const species = treeData.map(tree => tree.SpeciesGroup);

                // Create a trace for Plotly
                const trace = {
                    x: x,
                    y: y,
                    mode: 'markers',
                    type: 'scatter',
                    text: species,
                    marker: { size: 8 }
                };

                const layout = {
                    title: 'Tree Distribution',
                    xaxis: { title: 'Coordinate X', range: [0, 150] },
                    yaxis: { title: 'Coordinate Y', range: [0, 150] },
                    shapes: [
                        {
                            type: 'line',
                            x0: 100,
                            y0: 0,
                            x1: 100,
                            y1: 200,
                            line: { color: 'blue', width: 2 }
                        },
                        {
                            type: 'line',
                            x0: 0,
                            y0: 100,
                            x1: 200,
                            y1: 100,
                            line: { color: 'blue', width: 2 }
                        }
                    ]
                };

                // Render the plot
                Plotly.newPlot('plot', [trace], layout);
            </script>
        </div>
    </section>
</main>
</body>
</html>
