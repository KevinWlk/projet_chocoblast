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
                $this->setNomRoles($nom);
                    //Tester si le role existe déjà
                    if($this->getRolesByName()){
                        $msg = "Les informations sont incorrectes";
                    } else {
                    //Test si le compte existe pas
                    $this->setNomRoles($nom);
                    //ajout du compte à la BDD
                    $this->addRoles();
                    //Affichage du message
                    $msg = "Le role : ".$nom." a été ajouté en BDD";

                }
            }
            //sinon si les champs ne sont pas tous remplis
            else{
            $msg = "Veuillez remplir le champs du formulaire.";
            }
        }
        //importer la vue
        include './App/Vue/viewAddRoles.php';
    }
}
?>