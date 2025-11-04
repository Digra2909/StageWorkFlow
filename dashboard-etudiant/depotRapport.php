<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
   <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Dépôt Rapport</title>
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
                                <i class="bi bi-file-earmark-arrow-up-fill me-2"></i> DÉPÔT <span class="text-secondary">DU RAPPORT</span>
                            </h3>
                            
                            <hr class="text-secondary">
                            
                            <p class="text-center text-secondary mb-4 small">
                                Veuillez joindre votre rapport de stage final et renseigner le mail du proffesseur      
                            </p>
                            
                            <?php
                                if(isset($_GET['msg'])){
                                    echo '<div class="alert alert-dark text-center mb-3" role="alert">'.$_GET['msg'].'</div>';
                                }
                            ?>
                            
                            <form action="../pages/root.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                
                                <div class="mb-4">
                                    <label for="rapportFile" class="form-label fw-bold text-dark">Rapport de Stage (Format PDF)*</label>
                                    <input class="form-control" type="file" id="rapportFile" name="rapport" accept=".pdf" required>
                                    <div class="form-text">Seul le format PDF est accepté.</div>
                                </div>
                                
                                
                                <input type="hidden" name="id_etud" value="<?php echo $_SESSION['id_etud']; ?>">
                                
                                
                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-dark fw-bold py-2" type="submit" name="depot_rapport">
                                        <i class="bi bi-upload me-2"></i> Déposer le Rapport
                                    </button>
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