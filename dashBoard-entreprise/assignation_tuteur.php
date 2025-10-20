<?php
session_start();
if(!isset($_SESSION['entreprise_id'])){
    header('location:../pages/connexion.php');
}
include('../config.php');
config::autoload();
$listeCandidature = entreprise::toutCandidatureaceptte();
$listeTuteur = entreprise::toutTuteur($_SESSION['entreprise_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Assigner Tuteur</title>
</head>
<body class="bg-light"> 

    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4">
            
            <h2 class="mb-4 text-dark fw-bold border-bottom pb-2">
                <i class="bi bi-person-check-fill me-2"></i> Assignation des Tuteurs
            </h2>
            
            <p class="mb-4">
                <small class="text-secondary">
                    Ici est repris toutes les candidatures acceptées. Veuillez choisir un encadreur à assigner pour chaque 
                    candidature et appuyez ensuite sur **Assigner l'encadreur**.
                </small>
            </p> 

            <?php
                if(isset($_GET['msg'])){
                    // Utilisation d'une alerte Bootstrap moderne
                    echo' <div class="alert alert-info text-center" role="alert">'.$_GET['msg'].'</div>';
                }
                if(isset($_GET['msgStg'])){
                    // Utilisation d'une alerte Bootstrap moderne
                    echo' <div class="alert alert-info text-center" role="alert">'.$_GET['msgStg'].'</div>';
                }
            ?>
            
            <div class="row g-4">
                
                <?php
                    // Vérifier si la liste n'est pas vide
                    if (empty($listeCandidature)) {
                        echo '<div class="col-12"><div class="alert alert-secondary text-center" role="alert">';
                        echo '<i class="bi bi-x-octagon me-2"></i> Aucune candidature acceptée n\'est en attente d\'assignation.';
                        echo '</div></div>';
                    }

                    foreach ($listeCandidature as $valeur) {
                ?>      
                        <div class="col-md-12">
                            <form action="creer_stage.php" method='POST'>
                                <div class="card shadow-sm p-3 bg-white border-0">
                                    
                                    <div class="card-header bg-light border-bottom mb-3">
                                        <h5 class="mb-0 text-dark">
                                            <i class="bi bi-person-badge me-2"></i> Candidature de **<?=$valeur['nom_etud'] ?>**
                                        </h5>
                                        <small class="text-secondary">Soumise le <?=$valeur['dte'] ?></small>
                                    </div>
                                    
                                    <div class="card-body pt-0">
                                        
                                        <h6 class="text-dark mt-2 mb-3 fw-bold">Détails de l'Offre :</h6>
                                        <ul class="list-group list-group-flush mb-4">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <p class="mb-0 fw-semibold text-dark w-50">Numéro de stage :</p>
                                                <span class="text-end text-dark"><?=$valeur['id'] ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <p class="mb-0 fw-semibold text-dark w-50">Objet de l'offre :</p>
                                                <span class="text-end text-dark"><?=$valeur['objet'] ?></span>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="mb-0 fw-semibold text-dark">Description :</p>
                                                <p class="small text-secondary"><?=$valeur['descriptions'] ?></p>
                                            </li>
                                        </ul>
                                        
                                        <h6 class="text-dark mt-4 mb-3 fw-bold">Compétences :</h6>
                                        <ul class="list-group list-group-flush mb-4">
                                            <li class="list-group-item">
                                                <p class="mb-0 fw-semibold text-dark">Compétences requises :</p>
                                                <p class="small text-secondary"><?=$valeur['competences_offres'] ?></p>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="mb-0 fw-semibold text-dark">Compétences de l'étudiant :</p>
                                                <p class="small text-dark"><?=$valeur['competence_etudiant'] ?></p>
                                            </li>
                                        </ul>
                                        
                                        <hr class="my-4 text-secondary">

                                        <h6 class="text-dark mt-4 mb-3 fw-bold">
                                            <i class="bi bi-person-bounding-box me-2"></i> Choisir le Tuteur :
                                        </h6>
                                       
                                        <div class="mb-4">
                                            <?php if (empty($listeTuteur)) { ?>
                                                <div class="alert alert-warning small" role="alert">
                                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Aucun tuteur disponible. Veuillez en enregistrer un avant d'assigner.
                                                </div>
                                            <?php } else { ?>
                                                <select name="tuteur" class="form-select form-control" required>
                                                    <option value="">Sélectionner un tuteur...</option>
                                                    <?php
                                                        foreach($listeTuteur as $tuteur) {
                                                    ?>
                                                        <option value="<?=$tuteur['id'] ?>"><?php echo $tuteur['nomTuteur'] ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                        
                                        <input type="hidden" name='nom_etud' value='<?=$valeur['nom_etud'] ?>'>
                                        <input type="hidden" name='dte' value='<?=$valeur['dte'] ?>'>
                                        <input type="hidden" name='id' value='<?=$valeur['id'] ?>'>
                                        <input type="hidden" name='objet' value='<?=$valeur['objet'] ?>'>
                                        <input type="hidden" name='descriptions' value='<?=$valeur['descriptions'] ?>'>
                                        <input type="hidden" name='competences_offres' value='<?=$valeur['competences_offres'] ?>'>
                                        <input type="hidden" name='competence_etudiant' value='<?=$valeur['competence_etudiant'] ?>'>
                                        <input type="hidden" name='nomTuteur' value='<?=$tuteur['nomTuteur'] ?>'>
                                        <input type="hidden" name='idTuteur' value='<?=$tuteur['id'] ?>'>
                                        <input type="hidden" name='id_etud' value='<?=$valeur['id_etud'] ?>'>
                                        <button class="btn btn-dark w-100 fw-bold mt-2" name="assigner" type="submit" 
                                            <?php echo empty($listeTuteur) ? 'disabled' : ''; // Désactiver si pas de tuteur ?>>
                                            <i class="bi bi-person-fill-up me-2"></i> Assigner l'encadreur
                                        </button>
                                        
                                        <small class='d-block text-center mt-2 text-secondary'>
                                            Une fois validé, vous serez dirigé vers l'interface de création de stage.
                                        </small>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                <?php
                    }
                ?>
            </div>
        </main>
    </div>
</body>
</html>