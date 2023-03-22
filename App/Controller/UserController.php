<?php
    namespace App\Controller;
    use App\Utils\Fonctions;
    use App\Model\Utilisateur;

    class userController extends Utilisateur{
        //Fonction qui va ggérer l'ajout d'un utilisateur en BDD
        public function insertUser(){
            //Variable pour stocker les messages d'erreurs 
            $msg = "";
        /*----------------------
            Logique
        ----------------------*/
        //Tester si le Bouton est cliqué
            if (isset($_POST['submit'])){
                $nom = Fonctions::cleanInput($_POST['nom_utilisateur']);
                $prenom = Fonctions::cleanInput($_POST['prenom_utilisateur']);
                $mail = Fonctions::cleanInput($_POST['mail_utilisateur']);
                $password = Fonctions::cleanInput($_POST['password_utilisateur']);
                //Tester si les champs sont remplis
                if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($password)){
                    //Récupérer le mail dans un objet
                    $this->setMailUtilisateur($mail);
                    //Tester si le compte existe déjà
                    if($this->getUserByMail()){
                        $msg = "Les informations sont incorrectes";
                    }
                    //Hash le mot de passe
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    
                    $this->setNomUtilisateur($nom);
                    $this->setPrenomUtilisateur($prenom);
                    $this->setPasswordUtilisateur($password);

                    //Version alternative avec un nouvel objet utilisateur
                    /*
                    $user = new Utilisateur();
                    $user->setNomUtilisateur($nom);
                    $user->setPrenomUtilisateur($prenom);
                    $user->setMailUtilisateur($mail);
                    $user->setPasswordUtilisateur($password);
                    */
                    // echo '<pre>';
                    // var_dump($this);
                    // echo '</pre>';

                    $this->addUser();
                    $msg = "Le compte : " . $mail . " a été ajouté à la BDD!";

                }
                //Sinon si les champs ne sont pas tous remplis
                else {
                    $msg = "Veuillez remplir tout les champs du formulaire.";
                }
            }
            //importer la vue
            include './App/Vue/viewAddUser.php';
        }
    }
?>