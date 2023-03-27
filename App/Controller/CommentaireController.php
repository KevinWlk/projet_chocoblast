<?php
    namespace App\Controller;
    use App\Utils\Fonctions;
    use App\Model\Commentaire;
    use App\Model\Chocoblast;

    class CommentaireController extends Commentaire{
        //Méthode pour ajouter un commentaire en BDD
        public function insertCommentaire():void{
            //Tester si l'utilisateur est connecté
            if(isset($_SESSION['connected'])){
                $msg  = "";
                //Tester si le formulaire est submit
                if(isset($_POST['submit'])){
                    //Nettoyer les entrées
                    $note = Fonctions::cleanInput($_POST['note_commentaire']);
                    $text = Fonctions::cleanInput($_POST['text_commentaire']);
                    $date = Fonctions::cleanInput($_POST['date_commentaire']);
                    $auteur = Fonctions :: cleanInput($_SESSION['id']);
                    $choco = Fonctions :: cleanInput($_GET['id_chocoblast']);
                    //Tester si les champs sont remplis
                    if(!empty($note) AND !empty($text) AND !empty($date) AND !empty($auteur) AND !empty($choco)){
                        //Setter les valeurs à mon objet commentaireController
                        $this->setNoteCommentaire($note);
                        $this->setTextCommentaire($text);
                        $this->setDateCommentaire($date);
                        $this->getAuteurCommentaire()->setIdUtilisateur($auteur);
                        $this->getIdChocoblast()->setIdChocoblast($choco);
                        //Ajouter en BDD le commentaire
                        $this->addCommentaire();
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                        $msg = "Un commentaire sur le chocoblast " . $choco . " a été ajouté";

                    } else{
                        echo '<script>
                            setTimeout(()=>{
                                modal.style.display = "block";
                            }, 500);
                        </script>';
                        $msg = "Veuillez remplir les champs du formulaire";
                    }
                }
                include './App/Vue/viewAddCommentaire.php';
            }else{
                header('Location: ./');
            }
        }
    }
?>