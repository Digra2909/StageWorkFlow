<?php
session_start();
if(!isset($_SESSION['entreprise_id'])){
    header('location:../pages/connexion.php');
}
include('../config.php');
config::autoload();
$entreprise_id = $_SESSION['entreprise_id'];
$listeTuteur = entreprise::toutTuteur($entreprise_id);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Gérer Tuteurs</title>
</head>
<body class="bg-light">
    
    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4">
            
            <h2 class="mb-4 text-dark fw-bold border-bottom pb-2">
                <i class="bi bi-person-lines-fill me-2"></i> Gérer les Tuteurs
            </h2> 

            <div class="row justify-content-center g-4">
                
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-lg p-4 bg-white border-0">
                        
                        <h3 class="text-center mb-4 text-dark fw-bold border-bottom pb-2">
                            ENREGISTREMENT <span class="text-secondary">TUTEUR</span>
                        </h3>
                        
                        <form action="../pages/root.php" method='POST' class="needs-validation" novalidate>
                            
                            <?php
                                if(isset($_GET['msg'])){
                                    echo '<div class="alert alert-info text-center mb-3" role="alert">'.$_GET['msg'].'</div>';
                                }
                            ?>
                            
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-person-fill"></i></span>
                                    <input class="form-control" type="text" name="nomTuteur" placeholder="Nom complet du tuteur" required>
                                    <input class="form-control " type="text" name="matricule" placeholder="Matricule tuteur" required>
                                    <input type="hidden" value='<?php echo $entreprise_id ?>' name='entreprise_id'>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark fw-bold" type="submit" name="enregTuteur">
                                    <i class="bi bi-person-plus-fill me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8">
                    <div class="card shadow-lg bg-white border-0">
                        <div class="card-header bg-dark text-white fw-bold">
                            <i class="bi bi-list-ul me-2"></i> Liste des Tuteurs Actifs
                        </div>
                        <div class="card-body p-0">
                             <div class="table-responsive"> 
                                <table class='table table-striped table-hover ed mb-0'>
                                    <thead class='table-light'>
                                        <tr>
                                            <th scope='col' class="text-dark">Identifiant</th>
                                            <th scope='col' class="text-dark">Nom</th>
                                            <th scope='col' class="text-dark">Matricule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if (empty($listeTuteur)) {
                                                echo '<tr><td colspan="2" class="text-center text-muted">Aucun tuteur enregistré.</td></tr>';
                                            } else {
                                                foreach($listeTuteur as $tuteur) { 
                                        ?>
                                        <tr>
                                            <td><?=$tuteur[0] ?></td>
                                            <td><?=$tuteur[1] ?></td>
                                            <td><?=$tuteur[2] ?></td>

                                        </tr>

                                        <?php 
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>