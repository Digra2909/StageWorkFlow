<?php
//codé pr NSILULU MAVUNGU JILSON
//Date début : 07/10/2025
//Dare fin : 08/10/2025
/* 
    cette class contient 2 fonctions static qui perettent respectivement de
    1.Ajouter une entreprise
    2.validé une entreprise
*/ 


    class entreprise{

        //fonction  Ajout entreprise:
      
        public static function AjouterEntreprise($data){
        
            $espion = FALSE;

            //se connecter à la base des données
            $bdd = config::connexion();

            //enregistrement
           $sql = $bdd->prepare('INSERT INTO users(nomuser,mdp) VALUES(?,?)');
            $sql->execute(array($data[0],$data[4]));

            $sql2 = $bdd->query('SELECT id FROM users order by id desc LIMIT 1');
            $a = $sql2->fetch();

            //enregistrement
            $req = $bdd->prepare(  
                                        'INSERT INTO entreprises(nom,secteur,adresse,email,user_id) 
                                        VALUES(?,?,?,?,?)'
                                    );
            $espion = $req->execute(array($data[0],$data[1],$data[2],$data[3],$a[0]));


        }
        public static function validationEntreprise($data){
            $espion = FALSE;

            //se connecter à la base des données
            $bdd = config::connexion();

            //validtion de l'entreprise
            $req = $bdd->prepare(
                                    'UPDATE  entreprises 
                                    SET statut_validation = "validée"
                                    where  nom = ?'
                                );
            $espion = $req->execute($data);

            if($espion){ return $espion = TRUE; }
        }
        public static function toutEse(){
            $espion = FALSE;

            //se connecter à la base des données
            $bdd = config::connexion();

            //validtion de l'entreprise
            $req = $bdd->prepare(
                                    'SELECT * FROM entreprises'
                                );
            $req->execute();

            $liste_Ese = $req->fetchAll();
            return $liste_Ese;
        }
        public static function PublierStage($data){
            
            //se connecter à la base des données
            $bdd = config::connexion();
            $sql = $bdd->prepare('INSERT INTO offres_stage(titre,descriptions,competences_requises,date_publication,entreprise_id) VALUES(?,?,?,?,?)');
            $sql->execute($data);

        }   
        public static function toutCandidatureValide(){

            //se connecter à la base des données
            $bdd = config::connexion();

            //validtion de l'entreprise
            $req = $bdd->prepare(
                                    "SELECT offres_stage.entreprise_id as entreprise_id,
                                            candidatures.id,
                                            candidatures.date_candidature as dte,
                                            offres_stage.titre as objet,
                                            offres_stage.descriptions as descriptions,
                                            cv_path,
                                            etudiants.nom as nom_etud,
                                            offres_stage.competences_requises as competences_offres, 
                                            etudiants.competences as competence_etudiant 
                                    from candidatures 
                                    inner join etudiants 
                                    on etudiants.id = candidatures.etudiant_id 
                                    inner join offres_stage 
                                    on candidatures.offre_id = offres_stage.id
                                    where candidatures.statut = 'étudiée'
                                    and entreprise_id=?"
                                );
            $req->execute(array($_SESSION['entreprise_id']));

            $liste_Candidature = $req->fetchAll();
            return $liste_Candidature;
        }
        public static function accepterCandidature($idCand){
            
            //connexion à la base des données
            $bdd = config::connexion();
        
            $req = $bdd->prepare('UPDATE candidatures
                                    SET statut = "acceptéé"
                                    WHERE id = ? ');
            $res = $req->execute(array($idCand));
            return $res;
        }
        public static function refuse_candidature($idCand){
            
            //connexion à la base des données
            $bdd = config::connexion();
        
            $req = $bdd->prepare('UPDATE candidatures
                                    SET statut = "refusée"
                                    WHERE id = ? ');
            $res = $req->execute(array($idCand));
            return $res;
        }
        public static function voir_offre($identreprise){
             //connexion à la base des données
            $bdd = config::connexion();
        
            $req = $bdd->prepare('SELECT titre,
                                    descriptions,
                                    date_publication,
                                    statut
                                    FROM offres_stage  
                                    WHERE offres_stage.entreprise_id = ?
                                    and offres_stage.statut != "en attente"');
            $res = $req->execute(array($identreprise));
            return $res= $req->fetchAll();

        }
        public static function toutTuteur($identreprise){
             //connexion à la base des données
            $bdd = config::connexion();
        
            $req = $bdd->prepare('SELECT id,nomTuteur,matr
                                    FROM tuteur  
                                    WHERE entreprise_id = ?');
            $res = $req->execute(array($identreprise));
            return $res= $req->fetchAll();

        }
        public static function enregTuteur($tuteur){
            
             //connexion à la base des données
            $bdd = config::connexion();
            $req = $bdd->prepare('INSERT INTO tuteur(nomTuteur,matr,entreprise_id)
                                    VALUES(?,?,?)');
            $res = $req->execute($tuteur);
            

        }
        public static function toutCandidatureaceptte(){

            //se connecter à la base des données
            $bdd = config::connexion();

            //validtion de l'entreprise
            $req = $bdd->prepare(
                                    "SELECT etudiants.id as id_etud,
                                            offres_stage.entreprise_id as entreprise_id,
                                            candidatures.id,
                                            offres_stage.id as id_offre,
                                            candidatures.date_candidature as dte,
                                            offres_stage.titre as objet,
                                            offres_stage.descriptions as descriptions,
                                            cv_path,
                                            etudiants.nom as nom_etud,
                                            offres_stage.competences_requises as competences_offres, 
                                            etudiants.competences as competence_etudiant 
                                    from candidatures 
                                    inner join etudiants 
                                    on etudiants.id = candidatures.etudiant_id 
                                    inner join offres_stage 
                                    on candidatures.offre_id = offres_stage.id
                                    where candidatures.statut = 'acceptée'
                                    and offres_stage.statut != 'pourvue'
                                    and entreprise_id=?"
                                );
            $req->execute(array($_SESSION['entreprise_id']));

            $liste_Candidature = $req->fetchAll();
            return $liste_Candidature;
        }
        public static function creer_stage($stage){
            //se connecter à la base des données
            $bdd = config::connexion();

            $req  = $bdd->prepare('INSERT INTO stages(date_debut,date_fin,tuteur_id,entreprise_id,etudiant_id)
                                    VALUES(?,?,?,?,?)');
            $req->execute($stage);

        }
        public static function offrePourvue($stage){
            
            //se connecter à la base des données
            $bdd = config::connexion();

            $req  = $bdd->prepare('UPDATE offres_stage
                                    SET statut = "pourvue"
                                    where id = ?');
            $req->execute(array($stage));

        }
        public static function cnxTuteur($login){

            //se connecter à la base des données
            $bdd = config::connexion();

            $req = $bdd->prepare('SELECT * FROM tuteur
                                    WHERE nomTuteur = ?
                                    AND matr = ?');
            $req->execute($login);
            if ($res = $req->fetch()) {
                return $res;
            }

        }
        public static function evaluerStagiaire($data){
            
            function moyenneCote($data){
                $total=0;
                $nomnbre_cotes = count($data);
                foreach($data as $cote){
                    $total += $cote;
                }
                return ($total /$nomnbre_cotes);
            }
            //se connecter à la base des données
            $bdd = config::connexion();

            $req = $bdd->prepare('INSERT INTO evaluation(
                                        connaissance_professionelles
                                        ,rendement
                                        ,esprit_initiative
                                        ,ponctualite_ordre_discioline
                                        ,collaboration_travail_equipe
                                        ,conscience_prof
                                        ,comportement_generale
                                        ,tuteur_id
                                        ,etudiant_id
                                        ,id_stage
                                        ,moyenneCote)
                                VALUES(?,?,?,?,?,?,?,?,?,?,?)');
            //les id etrangères 
            $valeur = array_slice($data,-3);
            
            //les côtes du stage
            $note = array_diff($data,$valeur);

            //calculer la moyenne des notes
            $moyenne = moyenneCote($note);

            //ajouter les id et la moyenne au tableau final
            $array_final = array_merge($note,$valeur);

            array_push($array_final,$moyenne);
            // foreach ($array_final as $key => $value) {
            //     echo $key.'==>'.$value.'</br>';
            // }exit;

            $res = $req->execute(array($array_final[0],
                                        $array_final[1],
                                        $array_final[2],
                                        $array_final[3],
                                        $array_final[4],
                                        $array_final[5],
                                        $array_final[6],
                                        $array_final[7],
                                        $array_final[8],
                                        $array_final[9],
                                        $array_final[10]
                                        
                                    ));

            if($res){
                    $req = $bdd->prepare("UPDATE stages SET statut='évalué' where id= ?");
                    $req->execute(array($array_final[7]));  
            }
        }
        public static function recupereStage($idTuteur){

            //se connecter à la base des données
            $bdd = config::connexion();

            $req = $bdd->prepare('SELECT etudiants.nom as nom_stagiaire, 
                                    stages.statut as statut_stg,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                                    etudiants.id as id_etudiant,
                                    stages.id as id_stage
                                    from etudiants                                                                                                                                                                                                                                                                                                                                                                                     
                                    inner join stages 
                                    on stages.etudiant_id = etudiants.id 
                                    INNER join tuteur 
                                    where tuteur.id = ?
                                    ');
            $req->execute(array($idTuteur));
            if($res = $req->fetchAll()){
                return $res;
            }

        }
        public static function afficher_moyenne($param){

            //se connecter à la base des données
            $bdd = config::connexion();

            $req= $bdd->prepare('SELECT moyenneCote
                                    FROM    evaluation
                                    WHERE tuteur_id = ?
                                    and etudiant_id = ?
                                    and id_stage = ?');
            $req->execute($param);
            $moyenne = $req->fetch();
            return $moyenne[0];
                                    
        }
        public static function etudiantAevaluer($data){
            
        }
    }


?>