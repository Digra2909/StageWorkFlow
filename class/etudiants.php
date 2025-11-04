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

            // 1. Connexion à la base de données
            $bdd = config::connexion();

            
            if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
        
                return $espion; 
            }
            
            $fichier = $_FILES['cv'];
            $dossier = '../assets/fichiers/pdfs/';


            $nom_fichier_unique = uniqid() . '_' . basename($fichier['name']);
            $chemin = $dossier . $nom_fichier_unique;

            if(move_uploaded_file($fichier['tmp_name'], $chemin)){
                    

                try {

                    $sql = $bdd->prepare('INSERT INTO users(nomuser, mdp) VALUES(?, ?)');
                    $sql->execute(array($data[0], $data[4]));
                    

                    $user_id = $bdd->lastInsertId();

                    if ($user_id) {
        
                        $req = $bdd->prepare(  
                                                'INSERT INTO etudiants(nom, promo, cv_path, competences, user_id) 
                                                VALUES(?, ?, ?, ?, ?)'
                                            );
                        $espion = $req->execute(array($data[0], $data[1], $chemin, $data[3], $user_id));
                    }
                    
                } catch (PDOException $e) {

                    $espion = FALSE;
                }

            } else {

                $espion = FALSE;
            }

            return $espion;
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
        public static function depotRapport($data){
            $espion = FALSE;

            // 1. Connexion à la base de données
            $bdd = config::connexion();

            
            if (!isset($_FILES['rapport']) || $_FILES['rapport']['error'] !== UPLOAD_ERR_OK) {
                return $espion; 
            }
            
            $fichier = $_FILES['rapport'];
            $dossier = '../assets/fichiers/rapport/';


            $monRapport = uniqid() . '_' . basename($fichier['name']);
            $chemin = $dossier . $monRapport;
            
            if(move_uploaded_file($fichier['tmp_name'], $chemin)){
          

                try {
                
                    $sql = $bdd->prepare('INSERT INTO rapport(path_rapport,etudiant_id) VALUES(?,?)');
                    $sql->execute(array($chemin,$data[1]));
                    $espion = TRUE;
                    
                } catch (PDOException $e) {

                    echo $e ;
                }

            } else {

                $espion = FALSE;
            }
            return $espion;
        }
        public static function AjoutProf($donnee){
            // var_dump($donnee);exit;
            //se connecter à la base des données
            $bdd = config::connexion();

            $requete = $bdd->prepare('UPDATE etudiants 
                                        SET enseignant_mail = ?
                                        WHERE id =  ? ');
            $res = $requete->execute($donnee);
            return $res;
        }
        
    }


?>