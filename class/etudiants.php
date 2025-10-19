<?php
//codé pr KIDIMBA LUNZI GRADI
//Date début : 09/10/2025
//Dare fin : 09/10/2025
/* 
    cette class contient 2 fonctions static qui perettent respectivement de
    1.Ajouter un proil étudiant
*/ 


    class etudiants{

        //fonction  Ajout entreprise:
      
        public static function AjouterProfil($data){
            
            $espion = FALSE;

            //se connecter à la base des données
            $bdd = config::connexion();

            $fichier =$_FILES['cv'];

            $dossier = '../assets/fichiers/';
            $chemin = $dossier.basename($fichier['name']);
            //echo $chemin;exit;

            if(move_uploaded_file($fichier['tmp_name'],$chemin)){
               

                $sql = $bdd->prepare('INSERT INTO users(nomuser,mdp) VALUES(?,?)');
                $sql->execute(array($data[0],$data[4]));

                $sql2 = $bdd->query('SELECT id FROM users order by id desc LIMIT 1');
                $a = $sql2->fetch();
                
                //enregistrement
                $req = $bdd->prepare(  
                                        'INSERT INTO etudiants(nom,promo,cv_path,competences,user_id) 
                                        VALUES(?,?,?,?,?)'
                                    );
                $espion = $req->execute(array($data[0],$data[1],$chemin,$data[3],$a[0]));

                if($espion){ return $espion = TRUE; }

            }

            
        }
        public static function rechercherOffre($data){


            //se connecter à la base des données
            $bdd = config::connexion();
            
            $req = $bdd->prepare('SELECT * 
                                    FROM offres_stage 
                                    where competences_requises LIKE ? 
                                    and statut = "validée"');
            $req->execute(['%'.$data[0].'%']);
            $res = $req->fetchAll();
            return $res;
        }
        public static function postuler($data){
            //se connecter à la base des données
            $bdd = config::connexion();
            // var_dump($data);exit;
            $req = $bdd->prepare('INSERT INTO candidatures(date_candidature,offre_id,etudiant_id) VALUES(?,?,?)');
            // var_dump($data);exit;
            $req->execute(array(date('Y-m-d'),$data[0],$data[1]));
        }
        public static function voir_etat_candidatures($idetud){
            
            //se connecter à la base des données
            $bdd = config::connexion();
            
            $req = $bdd->prepare('SELECT candidatures.id as idCand,
                                    offres_stage.titre as titre_offre, 
                                    candidatures.statut as candStat
                                    FROM `candidatures`
                                    inner JOIN etudiants
                                    on candidatures.etudiant_id = etudiants.id
                                    inner JOIN offres_stage
                                    on candidatures.offre_id = offres_stage.id
                                    and etudiants.id = ?
                                    and candidatures.statut !="annulée"');
            
            $req->execute($idetud);
            $res = $req->fetchAll();
            return $res;


        }
         public static function annuler_candidature($idCand){
            
            //se connecter à la base des données
            $bdd = config::connexion();
            
            $req = $bdd->prepare('UPDATE candidatures 
                                    SET statut= "annulée"
                                    WHERE id = ?');
            
            $req->execute([$idCand]);

        }

        
    }


?>