<?php

require 'connection.php';

//prime task: resultaat van de risicoklasse bepaling weergeven,
//eerst de waardes ontvangen van de vorige stap...

if ($_POST) {

    $sql = "UPDATE intake SET kl_proj_nummer=:klProjNummer, ant_kun_muz_verz=:antKunMuzVerz, aud_vid_comp=:audVidComp, sier_cont_wpap=:sierContWpap WHERE id=:id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':antKunMuzVerz', (int)$_POST['antKunMuzVerz'], PDO::PARAM_INT);
    $stmt->bindValue(':audVidComp', (int)$_POST['audVidComp'], PDO::PARAM_INT);
    $stmt->bindValue(':sierContWpap', (int)$_POST['sierContWpap'], PDO::PARAM_INT);
    $stmt->bindValue(':klProjNummer', $_POST['klProjNummer']);
    $stmt->bindValue(':id', $_POST['id']);

    $stmt->execute();
} else {
    //only available after intake-step2.php
    die('illegal access!');
}

$data = $pdo->query("SELECT * FROM intake ORDER BY id DESC LIMIT 1")->fetch();

$totaalWaardeAttrGoederen = $data['ant_kun_muz_verz'] + $data['aud_vid_comp'] + $data['sier_cont_wpap'];
$risicoKlasse = 0;

switch ($totaalWaardeAttrGoederen) {
    case in_array($totaalWaardeAttrGoederen, range(0, 50_000)):
        $risicoKlasse = 1;
        break;
    case in_array($totaalWaardeAttrGoederen, range(50_001, 100_000)):
        $risicoKlasse = 2;
        break;
    case in_array($totaalWaardeAttrGoederen, range(100_001, 150_000)):
        $risicoKlasse = 3;
        break;
    default:
        $risicoKlasse = 4;
        break;
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Intake</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="./index.php">home</a></li>
            <li class="active"><a href="./intake.php">intake document</a></li>
            <li><a href="./onderhoud.php">onderhoud</a></li>
            <li style="float: right;"><a href="./login.php"><?= (isset($_SESSION['user'])) ? 'logout' : 'login' ?></a></li>
        </ul>
    </nav>
    <main>
        <div class="main-container">
            <h1>Intake document</h1>
            <p>Uitleg van de pagina: Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita asperiores quibusdam laborum voluptate perferendis, molestias eveniet vero quidem corrupti veritatis quo labore dignissimos ab veniam cum. Reiciendis deserunt cum ipsam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo harum molestiae minus eos pariatur fugiat quae et perspiciatis, perferendis animi quos aspernatur at maxime voluptatem voluptate totam itaque possimus a?</p>
            <h1>Klant gegevens - overzicht</h1>
            <div class="container">
                <table class="result">
                    <tr>
                        <th>Project nummer: </th>
                        <td><?= $data['kl_proj_nummer'] ?></td>
                    </tr>
                    <tr>
                        <th>Naam klant: </th>
                        <td><?= $data['kl_naam'] ?></td>
                    </tr>
                    <tr>
                        <th>Risico adres: </th>
                        <td><?= $data['loc_adres'] ?><br>
                            <?= $data['loc_postcode'] ?>
                            <?= $data['loc_plaats'] ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="extra-head">Attractieve goederen</th>
                    </tr>
                    <tr>
                        <th>Audiovisuele en computerapparatuur: </th>
                        <td><?= $data['aud_vid_comp'] ?></td>
                    </tr>
                    <tr>
                        <th>Sieraden, contanten en waardepapieren: </th>
                        <td><?= $data['sier_cont_wpap'] ?></td>
                    </tr>
                    <tr>
                        <th>Antiek, kunst, muziekinstrumenten en verzamelingen: </th>
                        <td><?= $data['ant_kun_muz_verz'] ?></td>
                    </tr>
                    <tr>
                        <th>totaal: </th>
                        <td><?= $totaalWaardeAttrGoederen ?></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="extra-head">Risicoklasse</th>
                    </tr>
                    <tr>
                        <th>Vastgestelde risicoklasse: </th>
                        <td><strong>?= $risicoKlasse ?></strong></td>
                    </tr>
                </table>
            </div>

    </main>
    <footer>
        <p class="p-center">Copyright BtH - 2021</p>
        <img src="./img/logoRSEB.png" alt="logo RSE beveiliging" class="logo-footer">
    </footer>
</body>

</html>