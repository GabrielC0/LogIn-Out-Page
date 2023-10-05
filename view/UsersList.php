<h1>Users Listing</h1> 

 <!-- Vérifie si la variable de session 'nom' est définie -->
<?php if(isset($_SESSION['nom'])) { ?>

    <!-- Commence la création d'un tableau HTML avec des classes CSS pour la mise en forme                  -->
    <table class="table table-hover"> 

        <tr>                                            
            <th>Nom</th>                               
            <th>Prenom</th>  
            <th>Email</th>  
        </tr> 

         <!-- Démarre une boucle pour parcourir le tableau $users -->
        <?php foreach ($users as $user) { ?>              
            <!-- Affiche le nom/prenom/email de l'utilisateur dans leurs cellules -->
            <tr>  
                <td><?php echo $user['nom']; ?></td>       
                <td><?php echo $user['prenom']; ?></td>  
                <td><?php echo $user['email']; ?></td>  
            </tr>  
        <?php } ?>  

    </table>  

<?php } else { ?> :
    <p>Vous devez être connecté pour voir cette page</p>  
<?php } ?>  