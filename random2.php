<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Random Data</title>
    <link rel="icon" type="image/x-icon" href="icon.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: url(assets/img/Background.jpg) center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }
        nav.navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000; 
            font-family: montserrat;
            margin: 10px 5px;
        }

        .company-name {
            font-size: 30px;
            font-family: times new roman;
            color: white;
            text-decoration: none;
            font-weight: bold;
            background-color: #141a14;
            padding: 10px 20px;
        }
        .navbar-left a {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
        }
        .navbar-right a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            margin-left: 20px;
        }
        .navbar-right a:hover {
            color: #ccc;
        }
        main.table {
            margin-top: 70px;
            width: 82vw;
            height: 90vh;
            background-color: #fff5;
            backdrop-filter: blur(7px);
            box-shadow: 0 .4rem .8rem #000500;
            border-radius: .8rem;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
        }
        .left-section {
            text-align: left;
            margin-right: auto;
        }
        .right-section {
            text-align: center;
            max-width: 50%;
        }
        h1 {
            font-family: sans-serif;
            margin: 0;
            color: #00BF63;
            font-size: 90px;
            display: inline-block;
            margin-left: 40px;
        }
        h2 {
            color: #0097B2;
            font-family: sans-serif;
            margin: 0;
            font-size: 90px;
            margin-left: 40px;
        }
        .desc {
            font-family: sans-serif;
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
            max-width: 90%;
            text-align: justify;
            line-height: 1.5;
        }
        .generate-button {
            background-color: white;
            color: black;
            border: 1px solid #0097B2;
            padding: 10px 20px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            border-width: 2px;
            cursor: pointer;  
        }
        .generate-button:hover {
            background-color: #0097B2;
            color: white;
        }
        .success-message {
            font-family: sans-serif;
            font-size: 20px;
            color: #00BF63;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-left">
        <a href="index.php" class="company-name">New Forest</a>
    </div>
    <div class="navbar-right">
        <a href="index.php" class="nav-item">Home</a>
        <a href='forest.php' class="nav-item">Data</a>
    </div>
</nav>
<main class="table">
    <section class="left-section">
        <h1>SAVE</h1>
        <h2>FOREST</h2>
    </section>
    <section class="right-section">
        <p class="desc">Welcome to our Forest Data Explorer! Dive into the fascinating world of forestry with our interactive platform. Explore various tree species, their characteristics, and distribution. Learn about tree diameters, heights, and more through our extensive database.</p>
        <form action="" method="post">
            <input type="number" name="numGen" min="1" class='generate-button'>
            <input class='generate-button' type="submit" name="generate_data" value="Generate Data">
        </form>

        <!-- Display message after generating and inserting random data -->
        <?php if(isset($_POST['generate_data'])): ?>
            <p class="success-message">Random data generated and inserted successfully!</p>
        <?php endif; ?>

        <?php
        // Function to calculate distance between two points
        function calculateDistance($x1, $y1, $x2, $y2) {
            return sqrt(pow(($x1 - $x2), 2) + pow(($y1 - $y2), 2));
        }

        // Function to check if crown is damaged
        function isCrownDamaged($crownCenterX, $crownCenterY, $treeX, $treeY, $criticalRadius) {
            $distance = calculateDistance($crownCenterX, $crownCenterY, $treeX, $treeY);
            return $distance <= $criticalRadius;
        }

        // Function to check if stem is damaged
        function isStemDamaged($crownCenterX, $crownCenterY, $pointX, $pointY, $criticalRange) {
            $distance = calculateDistance($crownCenterX, $crownCenterY, $pointX, $pointY);
            return $distance <= $criticalRange;
        }

        function generateAndInsertRandomData($numGen, $dbc) {
            // Generate random data and insert into the database
            // Initialize $treesToDamage array
    $treesToDamage = array(
        array(15, 20),
        array(15, 14.9),
        array(15, 10.4),
        array(15, 6.8)
    );
            for ($i = 0; $i < $numGen; $i++) {
                // Generate random data
            $species_option = array("PHDEAK", "CHHOETEAL BANGKOUNEANGO", "CHHOETEAL BRENG", "CHHOETEAL CHHNGAR", "CHORCHONG", "CHRASMAS", "KOKI MOSAU", "KCHOV/KAMLENG", "KOKI DEK", "KOKI KHASAC", "ANGKOT KHMAU", "ATITH/NEANG PHOR EK", "BENG", "ANGKANH", "ANGKAT TMAAT", "ANGKRANG PHNOM");
            $species_status_index = array_rand($species_option);
            $speciesName = $species_option[$species_status_index];

            // Initialize SpeciesID and SpeciesGroup variables
            $SpeciesID = 0;
            $SpeciesGroup = "";

            // Assign SpeciesID and SpeciesGroup based on $speciesName
            if ($speciesName == "PHDEAK") {
                $SpeciesID = 1;
                $SpeciesGroup = "Mersawa";
            } elseif (in_array($speciesName, array("CHHOETEAL BANGKOUNEANGO", "CHHOETEAL BRENG", "CHHOETEAL CHHNGAR"))) {
                $SpeciesID = 2;
                $SpeciesGroup = "Keruing";    
            } elseif (in_array($speciesName, array("CHORCHONG", "CHRASMAS", "KOKI MOSAU"))) {
                $SpeciesID = 3;
                $SpeciesGroup = "Dip Commercial";    
            } elseif (in_array($speciesName, array("KCHOV/KAMLENG", "KOKI DEK", "KOKI KHASAC"))) {
                $SpeciesID = 4;
                $SpeciesGroup = "Dip NonCommercial";    
            } elseif (in_array($speciesName, array("ANGKOT KHMAU", "ATITH/NEANG PHOR EK", "BENG"))) {
                $SpeciesID = 5;
                $SpeciesGroup = "NonDip Commercial";    
            } else {
                $SpeciesID = 6;
                $SpeciesGroup = "NonDip NonCommercial";
            }

        // Generate other random data
        $BlockX = ceil($SpeciesID / 5); // Calculate BlockX
        $BlockY = ($SpeciesID % 5 == 0) ? 5 : ($SpeciesID % 5); // Calculate BlockY
        $Diameter = rand(450, 5000) / 100; // Diameter in cm
        $NumberOfLogs = rand(1, 5);
        $StemHeight = rand(45, 203); // Height in meters
        $CoordinateX = rand(10000, 12000) / 100; // CoordinateX
        $CoordinateY = rand(300, 500) / 100; // CoordinateY
        $status_options = array("Keep", "Cut", "Victim");
        $random_status_index = array_rand($status_options);
        $random_status = $status_options[$random_status_index];
        $TreeNum = rand(1, 100); // Random tree number

        // Calculate volume
        $Volume = 3.142 * pow(($Diameter / 200), 2) * $StemHeight * 0.50;
        $DiameterClass = 'Class ' . rand(1, 5); // Random diameter class

        // Calculate damage to stem and crown
        $DamageStem = 'None'; // Default value
        $DamageCrown = 'None'; // Default value

        // Calculate damage to stem (using provided formulas)
$x = $CoordinateX; // Assuming you have $CoordinateX defined
$y1 = $x / tan(56/180*3.142 + 1); // Assuming you have the tan calculation
$y2 = $x / tan(56/180*3.142 - 1); // Assuming you have the tan calculation

// Check if the tree is in the damage range
if ($CoordinateY > $y1 && $CoordinateY < $y2) {
    $DamageStem = 'Fatal'; // Tree is damaged
}

// Calculate damage to crown (using provided formulas)
$StemHeight = $StemHeight + 5; // Assuming you have $StemHeight defined
$x = $StemHeight * sin(65/180*3.142); // Assuming you have the sin calculation
$y = $StemHeight * cos(65/180*3.142); // Assuming you have the cos calculation
$X1 = $CoordinateX + $x; // Assuming you have $CoordinateX defined
$Y1 = $CoordinateY - $y; // Assuming you have $CoordinateY defined

// Calculate damage to stem based on conditions
if ($CoordinateY > $y1 && $CoordinateY < $y2) {
    $DamageStem = 'Fatal'; // Tree is damaged
}


// Calculate damage to crown based on conditions
foreach ($treesToDamage as $tree) {
    $distance = sqrt(pow(($X1 - $tree[0]), 2) + pow(($Y1 - $tree[1]), 2));
    if ($distance <= 5) {
        $DamageCrown = '50%'; // Tree is damaged
        break;
    }
}

// Check if SpeciesID is in the specified IDs and Diameter is above 45
if (in_array($SpeciesID, array(1, 2, 3, 5)) && $Diameter > 45) {
    // Set damage status for stem and crown
    $DamageStem = 'Fatal'; // Example value for demonstration
    $DamageCrown = '50%'; // Example value for demonstration
}

// Handle cutting or keeping the tree based on diameter and species group
if ($Diameter >= 45 && in_array($SpeciesID, array(1, 2, 3, 5))) {
    $Status = 'Cut'; // Cut the tree
    $DamageStem = '35'; // Example value for demonstration
    $DamageCrown = '50%'; // Example value for demonstration
} else {
    $Status = 'Keep'; // Keep the tree
}

        

        // Initialize PROD
        $Prod = $Volume;

        // Calculate cut angle
        $a_radians = asin($CoordinateX / ($StemHeight + 5));
        $CutAngle = rad2deg($a_radians);


        // Insert into the database
        $query = "INSERT INTO newforest (SpeciesID, speciesName, BlockX, BlockY, Diameter, NumberOfLogs, StemHeight, CoordinateX, CoordinateY, Status, TreeNum, Volume, DiameterClass, PROD, Cut_Angle, Damage_STEM, Damage_Crown) VALUES ('$SpeciesID', '$speciesName', '$BlockX', '$BlockY', '$Diameter', '$NumberOfLogs', '$StemHeight', '$CoordinateX', '$CoordinateY', '$Status', '$TreeNum', '$Volume', '$DiameterClass', '$Prod', '$CutAngle', '$DamageStem', '$DamageCrown')";
        mysqli_query($dbc, $query);

        $query2 = "INSERT INTO species (SpeciesID, speciesName, SpeciesGroup) VALUES ('$SpeciesID', '$speciesName', '$SpeciesGroup')";
        mysqli_query($dbc, $query2);
    }

    

    // Return generated data
    return array(
        'SpeciesID' => $SpeciesID,
        'BlockX' => $BlockX,
        'BlockY' => $BlockY,
        'Diameter' => $Diameter,
        'NumberOfLogs' => $NumberOfLogs,
        'StemHeight' => $StemHeight,
        'CoordinateX' => $CoordinateX,
        'CoordinateY' => $CoordinateY,
        'Status' => $Status,
        'TreeNum' => $TreeNum,
        'Volume' => $Volume,
        'DiameterClass' => $DiameterClass,
        'speciesName' => $speciesName,
        'SpeciesGroup' => $SpeciesGroup,
        'PROD' => $Prod,
        'Cut_Angle' => $CutAngle,
        'Damage_STEM' => $DamageStem,
        'Damage_Crown' => $DamageCrown,
    );
}

        // Database connection
        require('mysqli_connect.php');

        // Generate data when the form is submitted
        if (isset($_POST['generate_data'])) {
            $numGen = intval($_POST['numGen']); // Convert numGen to an integer
            $random_data = generateAndInsertRandomData($numGen, $dbc);
        }
        ?>
    </section>
</main>
</body>
</html>