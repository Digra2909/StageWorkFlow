<?php
// PHP Logique pour savoir quelle est la page active (optionnel, mais recommandé)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end vh-100" style="width: 350px;">
    <a href="#" class="d-flex align-items-center mb-3 me-md-auto text-dark text-decoration-none border-bottom pb-3">
        <span class="fs-4 fw-bold">PROJET STAGE</span>
    </a>

    <ul class="nav nav-pills flex-column mb-auto">
        
        <li class="nav-item mb-1">
            <a href="index.php" class="nav-link 
                <?php echo ($current_page == 'index.php') ? 'active bg-dark text-white' : 'text-dark link-dark'; ?>" 
                aria-current="page">
                <i class="bi bi-speedometer2 me-2"></i>
                DASHBOARD <span class="fw-normal">ÉTUDIANT</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link text-dark link-dark">
                <i class="bi bi-search me-2"></i>
                Rechercher un stage
            </a>
        </li>
        <li class="nav-item">
            <a href="etat_candidature.php" class="nav-link text-dark link-dark">
                <i class="bi bi-search me-2"></i>
                Etat candidatures
            </a>
        </li>
        
        </ul>
    
    <div class="alert alert-light border p-2 my-3 small text-secondary">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cuumquam, obcaecati omnis vel aperiam eum esse.
    </div>

    <div class="mt-auto pt-3 border-top">
        <a href="../tuerSession.php" class="btn btn-outline-dark w-100">
            <i class="bi bi-box-arrow-right me-2"></i>
            Quitter
        </a>
    </div>

    <div class="text-center mt-2 pt-2 border-top small text-muted">
        &copy;smart tous droits réservés
    </div>
</header>