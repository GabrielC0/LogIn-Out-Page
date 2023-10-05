<h1>Mon Compte<h1>
<form action="" method="POST">
    nom : <input type="text" name="nom" value="<?php echo $user['nom']; ?>" > <br>
    prenom : <input type="text" name="prenom"  value="<?php echo $user['prenom']; ?>" > <br>
    email : <input type="email" name="email"  value="<?php echo $user['email']; ?>" > <br>
    <button>Envoyer</button>
</form>

