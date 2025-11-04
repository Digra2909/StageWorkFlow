<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/logo.PNG" type="favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>Connexion</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    
    <section class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-6 col-lg-4">
                
                <div class="card shadow-lg p-4 bg-white border-0">
                    
                    <?php
                        if(isset($_GET['msg'])){
                            echo '<div class="alert alert-info text-center" role="alert">'.$_GET['msg'].'</div>';
                        }else if(isset($_GET['msg2'])){
                            echo '<div class="alert alert-danger text-center" role="alert">'.$_GET['msg2'].'</div>';
                        }
                    ?>
                    
                    <form action="root.php" method="POST">
                        <h2 class="text-center mb-4 text-dark fw-bold">CONNEXION</h2>
                        
                        <div class="mb-3">
                            <label for="pseudo" class="form-label visually-hidden">Pseudo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" autocomplete="off" name="pseudo" id="pseudo" placeholder="votre pseudo" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mdp" class="form-label visually-hidden">Mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" autocomplete="off" name="mdp" id="mdp" placeholder="votre mot de passe" required>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <button name="cnx" class="btn btn-dark text-white fw-bold" type="submit">Se connecter</button>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a class="btn btn-outline-dark" href="choix.php">Créer un compte</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>