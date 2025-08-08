<?php
    require_once 'config/database.php';

    session_start();

    $errors = [];
    
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Récupation des données du formulaire
        $email = trim(htmlspecialchars($_POST["email"])) ??'';
        $password = $_POST["password"] ??'';
        // var_dump($email,$password);

        // validation des données
        // validation email
        // valide que le champ soit remplit
        if (empty($email)) {
            $errors[] = "email obligatoire";
        }

        // validation password
        if (empty($password)) {
            $errors[] = "password obligatoire";
        }
            
        if (empty($errors)) {
            try {
                // appel de la fonction de la connexion à la db
                $pdo = dbConnexion();
                // prépare une requete sql (email dynamique)
                $sql = "SELECT * FROM users WHERE email = ?";
                // stock ma request préparée
                $requestDb = $pdo->prepare($sql);
                // execute la request en lui passant en parametre l'élément dynamique
                $requestDb->execute([$email]);
                // récuperation des données
                $user = $requestDb->fetch();
                
                if ($user) {
                    //verification
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user_id"] = $user['id'];
                        $_SESSION["username"] = $user['username'];
                        $_SESSION["email"] = $user['email'];
                        $_SESSION['loggin'] = true;

                        $message = "super vous etes connecté " . htmlspecialchars($user['name']);
                        header('location: home.php');
                        exit();
                    }else{
                        $errors[] = "mot de passe pas bon ma gueule";
                    }     
                }else{
                    $errors[] = "compte introuvable ma gueule";
                }  
            } catch (PDOException $e) {
                $errors[] = "nous avons des problemes ma gueule: " . $e->getMessage();
            }
        
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
            if (!empty($errors)) {
                foreach($errors as $error) {
                echo $error;
                }
            }
            ?>
            <div class="sectionContainerEmail">
                <label for="Email">Email :</label><br>
                <input placeholder="Entrez votre email" type="email" id="email" name="email" ><br>
            </div>
            <div class="sectionContainerPassword">
                <label for="password">Password :</label><br>
                <input placeholder="Entrez votre password" type="password" id="password" name="password" ><br>
            </div>
            <div class="sectionContainerBtn">
                <input type="submit" value="Connexion"><br>
            </div>
        </form>
    </section>
</body>
</html>
