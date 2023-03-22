<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/style/style.css">
    <title>view</title>
</head>
<body>
    <h3>Ajouter un compte Utilisateur</h3>

    <form action="" method="post">
        <label for="nom_roles">Saisir le nom du compte utilisateur :</label>
        <input type="text" name = "nom_roles">
        
        <input type="submit" value = "Ajouter" name = "submit">
    </form>
    <div id="error"> <?php echo $msg;?> </div>
</body>
</html>