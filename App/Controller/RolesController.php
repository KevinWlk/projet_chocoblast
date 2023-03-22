<?php
    namespace App\Controller;
    use App\Utils\Fonctions;
    use App\Model\Roles;

    class rolesController extends Roles{
        //Fonction qui va ggérer l'ajout d'un utilisateur en BDD
        public function insertRoles(){
            //Variable pour stocker les messages d'erreurs 
            $msg = "";
        /*----------------------
            Logique
        ----------------------*/
        //Tester si le Bouton est cliqué
            if (isset($_POST['submit'])){
                $nom = Fonctions::cleanInput($_POST['nom_roles']);

                //Tester si les champs sont remplis
                if(!empty($nom)){
                    //Récupérer le nom du role dans un objet
                    $this->setNomRoles($nom);
                    //Tester si le role existe déjà
                    if($this->addRoles()){
                        $msg = "Les informations sont incorrectes";
                    }
                    
                    $this->setNomRoles($nom);

                    $this->addRoles();
                    $msg = "Le role : " . $nom . " a été ajouté à la BDD!";

                }
                //Sinon si les champs ne sont pas tous remplis
                else {
                    $msg = "Veuillez remplir le champs du formulaire.";
                }
            }
            //importer la vue
            include './App/Vue/viewAddRoles.php';
        }
    }
?>