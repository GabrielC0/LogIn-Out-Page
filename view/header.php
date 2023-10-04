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
            <a href="index.php">Acceuil</a> 
            <a href="?page=contact">contact</a> 
            <?php
                if (@$_SESSION['nom']) {
                    echo '<a href="?page=deconnexion">deconnexion</a>';
                    echo '<a href="?page=UsersList">UsersList</a>';
                } else {
                    echo '<a href="?page=connexion">connexion</a>';
                    echo '<p> </p>';
                    echo '<a href="?page=inscription">inscription</a>';
                }
            ?>

        </nav>
    </header>