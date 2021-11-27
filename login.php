<?php

require 'connection.php';

session_start();

if ($_POST) {
    //logout
    if (isset($_SESSION['user'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    //login
    $req_user = $_POST['user'];
    $req_password = $_POST['password'];

    $sql = "SELECT count(*) FROM users WHERE user=:user AND `password`=:password";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(['user' => $req_user, 'password' => $req_password]);

    $userExist = $stmt->fetchColumn();

    //correct login
    if ((int)$userExist > 0) {
        $_SESSION['user'] = 'whateveryouwannacalltheuser';
        if (isset($_SESSION['return_page'])) {
            //go back where you came from
            header('location:' . $_SESSION['return_page']);
        } else {
            // or go home
            header('Location: index.php');
        }
        exit;
    } else {
        //incorrect login
        echo '<h2>username or password incorrect</h2>';
    }
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="./index.php">home</a></li>
            <li><a href="./intake.php">intake document</a></li>
            <li><a href="./onderhoud.php">onderhoud</a></li>
            <li style="float: right;" class="active"><a href="./login.php"><?= (isset($_SESSION['user'])) ? 'logout' : 'login' ?></a></li>
        </ul>
    </nav>
    <main>
        <div class="login">
            <form method="post">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <table>
                        <tr>
                            <th>user:</th>
                            <td><input type="text" name="user" id="user" required></td>
                        </tr>
                        <tr>
                            <th>password:</th>
                            <td><input type="password" name="password" id="password" required></td>
                        </tr>
                    </table>
                <?php endif ?>
                <input type="submit" name="submit" class="form-button" value="<?= (isset($_SESSION['user'])) ? 'logout' : 'login' ?>">
            </form>
        </div>
    </main>
    <footer>
        <p class="p-center">Copyright BtH - 2021</p>
        <img src="./img/logoRSEB.png" alt="logo RSE beveiliging" class="logo-footer" height="50">
    </footer>
</body>

</html>