<?php
//codé par KIDIMBA LUNZI GRADI
//Date début : 08/10/2025
//Dare fin : 08/10/2025
/* 
    cette class contient 2 fonctions static qui perettent respectivement de
    1.Ajouter une entreprise
    2.validé une entreprise
*/ 
session_start();
    class users{

        //définition des attributs
        protected $pseudo;
        protected $mdp;


        //constructeur
        public function __construct($ps,$mdp) {
            $this->pseudo = $ps;
            $this->mdp = $mdp;

        }


        //fonction de connexion:
      
        public function authentification(){
            /*
                cette fonction teste la connexion et renvoi TRUE si l'utilisareur exitse
                et FALSE si il n'existe pas
            */ 
            $espion =[];

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('SELECT etudiants.id as id_etud,users.id,nomuser,mdp 
                                    from users
                                    inner join etudiants
                                    on users.id = etudiants.user_id
                                    where nomuser =? 
                                    and mdp= ?');
            $req->execute(array($this->pseudo,$this->mdp));

            if($res = $req->fetch()){
                array_push($espion,'etudiant');
                array_push($espion,$res['id']);  
                array_push($espion,$res['id_etud']);               
             }else{
                $req = $bdd->prepare('SELECT entreprises.id as id1,users.id as id2,nomuser,mdp, statut_validation as st_val 
                                    from users
                                    inner join entreprises
                                    on users.id = entreprises.user_id
                                    where nomuser =? 
                                    and mdp= ?');
                $req->execute(array($this->pseudo,$this->mdp));
                
                    if($res = $req->fetch()){
                        array_push($espion,'entreprise');
                        array_push($espion,$res['id1']);
                        array_push($espion,$res['id2']);
                        array_push($espion,$res['st_val']);
                    }
             }
            return $espion;
        }

        //fonction d'inscription:

        public function inscription(){
            try {
                /*
                cette fonction insère un nouvel utilisateur et
                renvoi TRUE si l'utilisateur 
                et un message d'erreur au cas contraire
            */ 

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('INSERT INTO users(nomuser,mdp) VALUES(?,?)');
            $espion = $req->execute(array($this->pseudo,$this->mdp));

            if($espion){ return $espion = TRUE; }
            } catch (Exception $e) {
               echo $e;
            }
        }

        public static function authentificationAdmin($data){
            /*
                cette fonction teste la connexion et renvoi TRUE si l'utilisareur exitse
                et FALSE si il n'existe pas
            */ 
                
            $espion = FALSE;

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('SELECT * FROM admins WHERE id = ? and mdp = ?');
            $req->execute(array($data[0],$data[1]));

            if($req->fetch()){ return $espion = TRUE; }

        
        }
        public static function toutOffre(){

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('SELECT * FROM offres_stage');
            $req->execute();
            $res = $req->fetchAll();
            return $res;

        }
        public static function toutCandidature(){

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('SELECT * FROM candidatures');
            $req->execute();
            $res = $req->fetchAll();
            return $res;

        }
        public static function Valider_offre($stage){

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('UPDATE offres_stage 
                                    SET statut = "validée" 
                                    WHERE id = ?');
                
            $req->execute($stage);
            
        }
        public static function Valider_candidature($candidature){

            //se connecter à la base des données
            $bdd = config::connexion();

            //recheche
            $req = $bdd->prepare('UPDATE candidatures 
                                    SET statut = "etudiée" 
                                    WHERE id = ?');
                
            $req->execute(array($candidature));
        }
    }


?>