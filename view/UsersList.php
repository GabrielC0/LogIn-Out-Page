<?php
include_once('bdd.php');
include_once('model/UsersModel.php'); 

// Créez une instance du modèle UsersModel
$usersModel = new UsersModel();

// Récupérez la liste des utilisateurs depuis la base de données
$users = $usersModel->getAllUsers(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Listing</title>
</head>
<body>
    <h1>Users Listing</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
