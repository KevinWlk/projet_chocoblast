<?php

namespace App\Model;
use App\Utils\BddConnect;


    class Utilisateur extends BddConnect{
        /*----------------------
            Attributs
        ----------------------*/
        private $id_utilisateur;
        private $nom_utilisateur;
        private $prenom_utilisateur;
        private $mail_utilisateur;
        private $password_utilisateur;
        private $image_utilisateur;
        private $statut_utilisateur;
        private $roles;
        /*----------------------
            Constructeur
        ----------------------*/
        public function __construct(){
            //Instancier un Objet Roles quand on créer un utilisateur
            $this->roles = new Roles("Utilisateur");
        }
        /*----------------------
            Getters & Setters
        ----------------------*/
        public function getIdRoles():?int{
            return $this->id_utilisateur;
        }
        public function getNomRoles():?string{
            return $this->nom_utilisateur;
        }
            
    }

?>