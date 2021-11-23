<?php

require 'connection.php';

// handling nodig bij het opvragen van ALLE gegevens, dit kan alleen na inlog
// onderstaande $_GET is uitsluitend voor gebruik van de stap terug knop

if ($_GET) {
    $klantId = $_GET['id'];

    $data = $pdo->query("SELECT * FROM intake WHERE id=$klantId");
}

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

            <!-- TODO: gegevensvalidatie van de ingevoerde velden! -->

            <form action="intake-step2.php" method="post">
                <div class="container">
                    <table>
                        <input type="hidden" name="id" value=<?= isset($data['id']) ? $data['id'] : '' ?>>
                        <tr>
                            <th>Klant</th>
                            <td>
                                <select name="klType" id="klType">
                                    <option value="">maak een keuze</option>
                                    <option value="particulier" <?= (isset($data['kl_type']) && $data['kl_type'] == 'particulier') ? 'selected="selected"' : '' ?>>particulier</option>
                                    <option value="zakelijk" <?= (isset($data['kl_type']) && $data['kl_type'] == 'zakelijk') ? 'selected="selected"' : '' ?>>zakelijk</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Klantnaam</th>
                            <td><input type="text" name="klNaam" id="klNaam" value=<?= isset($data['kl_naam']) ? $data['kl_naam'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <h2 class="th-kop">Contact gegevens</h2>
                            </th>
                        </tr>
                        <tr>
                            <th>Contactpersoon</th>
                            <td><input type="text" name="klContactNaam" id="klContactNaam" value=<?= isset($data['kl_contact_naam']) ? $data['kl_contact_naam'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th>Contact telefoon</th>
                            <td><input type="tel" name="klContactTel" id="klContactTel" value=<?= isset($data['kl_contact_tel']) ? $data['kl_contact_tel'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th>Contact mailadres</th>
                            <td><input type="email" name="klContactMail" id="klContactMail" value=<?= isset($data['kl_contact_mail']) ? $data['kl_contact_mail'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <h2 class="th-kop">Risico adres</h2>
                            </th>
                        </tr>
                        <tr>
                            <th>Risico adres</th>
                            <td><input type="text" name="locAdres" id="locAdres" value=<?= isset($data['loc_adres']) ? $data['loc_adres'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td><input type="text" name="locPostcode" id="locPostcode" value=<?= isset($data['loc_postcode']) ? $data['loc_postcode'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th>Plaats</th>
                            <td><input type="text" name="locPlaats" id="locPlaats" value=<?= isset($data['loc_plaats']) ? $data['loc_plaats'] : '' ?>></td>
                        </tr>
                        <th colspan="2">
                            <h2 class="th-kop">Contact adres</h2>
                        </th>
                        <tr>
                            <th>contactadres</th>
                            <td><input type="text" name="klAdres" id="klAdres" value=<?= isset($data['kl_adres']) ? $data['kl_adres'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th>contact postcode</th>
                            <td><input type="text" name="klPostcode" id="klPostcode" value=<?= isset($data['kl_postcode']) ? $data['kl_postcode'] : '' ?>></td>
                        </tr>
                        <tr>
                            <th>Plaats</th>
                            <td><input type="text" name="klPlaats" id="klPlaats" value=<?= isset($data['kl_plaats']) ? $data['kl_plaats'] : '' ?>></td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" value="volgende stap" class="form-button">
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