<?php
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, yellow, orange, pink);
            text-align: center; /* Center text */
            padding-top: 20px; /* Add some space at the top */
        }
        h1{
            text-align: center;
            margin-top: 50px!important;
            margin-bottom: 50px!important;
            font-family: 'WonkaFonts', sans-serif;
            letter-spacing: 10px;
        }
        @font-face {
        font-family: 'WonkaFonts';
        src: url('fonts/WillyWonka.ttf') format('truetype');
        }
        h5{
            color: blue;
            margin-left: 90px;
            font-size: 25px!important;
        }
        h4{
            color: blue;
            margin-left: 230px;
            margin-top:40px !important;
        }

        .wonkas {
          
            text-align: center;
            padding-top: 20px;
            margin-bottom: 20px; /* Space below the Wonka section */
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .wonkas img {
            width: 20%; /* Adjust the image size as needed */
            height: auto;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .second-row img{
            width: 160px;
            height: 180px;
            margin-top: 40px;
            border-radius:10px;
        }
        .second-row{
            display: flex;
            justify-content: space-around;
            flex-direction: row;
            text-align: center;
        }
        .team-photo{
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
            margin-bottom: 30px;
        }
        .team-photo img{
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1> OUR TEAM </h1>
    <div class="wonkas">
        <img src="assets/images/wonka$.jpg" alt="Mr Wonka">
        <p>Founder</p>
        <p>Mr Wonka</p>
    </div>    
    <h5>Oompa Loompas Team Members:</h5>
    <div class="second-row">
        <div class = "child">
            <img src="assets/images/Menager.jpg" alt="Picture of worker" class="img-fluid">
            <p>Menager</p>
        </div>
        <div class = "child">
            <img src="assets/images/worker2.jpg" alt="Picture of worker" class="img-fluid">
            <p>Team chef</p>
        </div>  
        <div class = "child">  
            <img src="assets/images/worker.png" alt="Picture of worker" class="img-fluid">
            <p>Team leader<br> assistent</p>
        </div>
        <div class = "child">
            <img src="assets/images/worker4.png" alt="Picture of worker" class="img-fluid">
            <p>Secretary</p>
        </div>
        
    </div>
    <h4>Our Chocolate Productions Team:</h4>
        <div class = "team-photo">
            <img src="assets/images/team2.png" alt="Picture of workers" class="img-fluid">
        </div>
    <h4>Our Nut Processing Team:</h4>
    <div class = "team-photo">
        <img src="assets/images/squirellteam.png" alt="Picture of workers" class="img-fluid">
    </div>    
</body>
</html>
<?php
include 'includes/footer.php';
?>
