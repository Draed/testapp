<?php require('functions.php') ?>

<?php include('../partials/_header.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>affichage des données</title>                       
    </head>
    <body>
        <form method="post" action="aftershow_data.php">
            Afficher les données pour l'application : 
            <select name="application">
            <?php getAllApps(); ?>
            </select>
            <br>
            <input type="submit" name="submit" value="Afficher" />
        </form>
        <form>
            <input type="button" value="Retour au menu principal des données" onclick="history.go(-1)">
        </form>
    </body>    
<?php include('../partials/_footer.php') ?>
