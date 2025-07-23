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
            background:url(assets/img/Background.jpg) center/cover;
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
            margin:10px 05px;
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
            display: flex; /* Add flex display */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            flex-direction: row; /* Arrange items in a row */
        }
        .left-section {
            text-align: left;
            margin-right: auto; /* Push to left */
        }
        .right-section {
            text-align: center;
            max-width: 50%; /* Adjust maximum width */
        }
        h1 {
            font-family: sans-serif;
            margin: 0;
            color: #00BF63;
            font-size: 90px;
            display: inline-block;
            margin-left:40px;
        }
        h2 {
            color: #0097B2;
            font-family: sans-serif;
            margin: 0;
            font-size: 90px;
            margin-left:40px;

        }
        .desc {
            font-family: sans-serif;
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
            max-width: 90%; /* Adjust maximum width */
            text-align: justify;
            line-height: 1.5;
        }
        .generate-button {
            background-color: white;
            color: black;
            border: 1px solid #0097B2;
            padding: 10px 20px;
            font-size: 20px;
            font-weight:bold;
            border-radius: 10px;
            border-width:2px;
            cursor: pointer;  
                 
        }
        .generate-button:hover {
            background-color: #0097B2;
            color: white;

        }

        /* New CSS for the message */
        .success-message {
            font-family: sans-serif;
            font-size: 20px;
            color: #00BF63; /* Green color */
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
</main>

<?php 
// Database connection
require ('mysqli_connect.php');
if(isset($_POST['numGen'])) {

    if (!empty($_POST['numGen'])) {
        $numGen = $_POST['numGen'];
    }
}
// Function to generate random data and insert into the database
function generateAndInsertRandomData() {
    global $dbc;
    
    for ($i = 0; $i < $inputGen; $i++) {

        // Generate random data
        $species_option = array("PHDEAK", "CHHOETEAL BANGKOUNEANGO", "CHHOETEAL BRENG","CHHOETEAL CHHNGAR","CHORCHONG","CHRASMAS","KOKI MOSAU","KCHOV/KAMLENG","KOKI DEK","KOKI KHASAC","ANGKOT KHMAU","ATITH/NEANG PHOR EK","BENG","ANGKANH","ANGKAT TMAAT","ANGKRANG PHNOM");
        $species_status_index = array_rand($species_option);
        $speciesName = $species_option[$species_status_index];


        // Initialize SpeciesID and SpeciesGroup variables
        $SpeciesID = 0;
        $SpeciesGroup = "";

        


        // Assign SpeciesID and SpeciesGroup based on $speciesName
        if($speciesName == "PHDEAK"){
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
        $Diameter = rand(500.0, 5000.0)/100 ;
        $NumberOfLogs = rand(1, 5);
        $StemHeight = rand(45.0, 203.0);
        $CoordinateX = rand(10000.0, 12000.0)/100;
        $CoordinateY = rand(300.0, 500.0)/100;
        $status_options = array("Keep", "Cut", "Victim");
        $random_status_index = array_rand($status_options);
        $random_status = $status_options[$random_status_index];
        $TreeNum = rand(1, 100); // Random tree number
        // Calculate volume
        /*$Volume = 3.142 * ($Diameter / 200) * 2 * $StemHeight * 0.50;
        $DiameterClass = 'Class ' . rand(1, 5); // Random diameter class

        //Intialize PROD, CutAngle, DamageStem, DamageCrown
        $Prod = $Volume;
        $DamageStem = 0;
        $DamageCrown = 0;
        
        // Calculate cut angle
        $a_radians = asin($CoordinateX/($StemHeight+5));
        $CutAngle = rad2deg($a_radians);*/

        // Insert into the database
        $query = "INSERT INTO newforest (SpeciesID, speciesName, BlockX, BlockY, Diameter, NumberOfLogs, StemHeight, CoordinateX, CoordinateY, Status, TreeNum, Volume, DiameterClass,PROD, Cut_Angle, Damage_STEM, Damage_Crown) VALUES ('$SpeciesID','$speciesName', '$BlockX', '$BlockY', '$Diameter', '$NumberOfLogs', '$StemHeight', '$CoordinateX', '$CoordinateY', '$random_status', '$TreeNum', '$Volume', '$DiameterClass','$Prod','$CutAngle','$DamageStem','$DamageCrown')";
        mysqli_query($dbc, $query);

        $query2 = "INSERT INTO species (SpeciesID,speciesName,SpeciesGroup) VALUES ('$SpeciesID','$speciesName','$SpeciesGroup')";
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
        'Status' => $random_status,
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

// Generate data when the form is submitted
if(isset($_POST['generate_data'])) {
    $random_data = generateAndInsertRandomData();
}

?>

</body>
</html>
