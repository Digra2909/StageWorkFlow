<?php
session_start();
if(!isset($_SESSION['entreprise_id'])){
    header('location:../pages/connexion.php');
}
include('../config.php');
config::autoload(); 

$entreprise_id = $_SESSION['entreprise_id'] ?? '';
$state_valid = $_SESSION['state_valide'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Publier une Offre</title>
</head>
<body class="bg-light">
    
    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4">
            
            <section class='container py-4'> 
                <div class="card shadow-lg p-4 bg-white border-0">
                    
                    <?php
                        // Affichage du message
                        if(isset($_GET['msg'])){
                            echo' <div class="alert alert-info text-center" role="alert">'.$_GET['msg'].'</div>';
                        }
                    ?>
                    
                    <h2 class="text-dark fw-bold mb-3">
                        <i class="bi bi-journal-plus me-2"></i> Publier une offre de stage
                    </h2> 
                    
                    <hr class="text-secondary">
                    
                    <p class="lead text-dark">
                        Bienvenue ! 
                        <span class='fw-bold text-dark'> <?php echo $_SESSION['name'] ?? 'Utilisateur'; ?> </span>
                    </p>
                    <p class="text-secondary mb-4">
                        Vous êtes dans le portail qui vous permet de publier un stage sur la plateforme **Stageworkflow**. 
                        Renseignez les champs ci-dessous pour soumettre votre offre à validation.
                    </p>
                    
                    <form action="../pages/root.php" method='POST'>
                        
                        <div class="mb-3">
                            <input type="text" placeholder='Titre de stage' name='titre' class='form-control' autocomplete='off' required>
                        </div>

                        <div class="mb-3">
                            <textarea name="descript" rows="5" class='form-control' placeholder='Description du stage' required></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <input type="text" placeholder='Compétences requises (ex: PHP, MySQL, Design)' name='competence' class='form-control' autocomplete='off' required>
                        </div>
                        
                        <input type="hidden" value="<?php echo $entreprise_id; ?>" name='id'>
                        <input type="hidden" value="<?php echo $state_valid; ?>" name='state'>
                        
                        <button type="submit" name='poster' class='btn btn-dark w-100 fw-bold'>
                            <i class="bi bi-upload me-2"></i> Publier l'offre
                        </button>
                    </form>
                    
                </div>
            </section>
        </main>
    </div>
</body>
</html>