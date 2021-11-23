<?php

require 'connection.php';

if ($_POST) {

    $sql = "INSERT INTO intake (kl_type, kl_naam, kl_contact_naam, kl_contact_tel, kl_contact_mail, loc_adres, loc_postcode, loc_plaats, kl_adres, kl_postcode, kl_plaats) VALUES (:klType, :klNaam, :klContactNaam, :klContactTel, :klContactMail, :locAdres, :locPostcode, :locPlaats, :klAdres, :klPostcode, :klPlaats)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':klType', $_POST['klType']);
    $stmt->bindValue(':klNaam', $_POST['klNaam']);
    $stmt->bindValue(':klContactNaam', $_POST['klContactNaam']);
    $stmt->bindValue(':klContactTel', $_POST['klContactTel']);
    $stmt->bindValue(':klContactMail', $_POST['klContactMail']);
    $stmt->bindValue(':locAdres', $_POST['locAdres']);
    $stmt->bindValue(':locPostcode', $_POST['locPostcode']);
    $stmt->bindValue(':locPlaats', $_POST['locPlaats']);
    $stmt->bindValue(':klAdres', $_POST['klAdres']);
    $stmt->bindValue(':klPostcode', $_POST['klPostcode']);
    $stmt->bindValue(':klPlaats', $_POST['klPlaats']);

    $stmt->execute();
}

$data = $pdo->query("SELECT * FROM intake ORDER BY id DESC LIMIT 1")->fetch();

$projectNummer = '2021' . str_pad($data['id'], 4, '0', STR_PAD_LEFT);

?>

<!DOCTYPE html>
<html lang="en">

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
            <li style="float: right;"><a href="./login.php">login</a></li>
        </ul>
    </nav>
    <main>
        <div class="main-container">
            <h1>Intake document</h1>
            <p>Uitleg van de pagina: Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita asperiores quibusdam laborum voluptate perferendis, molestias eveniet vero quidem corrupti veritatis quo labore dignissimos ab veniam cum. Reiciendis deserunt cum ipsam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo harum molestiae minus eos pariatur fugiat quae et perspiciatis, perferendis animi quos aspernatur at maxime voluptatem voluptate totam itaque possimus a?</p>
            <h1>Klant gegevens</h1>

            <form action="intake-result.php" method="post">
                <input type="hidden" name="klProjNummer" value=<?= $projectNummer ?>>
                <input type="hidden" name="id" value=<?= $data['id'] ?>>

                <table id="particulier">
                    <th colspan="2">
                        <h2><?= $data['kl_naam'] ?> - <?= $projectNummer ?></h2>
                    </th>
                    <?php

                    if ($data['kl_type'] == 'particulier') : ?>
                        <tr>
                            <th>Omschrijving</th>
                            <th>waarde in eu</th>
                        </tr>
                        <tr>
                            <th class="lange-kop">Audiovisuele en/of computerapparatuur</th>
                            <td><input type="number" name="audVidComp" id="audVidComp" min="0"></td>
                        </tr>
                        <tr>
                            <th class="lange-kop">Sieraden, contanten en waardepapieren</th>
                            <td><input type="number" name="sierContWpap" id="sierContWpap" min="0"></td>
                        </tr>
                        <tr>
                            <th class="lange-kop">Antiek, kunst, muziekinstrumenten en verzamelingen</th>
                            <td><input type="number" name="antKunMuzVerz" id="antKunMuzVerz" min="0"></td>
                        </tr>
                    <?php endif ?>
                </table>
                <div>
                    <!-- <input type="submit" name="submit" value="Vorige stap" class="form-button"> // TODO: implement!!! -->
                    <input type="submit" name="submit" value="Volgende stap" class="form-button">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p class="p-center">Copyright BtH - 2021</p>
        <img src="./img/logoRSEB.png" alt="logo RSE beveiliging" class="logo-footer" height="50">
    </footer>
</body>

</html>