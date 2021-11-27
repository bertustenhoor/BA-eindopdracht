<?php

session_start();

//only available after login
if (!isset($_SESSION['user'])) {

    //come back after login
    $_SESSION['return_page'] = 'onderhoud.php';

    //go to login page
    header('location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Onderhoud</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="./index.php">home</a></li>
            <li><a href="./intake.php">intake document</a></li>
            <li class="active"><a href="./onderhoud.php">onderhoud</a></li>
            <li style="float: right;"><a href="./login.php"><?= (isset($_SESSION['user'])) ? 'logout' : 'login' ?></a></li>
        </ul>
    </nav>
    <main>
        <div class="main-container">
            <h1>Onderhoud</h1>
            <p>Uitleg van de pagina: Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita asperiores quibusdam laborum voluptate perferendis, molestias eveniet vero quidem corrupti veritatis quo labore dignissimos ab veniam cum. Reiciendis deserunt cum ipsam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo harum molestiae minus eos pariatur fugiat quae et perspiciatis, perferendis animi quos aspernatur at maxime voluptatem voluptate totam itaque possimus a?</p>
            
        </div>
    </main>
    <footer>
        <p class="p-center">Copyright BtH - 2021</p>
        <img src="./img/logoRSEB.png" alt="logo RSE beveiliging" class="logo-footer">
    </footer>
</body>

</html>