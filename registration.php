<?php

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
    var_dump($username, $email, $password, $confirmPassword);

    // validation des données
    // validation username
    if (empty($username)) {
        $errors = "Veuillez renseigner votre pseudo"
    }
    // validation email
    if (empty($email)) {
        $errors = "Veuillez renseigner votre email"
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="sectionContainer">
        <form action="" method="POST">
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