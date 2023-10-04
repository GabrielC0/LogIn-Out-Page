<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <header>
       
        <nav>
        <img src="https://picsum.photos/100/100">
            <a href="index.php">A propos</a> 
            <a href="?page=experiences.php">experiences</a> 
            <a href="?page=contact.php">contact</a> 
            <?php
                if (@$_SESSION['nom']) {
                    echo '<a href="?page=deconnexion">deconnexion</a>';
                } else {
                    echo '<a href="?page=connexion">connexion</a>';
                    echo '<p> </p>';
                    echo '<a href="?page=inscription">inscription</a>';
                }
            ?>

        </nav>
    </header>