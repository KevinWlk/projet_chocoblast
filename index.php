<?php
    //Importer les ressources
    use App\Controller\UserController;
    use App\Controller\RolesController;
    include './App/Utils/BddConnect.php';
    include './App/Utils/Fonctions.php';
    include './App/Model/Utilisateur.php';
    include './App/Controller/UserController.php';
    include './App/Model/Roles.php';
    include './App/Controller/RolesController.php';

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    //routeur
    switch ($path) {
        case '/projet_chocoblast/':
            include './App/Vue/home.php';
            break;
        case '/projet_chocoblast/userAdd':
            //appel de la fonction 
            $userController->insertUser();
            break;
        case '/projet_chocoblast/rolesAdd':
            //appel de la fonction 
            $rolesController->insertRoles();
            break;
        default:
            include './App/Vue/error.php';
            break;
    }
?>