<?php

namespace App\Model;
use App\Utils\BddConnect;




    class Roles extends BddConnect{
        /*----------------------
            Attributs
        ----------------------*/
        private ?int $id_roles;
        private ?string $nom_roles;
        /*----------------------
            Constructeur
        ----------------------*/
        public function __construct(){

        }
        /*----------------------
            Getters & Setters
        ----------------------*/
        public function getIdRoles(){
            $this->id_roles;
        }
        public function getNomRoles(){
            $this->nom_roles;
        }
        public function setNomRoles($name):void{
            $this->nom_roles = $name;
        }
            
        public function addRoles():void {
            try {
                //Récupérer les données
                $nom = $this->nom_roles;
                //péprarer la requête
                $req = $this->connexion()->prepare('INSERT INTO roles(nom_roles) VALUES (?)');
                //Bind les paramètres
                $req->bindParam(1, $nom, \PDO::PARAM_STR);
                //Exécuter la requête
                $req->execute();
            }
            catch(\Exception $e) {
                die ('Erreur : '.$e->getMessage());
            }
        }
        public function getRolesByName():?array{
            try{
                //Récupération du nom
                $nom = $this->nom_roles;
                //Preparation de la requête
                $req = $this->connexion()->prepare('SELECT id_roles, nom_roles
                FROM roles WHERE nom_roles = ?');
                //Bind des paramètres
                $req->bindParam(1, $nom, \PDO::PARAM_STR);
                //Execution de la requête
                $req->execute();
                //Récupération sous forme de tableau d'objet
                $data = $req->fetchAll(\PDO::FETCH_OBJ);
                //Retrourne un tableau
                return $data;
            }
            //Gestion des erreurs (Exception)
            catch (\Exception $e){
                die('erreur : ' . $e->getMessage());
            }
        }
    }

?>