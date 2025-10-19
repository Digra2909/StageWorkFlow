<?php
session_start();
if(!isset($_SESSION['entreprise_id'])){
    header('location:../pages/connexion.php');
}
include('../config.php');
config::autoload(); 

// Données simulées reçues par POST (à remplacer par $_POST dans votre application réelle)
// NOTE: Utilisez $_POST en production, cet array est pour la démonstration du layout
$post_data = array(
    "tuteur" => "2", 
    "nom_etud" => "kidimba", 
    "dte" => "2025-10-19", 
    "id" => "14", 
    "objet" => "Ingéniorat", 
    "descriptions" => "ce stage de 4 mois avec un contrat cdi à la clé, il n", 
    "competences_offres" => "programmation, developpement", 
    "competence_etudiant" => "info", 
    "assigner" => ""
);

// Récupération des données du tuteur pour affichage
// Remplacer par la logique réelle pour obtenir le nom du tuteur
$tuteur_nom = "Tuteur ID: " . ($post_data['tuteur'] ?? 'Non défini'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Créer Fiche Stage</title>
</head>
<body class="bg-light">
    
    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4">
            
            <section class='container py-4'> 
                <div class="card shadow-lg p-4 bg-white border-0">
                    
                    <h2 class="text-dark fw-bold mb-3">
                        <i class="bi bi-file-earmark-text me-2"></i> Finaliser Fiche de Stage
                    </h2> 
                    
                    <hr class="text-secondary">
                    
                    <p class="text-secondary mb-4">
                        Veuillez confirmer les informations et définir les dates exactes du stage pour **<?= $post_data['nom_etud'] ?>**.
                    </p>
                    
                    <form action="../pages/root.php" method='POST'>
                        
                        <h4 class="text-dark fw-bold mb-3">
                            <i class="bi bi-person-fill me-2"></i> Informations Étudiant & Tuteur
                        </h4>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark">Tuteur Assigné</label>
                                <input type="text" value="<?= $tuteur_nom ?>" class="form-control bg-light" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark">Nom de l'Étudiant</label>
                                <input type="text" value="<?= $post_data['nom_etud'] ?> (Candidature du <?= $post_data['dte'] ?>)" class="form-control bg-light" readonly>
                            </div>
                        </div>
                        
                        <h4 class="text-dark fw-bold mb-3">
                            <i class="bi bi-card-text me-2"></i> Détails de l'Offre
                        </h4>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Objet du Stage</label>
                            <input type="text" value="<?= $post_data['objet'] ?>" class="form-control bg-light" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Description de l'Offre</label>
                            <textarea class="form-control bg-light" rows="3" readonly><?= $post_data['descriptions'] ?></textarea>
                        </div>
                        
                        <h4 class="text-dark fw-bold mb-3">
                            <i class="bi bi-tools me-2"></i> Compétences
                        </h4>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark">Compétences Offre</label>
                                <input type="text" value="<?= $post_data['competences_offres'] ?>" class="form-control bg-light" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-dark">Compétences Étudiant</label>
                                <input type="text" value="<?= $post_data['competence_etudiant'] ?>" class="form-control bg-light" readonly>
                            </div>
                        </div>
                        
                        <hr class="text-secondary my-4">

                        <h4 class="text-dark fw-bold mb-3">
                            <i class="bi bi-calendar-event me-2"></i> Définir les Dates du Stage
                        </h4>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="date_debut" class="form-label fw-bold text-dark">Date de Début du Stage *</label>
                                <input type="date" name='date_debut' id="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="date_fin" class="form-label fw-bold text-dark">Date de Fin du Stage *</label>
                                <input type="date" name='date_fin' id="date_fin" class="form-control" required>
                            </div>
                        </div>
                        
                        <input type="hidden" name='tuteur' value="<?= $post_data['tuteur'] ?>">
                        <input type="hidden" name='nom_etud' value="<?= $post_data['nom_etud'] ?>">
                        <input type="hidden" name='dte' value="<?= $post_data['dte'] ?>">
                        <input type="hidden" name='id_offre' value="<?= $post_data['id'] ?>">
                        <input type="hidden" name='objet' value="<?= $post_data['objet'] ?>">
                        <input type="hidden" name='descriptions' value="<?= $post_data['descriptions'] ?>">
                        <input type="hidden" name='competences_offres' value="<?= $post_data['competences_offres'] ?>">
                        <input type="hidden" name='competence_etudiant' value="<?= $post_data['competence_etudiant'] ?>">
                        <input type="hidden" name='assigner' value="true"> 
                        
                        <hr class="text-secondary my-4">

                        <button type="submit" name='creer_stage' class='btn btn-dark w-100 fw-bold'>
                            <i class="bi bi-check-circle-fill me-2"></i> Créer et Finaliser le Stage
                        </button>
                    </form>
                    
                </div>
            </section>
        </main>
    </div>
</body>
</html>