<?php
require 'functions/functions.php';
date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");

/* Choix Utilisateur */
if (!empty($_GET['user'])){
  $user = ($_GET['user']);
}

/* Sélection fonctions */
if (!empty($_POST['tache'])){
      $ajout = array(
      "tache" => (nl2br(htmlspecialchars($_POST['tache']))),
      "user" => $user,
      "date" => $date);
    ajout_tache($ajout);
}elseif (isset($_POST['effacer'])){
    $id = ($_POST['id']); 
    delete_tache($id);
}elseif (isset($_POST['terminer'])){
    $id = ($_POST['id']);   
    terminer_tache($id);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>To Do List</title>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">

            <h4 class="text-center my-3 pb-3">To Do List</h4>
            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" method="GET">
              <div class="col-12">
                <div class="form-outline">
                  <input type="text" name="user" class="form-control" placeholder="<?=$user ?>"/>
                  <label class="form-label" for="form1">Utilisateur</label>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Valider</button>
              </div> 
            </form>

            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" method="POST">
              <div class="col-12">
                <div class="form-outline">
                  <input type="text" name="tache" class="form-control" />
                  <label class="form-label" for="form1">Nouvelle tâche</label>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
              </div>              
            </form>

            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Todo item</th>
                  <th scope="col">Statut</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $results = query($user);
                    foreach ($results as $k => $result) :?>
                    <tr>                   
                    <th scope="row"><?= $results[$k]['id'] ?></th>
                    <td><?= $results[$k]['tache'] ?></td>
                    <td><?= $results[$k]['statut'] ?></td>
                    <td>
                      <form method="POST">
                        <button type="submit" class="btn btn-danger" name="effacer">Effacer</button>
                        <button type="submit" class="btn btn-success ms-1" name="terminer">Terminé</button>
                        <input type="hidden" name="id" value="<?= $results[$k]['id'] ?>" />
                      </form>
                    </td>
                    </tr>
                <?php endforeach;?>                
              </tbody>
            </table>

          </div>
        </div> 
      </div>
    </div>
  </div>
</section>
    <footer>
        Créé par Johann
    </footer>
</body>
</html>