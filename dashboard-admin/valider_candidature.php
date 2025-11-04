<?php
    include('../config.php');
    config::autoload();
    $listeCandidature = users::toutCandidature();  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <title>Valider Candidatures</title>
</head>
<body id='b-ajE' class='text-dark ' >
    
    <?php require('header.php'); ?>
    <section class=' w-50 m-auto text-dark p-4'> 
        <h3><b>Validation <span >CANDIDATURES</span></h3>
        <hr>
        <div>
            <p>Sélectionner la candidature à valider et cliquer sur valider pour modifier son statut </p>
            
        </div>

        
        <hr>
        
        <form id='formA' class='form-group' action="../pages/root.php" method='POST'>
            <?php
                    if(isset($_GET['msg'])){
                        echo' <p class="form-control text-light btn btn-success">'.$_GET['msg'].'</p>';
                    }                
            ?>
            <div>
                <select class='form-control w-100' name="candidature" id="">
                    <?php  foreach($listeCandidature as $candidature){ ?>
                        <option  value="<?php echo $candidature['id_cand'] ?>" ><?php echo $candidature[3] ?></option>
                    <?php }    ?>
                </select>
                <input type="submit" name='ValiderCandidature' value="valider" class='form-control btn orange'>
            </div>
            
        </form>

        <h4 class='mt-4 text-dark'>LISTE DES CANDIDATURES AVEC STATUT </h4>
        <table class='table table-striped table-bordered  table-light table-hover ed mt-4'>
            <tfoot></tfoot>
            <thead class='sticky-top'>
                <tr>
                    <th scope='col'>Nom étudiant</th>
                    <th scope='col'>Nom entreprise</th>
                    <th scope='col'>Titre offre</th>
                    <th scope='col'>Statut candidatue</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listeCandidature as $S) { ?>
               
                <tr>
                    <td><?=$S[1] ?></td>
                    <td><?=$S[2] ?></td>
                    <td><?=$S[3] ?></td>
                    <td><?=$S[4] ?></td>
                </tr>

                <?php }    ?>
            </tbody>
        </table>
        
    </section>
</body>
</html>

