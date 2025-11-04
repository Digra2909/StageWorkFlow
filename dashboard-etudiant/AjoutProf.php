<?php
    session_start();

    if(!isset($_SESSION['name'])){
        header('location:../pages/connexion.php');
    }
    // // Inclure les configurations si la page en a besoin
    include('../config.php'); 
    config::autoload();
    
    // // NOTE: RÃ©cupÃ©ration de l'ID nÃ©cessaire pour le champ cachÃ©
    // $id_etudiant = $_SESSION['idEtudiant'] ?? 'N/A';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Saisie E-mail Professeur</title>
</head>
<body class="bg-light"> 

    <div class="d-flex min-vh-100">
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4 d-flex align-items-center justify-content-center">
            
            <section class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-md-9 col-lg-7"> 
                        
                        <div class="card shadow-lg p-5 bg-white border-0">
                            
                            <h3 class="text-center mb-4 text-dark fw-bold">
                                CONTACT <span class="text-secondary">ENSEIGNANT</span>
                            </h3>
                            
                            <hr class="text-secondary">
                            
                            <p class="text-center text-secondary mb-4 small">
                                Veuillez renseigner l'adresse e-mail de votre professeur encadreur.
                            </p>
                            
                            <?php
                                // Si besoin d'afficher un message
                                if(isset($_GET['msg'])){
                                    echo '<div class="alert alert-info text-center mb-3" role="alert">'.$_GET['msg'].'</div>';
                                }
                            ?>
                            
                            <form action="../pages/root.php" method="POST" class="needs-validation" novalidate>
                                
                                <div class="mb-4">
                                    <label for="profEmailInput" class="form-label fw-bold text-dark">E-mail du Professeur *</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-dark"><i class="bi bi-person-vcard"></i></span>
                                        <input class="form-control" type="email" id="profEmailInput" name="email_professeur" placeholder="professeur@universite.com" required>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="id_etudiant" value="<?php echo $_SESSION['id_etud'] ?? 'N/A'; ?>"> 
                                
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-dark fw-bold py-2" type="submit" name="enregistrer_email_prof">
                                        <i class="bi bi-send-fill me-2"></i> Enregistrer
                                    </button>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <a href="../pages/tableau_de_bord.php" class="text-dark text-decoration-none small fw-semibold">
                                        <i class="bi bi-arrow-left me-1"></i> Retour au tableau de bord
                                    </a>
                                </div>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html> 