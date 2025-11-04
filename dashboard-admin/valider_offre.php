<?php
    include('../config.php');
    config::autoload();
    $listeOffre1 = users::toutOffre();  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <title>header</title>
</head>
<body id='b-ajE' class='' >
    
    <?php require('header.php'); ?>
    <section class='w-50 m-auto p-4'> 
        <h3><b>Validation <span >OFFRE DE STAGE</span></h3>
        <hr>
        <div>
            <p>Sélectionner l'offre de stage à valider et cliquer sur valider pour modifier son statut </p>
            
        </div>

        
        <hr>
        
        <form id='formA' class='form-group' action="../pages/root.php" method='POST'>
            <?php
                    if(isset($_GET['msg'])){
                        echo' <p class="form-control text-light btn btn-success">'.$_GET['msg'].'</p>';
                    }                
            ?>
            <div>
                <select class='form-control w-100' name="ese" id="">
                    <?php  foreach($listeOffre1 as $offre){ ?>
                        <option  value="<?php echo $offre['id'] ?>" ><?php echo $offre[1] ?></option>
                    <?php }    ?>
                </select>
                <input type="submit" name='ValideOffre' value="valider" class='form-control btn orange'>
            </div>
            
        </form>

        <h4 class='mt-4 text-dark'>LISTE DES OFFRES AVEC STATUT </h4>
        <table class='table table-striped table-bordered  table-light table-hover ed mt-4'>
            <tfoot></tfoot>
            <thead class='sticky-top'>
                <tr>
                    <th scope='col'>nom</th>
                    <th scope='col'>secteur</th>
                    <th scope='col'>adresse</th>
                    <th scope='col'>email</th>
                    <th scope='col'>statut validation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listeOffre1 as $S) { ?>
               
                <tr>
                    <td><?=$S[1] ?></td>
                    <td><?=$S[2] ?></td>
                    <td><?=$S[3] ?></td>
                    <td><?=$S[4] ?></td>
                    <td><?=$S[5] ?></td>
                </tr>

                <?php }    ?>
            </tbody>
        </table>
        
    </section>
</body>
</html>

