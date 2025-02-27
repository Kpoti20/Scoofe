<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  if(isset($_SESSION['id']) and !empty($_SESSION['id']))
  {
    $msg = $bdd->prepare('SELECT * from message where id_destinataire = ?');
    $msg->execute(array($_SESSION['id']));
    $msg_nbr = $msg->rowCount();
  }
if (isset($_GET['id'])) 
  {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM tuteur WHERE id = ? ');
    $requser->execute(array($getid));
    $userinfotuteur=$requser->fetch(); 
    $_SESSION['id'] = $userinfotuteur['id'];
    $_SESSION['pseudo']= $userinfotuteur['pseudo'];
    $_SESSION['mail']= $userinfotuteur['mail'];
?>
<!DOCTYPE html>
<html>
<title>Compte parent Boite de Reception</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="font-awesome.min.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}

.tap {
    width: 30px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    margin-left: 15px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

.tap:focus {
    width: 50%;
}
table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #009688;
    color: white;
}
  .button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
}
  .button2 {background-color: teal;}
  .button3 {background-color: #B20808;} /* Red */ 
    a{
      cursor: pointer;
      text-decoration:none;
   }
</style>
<body class="w3-light-grey">
<?php 
      include_once 'index_parent_reception.php';
    ?>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="w3images/avatar5.png" style="width:100%;" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            
           <h2>Profil de <?php echo $userinfotuteur['pseudo']; ?></h2>
              <br/><br/>
             Pseudo = <?php echo $userinfotuteur['pseudo']; ?>
              <br/>
              Mail = <?php echo $userinfotuteur['mail']; ?>
                <?php
                  if (isset($_SESSION['id']) AND $userinfotuteur['id'] == $_SESSION['id']) {
                  
                    ?>
                          </div>
        </div>
        <div class="w3-container">
        <br/>
      

          <!--<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Setting</a></b></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Media</a></p>-->
         
         <p class="w3-small"><b><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-text-teal"></i><a href="index_parent_reception.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Evolution du payement d'un étudiant</a></b></p>
         <hr>
         <p class="w3-small"><b><i class="fa fa-gear fa-fw w3-margin-right w3-text-teal"></i><a href="index_parent_parametre.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Paramètres</a></b></p>
         <p class="w3-small"><b><i class="fa fa-sign-out fa-fw w3-margin-right w3-text-teal"></i><a href="decon.php" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Déconnexion</a></b></p>
          <?php
                    }
                    ?>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card-2  w3-margin-bottom">
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Boite de Reception</i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
            <br/>
            <?php 
                if($msg_nbr == 0) { echo "Vous n'avez aucun message... ";}
                while($m = $msg->fetch()) { 
                  $p_exp = $bdd->prepare('SELECT * from etablissement where id = ?');
                  $p_exp->execute(array($m['id_expediteur']));
                  $p_exp = $p_exp->fetch();
                  $p_exp = $p_exp['pseudo'];
                ?>  
                <?= $p_exp ?><b> vous a envoyé : <br/>
                <?= nl2br($m['message']) ?><br/>
                ----------------------------------------------<br/>
                Ce message est envoyé automatiquement par notre site Internet. Merci de ne pas y répondre ; aucune suite ne serait donnée.<br/><br/>
                <?php } ?>
          </div>
</div>
        </div>
        </div>

     <!-- <div class="w3-container w3-card-2 ">
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des parents</i></h2>
    <?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
    $search="";
    if (isset($_POST['search'])) {
      $search=$_POST['search'];
      $_select = $bdd->prepare("SELECT * FROM tuteur WHERE nom like '%$search%' or prenom like '%$search%' or mail like '%$search%' ");
    } else {
      $_select = $bdd->prepare("SELECT * FROM tuteur order by id desc");
    }
    
    $_select->execute();
    ?>

<form method="POST" action="">
  
  <div class="input-group">
   <label for="choix" style="margin-left:15px;">Rechercher par </label>
    <select class=""  style="width:150px; margin-left:15px;" name="choix">
      <option value="">Nom</option>
      <option value="">Prénom</option>
      <option value="">Email</option>
    </select><br/><br/>
    <input type="text" class="form-control" style="margin-left:15px; " name="search" value="<?php if (isset($search)) {echo ($search);} ?>" placeholder="Search..">
    <div class="input-group-btn">
      <button class="btn btn-default" style="margin-right:300px; margin-top:45px;" type="submit">
        <i class="fa fa-search fa-fw w3-margin-right w3-text-teal" style="margin-left:5px;" ></i>
      </button>
    </div>
  </div>
</form>
<br/>
        <div class="container">
                                                                                        
  <div class="table-responsive ">

  <table style="width:820px;">
    <thead>
      <tr>
        <th>ID Parent</th>        
        <th>Nom Parent</th>
        <th>Prénom(s) Parent</th>
        <th>Email Parent</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>

     <?php  while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
?>    
      <tr>
        <td><?php echo $s->id;?></td>
        <td><?php echo $s->nom;?></td>
        <td><?php echo $s->prenom;?></td>
        <td><?php echo $s->mail;?></td>
        <td>
          <a href="etablissement_parent_action.php?id=<?php echo $s->id;?>" target="_parent"  style="text-decoration:none;">Modifier</a>
        </td>
      </tr> 
          <?php

    }
    ?>
         
<!Fin Formulaire de suppression-->
</div>
      
     
    </tbody>
  </table>
  </div><br/>
</div>
        
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Find me on social media.</p>
  <i class="fa fa-facebook-official w3-hover-text-indigo w3-large"></i>
  <i class="fa fa-instagram w3-hover-text-purple w3-large"></i>
  <i class="fa fa-snapchat w3-hover-text-yellow w3-large"></i>
  <i class="fa fa-pinterest-p w3-hover-text-red w3-large"></i>
  <i class="fa fa-twitter w3-hover-text-light-blue w3-large"></i>
  <i class="fa fa-linkedin w3-hover-text-indigo w3-large"></i>
  <p>Powered by <a href="default.html" target="_blank">w3.css</a></p>
</footer>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_cv&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 15:08:10 GMT -->
</html>
<?php

  }else{
    echo "Desole";
  }
?>