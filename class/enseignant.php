<?php
    class enseignant
    {
        public static function inscription($enseignant){
            //se connecter à la base des données
            $bdd = config::connexion();
            $req = $bdd->prepare('INSERT INTO users(nomuser,mdp) VALUES(?,?)');
            if($res = $req->execute(array($enseignant[0],$enseignant[3]))){

                $sql2 = $bdd->query('SELECT id FROM users order by id desc LIMIT 1');
                $a = $sql2->fetch();
                //enregistrement
                $req = $bdd->prepare(  
                                            'INSERT INTO enseignant(matiere,user_id,email) 
                                            VALUES(?,?,?)'
                                        );
                $res = $req->execute(array($enseignant[1],$a[0],$enseignant[2]));
                return $res;
            }
        }
        public static function cnxEnseignant($login){

            //se connecter à la base des données
            $bdd = config::connexion();

            $req = $bdd->prepare('SELECT * FROM users
                                    inner join enseignant
                                    on users.id =enseignant.user_id 
                                    WHERE nomuser = ?
                                    AND mdp = ?');
            $req->execute($login);

            if ($res = $req->fetch()) {
                return $res;
            }
        }
        public static function suivreStage($mail){

            //se connecter à la base des données
            $bdd = config::connexion();

            $requete = $bdd->prepare('SELECT
                                    etudiants.id as id_etud,
                                    etudiants.nom as nom,
                                    candidatures.statut as stateC,
                                    evaluation.moyenneCote as moy,
                                    evaluation.id as id_eval
                                    FROM etudiants
                                    INNER JOIN candidatures
                                    on etudiants.id = candidatures.etudiant_id
                                    INNER JOIN evaluation
                                    on etudiants.id = evaluation.etudiant_id
                                    INNER JOIN stages
                                    on stages.id = evaluation.id_stage
                                    WHERE etudiants.enseignant_mail = ?
                                    AND candidatures.statut != "annulée"');
            
            $requete->execute(array($mail));
            return $res = $requete->fetchAll();
            
        }
        public static function voir_details($idStg){
            //se connecter à la base des données
            $bdd = config::connexion();

            $requete = $bdd->prepare('SELECT
                                    evaluation.connaissance_professionelles as conProf,
                                    evaluation.rendement as rendement,
                                    evaluation.esprit_initiative as esprit,
                                    evaluation.ponctualite_ordre_discioline as ponct ,
                                    evaluation.collaboration_travail_equipe as collab,
                                    evaluation.conscience_prof as consc,
                                    evaluation.comportement_generale as comportement_generale,
                                    etudiants.nom as nom,
                                    candidatures.statut as stateC,
                                    evaluation.moyenneCote as moy,
                                    evaluation.id as id_eval
                                    FROM etudiants
                                    INNER JOIN candidatures
                                    on etudiants.id = candidatures.etudiant_id
                                    INNER JOIN evaluation
                                    on etudiants.id = evaluation.etudiant_id
                                    AND evaluation.id = ?');
            
            $requete->execute(array($idStg));
            return $res = $requete->fetch();
        }
        public static function recupereEtatCand($mail){
            $bdd = config::connexion();

            $requete = $bdd->prepare('SELECT candidatures.date_candidature as date_cand,
                                        offres_stage.titre as titre,
                                        etudiants.nom as nom,
                                        entreprises.nom as nomEntr,
                                        candidatures.statut as states
                                        FROM candidatures
                                        INNER JOIN etudiants
                                        ON candidatures.etudiant_id = etudiants.id
                                        INNER JOIN offres_stage
                                        INNER JOIN entreprises
                                        ON offres_stage.entreprise_id = entreprises.id
                                        on offres_stage.id = candidatures.offre_id
                                        WHERE etudiants.enseignant_mail = ?
                                        ');
            $requete->execute(array($mail));
            return $res = $requete->fetchAll();
        }
        public static function voirrapport($id){
            
            //connexion bdd
            $bdd = config::connexion();

            $requete =$bdd->prepare('SELECT path_rapport 
                                        from rapport 
                                        where exists( 
                                            select etudiant_id 
                                            from rapport 
                                            where etudiant_id = ?)');
            $requete->execute(array($id));
            if($res = $requete->fetch()){
                return $res[0];
            }else{
               $res = array('');
               return $res;
            }
            
             
        }
    }
    