<?php


    require_once '../config.php';
    config::autoload();
    config::nettoyerPost();

    
    function checkMdp($mot_de_passe1,$mot_de_passe2){
        if ($mot_de_passe1 === $mot_de_passe2){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function redirection($url){
        header('location:'.$url);
    }


    if(isset($_POST['cnx'])){
        if($testTuteur = enseignant::cnxEnseignant(array($_POST['pseudo'],$_POST['mdp']))){
            $_SESSION['idTuteur'] = $testTuteur[0]; 
            redirection('../tableau_de_bord_enseignant/suivi.php');
        }else{
            if($testTuteur = entreprise::cnxTuteur(array($_POST['pseudo'],$_POST['mdp']))){
                    
                        session_start();
                        $_SESSION['idTuteur'] = $testTuteur[0]; 
                        redirection('evaluation.php');
                
                    }else{

                        $reponse = users::authentificationAdmin(array($_POST['pseudo'],$_POST['mdp']));
                    
                        if ($reponse) {

                            $_SESSION['name'] = $_POST['pseudo'];
                            header('location:../dashboard-admin');
                        
                        }else{
                            
                            $user1 = new users($_POST['pseudo'],$_POST['mdp']);
                            $retour = $user1->authentification();
                            if (count($retour) >= 2) {
                            
                                
                                if($retour[0]=='etudiant'){
                                
                                    $_SESSION['id']= $retour[1];
                                    $_SESSION['id_etud']= $retour[2];
                                    $_SESSION['name']= $_POST['pseudo'];
                                
                                header("location:../dashboard-etudiant/");
                            
                                }else if($retour[0]=='entreprise'){
                                
                                    $_SESSION['name']= $_POST['pseudo'];
                                    $_SESSION['entreprise_id']= $retour[1];
                                    $_SESSION['user_id']= $retour[2];
                                    $_SESSION['state_valide']= $retour[3];

                                    header("location:../dashBoard-entreprise/");
                                }    # code...
                            }else{
                                
                                header('location:../pages/connexion.php?msg2=Réessyez!');

                            }
                        }
                }
        }        
        
    }
    if (isset($_POST['env'])) {


        if(!checkMdp($_POST['mdp1'],$_POST['mdp2'])){
            header("location:../dashboard-etudiant/inscription.php?msg=les mots de passe sont différents");
        }else{
            etudiants::AjouterProfil(array($_POST['nom'],$_POST['promo'],$_FILES['cv'],$_POST['comp'],$_POST['mdp1']));
            header('location:../pages/connexion.php?msg=Inscription effectué !');
        }

    }
    if (isset($_POST['valider'])) {

            entreprise::validationEntreprise(array($_POST['ese']));
            header('location:../dashboard-admin');

    }

        if (isset($_POST['envoi2'])) {
            $data = array($_POST['rs'],$_POST['sec'],$_POST['adr'],$_POST['email'],$_POST['mdpa'],$_POST['mdpb']);

            if(!checkMdp($data[4],$data[5])){
                header("location:../dashBoard-entreprise/inscriptionEse.php?msg=les mots de passe sont différents");
            }else{
                array_pop($data);
                entreprise::AjouterEntreprise($data);
                header('location:../pages/connexion.php?msg=Inscription effectué !');
            }

    }
    if(isset($_POST['poster'])){
        if($_POST['state']=='en attente'){
            header("location:../dashBoard-entreprise/index.php?msg=vous ne pouvez pas publié votre compte est en attente de validation");    
        }else if($_POST['state'] == 'validée'){
            $data = array($_POST['titre'],$_POST['descript'],$_POST['competence'],date('Y-m-d'),$_POST['id']);
            entreprise :: PublierStage($data); 
            header("location:../dashBoard-entreprise/index.php?msg=offre publié statut en attente");
        }

        

    }
    if(isset($_POST['rech'])){
            etudiant::rechercherOffre(array($_POST['rech']));
            header("location:../dashboard-etudiant/inscription.php");
    }
    
    if(isset($_POST['ValideOffre'])){
        //var_dump($_POST['ese']);exit;
        users::Valider_offre(array($_POST['ese']));
        header("location:../dashboard-admin/valider_offre.php?msg=offre validée");
    }
    if(isset($_POST['postuler'])){
        etudiants::postuler([$_POST['id_offre'],$_POST['id_etud']]);
        header('location:../dashboard-etudiant/index.php?msg=candidature en attente de validation');
    }
    if(isset($_POST['ValiderCandidature'])){
        //var_dump($_POST['ese']);exit;
        users::Valider_candidature($_POST['candidature']);
        header("location:../dashboard-admin/valider_candidature.php?msg=candidature validée");
    }
    if(isset($_POST['accept_candidature'])){
       entreprise::accepterCandidature($_POST['idCand']);
       header('location:../dashBoard-entreprise/voir_candidature.php?msg=candidature acceptée'); 
    }
    if(isset($_POST['refuse_candidature'])){
       entreprise::refuse_candidature($_POST['idCand']);
       header('location:../dashBoard-entreprise/voir_candidature.php?msg=candidature refusée'); 
    }
    if(isset($_POST['annuler_candidature'])){
        etudiants::annuler_candidature($_POST['candidature']);
        header('location:../dashboard-etudiant/etat_candidature.php?msg=candidature annulée'); 
    }
    if(isset($_POST['enregTuteur'])){
        entreprise::enregTuteur(array($_POST['nomTuteur'],$_POST['matricule'],$_POST["entreprise_id"]));
        header('location:../dashBoard-entreprise/enregistrer_tuteur.php?msg=tuteur enregistré');
    }
    if(isset($_POST['assigner'])){
        $stage = $_POST;
        header('location:../dashBoard-entreprise/creer_stage.php?donnee='.$stage);

    }
    if(isset($_POST['creer_stage'])){
        $data = [$_POST['date_debut'],$_POST['date_fin'],$_POST['tuteur'],$_POST['entreprise_id'],$_POST['etud']];
        $offre = $_POST['id_offre'];
        entreprise::creer_stage($data);
        entreprise::offrePourvue($offre);
        header('location:../dashBoard-entreprise/assignation_tuteur.php?msgStg=stage pris en compte');

    }
    if(isset($_POST['inscEnseignant'])){
        if(checkMdp($_POST['mdpa'],$_POST['mdpb'])){
            $retour = enseignant::inscription(array($_POST['nom'],$_POST['cours'],$_POST['mail'],$_POST['mdpa']));
            if($retour){redirection('connexion.php?msg=inscrption effectuée !');}
        }else{
            redirection("../tableau_de_bord_enseignant/inscription.php?msg=les mots de passe sont différents");

        }
    }
    if(isset($_POST['enregEva'])){
        $data = array(
                                            $_POST['connaissance_professionelles'],
                                            $_POST["rendement"],
                                            $_POST["esprit_initiative"],
                                            $_POST["ponctualite_ordre_discioline"],
                                            $_POST["collaboration_travail_equipe"],
                                            $_POST["conscience_prof"],
                                            $_POST["comportement_generale"],
                                            $_POST["idTuteur"],
                                            $_POST["id_etudiant"],
                                            $_POST["id_stage"]
        );
        entreprise::evaluerStagiaire($data);
        redirection('evaluation.php?msg=stagiaire évalué');

    }
    
