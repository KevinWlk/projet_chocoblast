<?php

    namespace App\Model;
    use App\Utils\BddConnect;
    use App\Model\Roles;

    class Utilisateur extends BddConnect {

        /*----------------------
            Attributs
        ----------------------*/
        private ?int $id_utilisateur;
        private ?string $nom_utilisateur;
        private ?string $prenom_utilisateur;
        private ?string $mail_utilisateur;
        private ?string $password_utilisateur;
        private ?string  $image_utilisateur;
        private ?bool $statut_utilisateur;
        private ?Roles  $roles;
        /*----------------------
            Constructeur
        ----------------------*/
        public function __construct() {
            //Instancier un Objet Roles quand on créer un utilisateur
            // $this->roles = new Roles("Utilisateur");
        }
        /*----------------------
            Getters & Setters
        ----------------------*/
        public function getIdUtilisateur():?int {
            return $this->id_utilisateur;
        }
        public function getNomUtilisateur():?string {
            return $this->nom_utilisateur;
        }
        public function getPrenomUtilisateur():?string {
            return $this->prenom_utilisateur;
        }
        public function getMailUtilisateur():?string {
            return $this->mail_utilisateur;
        }
        public function getPasswordUtilisateur():?string {
            return $this->password_utilisateur;
        }

        public function setNomUtilisateur($name):void {
            $this->nom_utilisateur = $name;
        }
        public function setPrenomUtilisateur($surname):void {
            $this->prenom_utilisateur = $surname;
        }
        public function setMailUtilisateur($email):void {
            $this->mail_utilisateur = $email;
        }
        public function setPasswordUtilisateur($pwd):void {
            $this->password_utilisateur = $pwd;
        }
        /*----------------------
            Méthodes
        ----------------------*/

    //méthode pour ajouter un utilisateur en BDD
        public function addUser():void {
            try {
                //Récupérer les données
                $nom = $this->nom_utilisateur;
                $prenom = $this->prenom_utilisateur;
                $mail = $this->mail_utilisateur;
                $password = $this->password_utilisateur;
                //péprarer la requête
                $req = $this->connexion()->prepare('INSERT INTO utilisateur(nom_utilisateur, prenom_utilisateur, mail_utilisateur, password_utilisateur) VALUES (?,?,?,?)');
                //Bind les paramètres
                $req->bindParam(1, $nom, \PDO::PARAM_STR);
                $req->bindParam(2, $prenom, \PDO::PARAM_STR);
                $req->bindParam(3, $mail, \PDO::PARAM_STR);
                $req->bindParam(4, $password, \PDO::PARAM_STR);
                //Exécuter la requête
                $req->execute();
            }
            catch(\Exception $e) {
                die ('Erruer : '.$e->getMessage());
            }
        }
    //méthode pour récupérer un utilisateur avec son mail
    public function getUserByMail():?array{
        //exécution de la requête
        try {
            //récupération du mail
            $mail = $this->mail_utilisateur;
            //préparation de la requête
            $req = $this->connexion()->prepare('SELECT id_utilisateur, nom_utilisateur, prenom_utilisateur
            mail_utilisateur, password_utilisateur, image_utilisateur, statut_utilisateur, id_roles
            FROM utilisateur WHERE mail_utilisateur = ?');
            //bind des paramètres
            $req->bindParam(1, $mail, \PDO::PARAM_STR);
            //éxécution de la requête
            $req->execute();
            //récupération sous forme de tableau d'objets
            $data = $req->fetchAll(\PDO::FETCH_OBJ);
            //retour du tableau
            return $data;
        }
        //gestion des erreurs (Exception)
        catch (\Exception $e){
            //affichage de l'erreur
            die('Erreur : '.$e->getMessage());
        }
        }
    }
?>