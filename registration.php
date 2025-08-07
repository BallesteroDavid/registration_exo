<?php
require_once 'config/database.php';

$errors = [];
    // --------------------------------------------------
    // Condition qui contient la logique de traitement du formulaire quand on reçoit une request POST
    // --------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupation des données du formulaire
    $username = trim(htmlspecialchars($_POST["username"])) ??'';
    $email = trim(htmlspecialchars($_POST["email"])) ??'';
    $password = $_POST["password"] ??'';
    $confirmPassword = $_POST["confirmPassword"] ??'';
    // var_dump($username, $email, $password, $confirmPassword);

    // validation des données
    // validation username
    // valide que le champ soit remplis
    if (empty($username)) {
        $errors = "nom obligatoire";
    // valide la function strlen si la string est de plus de 3 carac
    }elseif (strlen($username)) {
        $errors[] = "min 3 carac";
    // valide la function strlen si la string est de moins de 55 carac
    }elseif (strlen($username)) {
        $errors[] = "max 55 carac";
    }
    // validation email
    if (empty($email)) {
        $errors = "email obligatoire ! (connard)";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "format d'email invalide";
    }
    // validation password
    if (empty($passsword)) {
        $errors[] = "password obligatoire";
    }elseif (strlen($password) < 8) {
        $errors[] = "le mdp doit au moins contenir 8 carac";
    // normalement ici on met un pattern (carac spéciaux, une maj, une minuscule, un chiffre ...)
    }elseif ($password !== $confirmPassword) {
        $errors[] = "mdp doivent être identique";
    }

    if (empty($errors)) {
        // logique de traitement en db
        $pdo = dbConnexion();

        // vérifier si l'adresse email est utilisé ou non 
        $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");

        $checkEmail->execute([$email]);

        // try {

        // } catch (){

        // }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <section class="sectionContainer">
        <form action="" method="POST">
            <?php 
            foreach ($errors as $error) {
                echo $error;
            }
            ?>
            <div class="sectionContainerUsername">
                <label for="Pseudo">Pseudo :</label><br>
                <input placeholder="Entrez votre pseudo" type="text" id="username" name="username" required><br>
            </div>
            <div class="sectionContainerEmail">
                <label for="Email">Email :</label><br>
                <input placeholder="Entrez votre email" type="email" id="email" name="email" required><br>
            </div>
            <div class="sectionContainerPassword">
                <label for="password">Password :</label><br>
                <input placeholder="Entrez votre password" type="password" id="password" name="password" required><br>
            </div>
            <div class="sectionContainerConfirmPassword">
                <label for="confirmPassword"> Confirmer votre password :</label><br>
                <input placeholder="Confirm Password" type="password" id="confirmPassword" name="confirmPassword" required><br>
            </div>
            <div class="sectionContainerBtn">
                <input type="submit" value="Envoyer"><br>
            </div>
        </form>
    </section>
    
</body>
</html>