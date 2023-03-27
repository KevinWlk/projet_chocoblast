<?php
    //Démarrage de la session
    session_start();
    //Importer les ressources
    use App\Controller\UserController;
    use App\Controller\RolesController;
    use App\Controller\ChocoblastController;
    use App\Controller\CommentaireController;
    include './App/Utils/BddConnect.php';
    include './App/Utils/Fonctions.php';
    include './App/Model/Roles.php';
    include './App/Controller/RolesController.php';
    include './App/Model/Utilisateur.php';
    include './App/Controller/UserController.php';
    include './App/Model/Chocoblast.php';
    include './App/Controller/ChocoblastController.php';
    include './App/Model/Commentaire.php';
    include './App/Controller/CommentaireController.php';

    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    //instance des controllers
    $userController = new UserController();
    $rolesController = new RolesController();
    $chocoblastController = new ChocoblastController();
    $commentaireController = new CommentaireController();
    //routeur connecte
    if(isset($_SESSION['connected'])){
        switch ($path) {
            case '/projet_chocoblast/':
                include './App/Vue/home.php';
                break;
            case '/projet_chocoblast/rolesAdd':
                $rolesController->insertRoles();
                break;
            case '/projet_chocoblast/chocoblastAdd':
                $chocoblastController->insertChocoblast();
                break;
            case '/projet_chocoblast/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet_chocoblast/chocoblastDelete':
                $chocoblastController->deleteChocoblastById();
                break;
            case '/projet_chocoblast/chocoblastUpdate':
                $chocoblastController->updateChocoblastById();
                break;
            case '/projet_chocoblast/deconnexion':
                $userController->deconnexionUser();
                break;
                case '/projet_chocoblast/commentaireAdd':
                    $commentaireController->insertCommentaire();
                    break;
            default:
                include './App/Vue/error.php';
                break;
            }
    }
    //routeur no connecté
    else{
        switch ($path) {
            case '/projet_chocoblast/':
                include './App/Vue/home.php';
                break;
            case '/projet_chocoblast/userAdd':
                $userController->insertUser();
                break;
            case '/projet_chocoblast/chocoblastAll':
                $chocoblastController->showAllChocoblast();
                break;
            case '/projet_chocoblast/chocoblastDelete':
                header('Location: ./chocoblastAll');
                break;
            case '/projet_chocoblast/chocoblastUpdate':
                header('Location: ./chocoblastAll');
                break;
            case '/projet_chocoblast/commentaireAdd':
                header('Location: ./chocoblastAll');
                break;
            case '/projet_chocoblast/connexion':
                $userController->connexionUser();
                break;
            default:
                include './App/Vue/error.php';
                break;
        }
    }
?>