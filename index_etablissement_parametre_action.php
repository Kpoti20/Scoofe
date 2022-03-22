<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
 if(isset($_POST['valider']))
    {
            $id=$_POST['code'];
            $pe = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $mdp = $_POST['mdp'];
  if(!empty($pe) AND !empty($mail) AND !empty($mdp))
  {
    $pselength = strlen($pe);
        if($pselength <= 25)
       {
        if(preg_match("/^[a-zA-Z ]*$/",$pe))
        {
          if(filter_var($mail,FILTER_VALIDATE_EMAIL))
          {
            $reqenre=$bdd->prepare("SELECT * FROM etablissement WHERE pseudo = ? and mail = ? ");
            $reqenre->execute(array($pe,$mail));
            $enregistrexist =$reqenre->rowcount();
            if($enregistrexist == 0)
            { 
              $_update = $bdd->prepare("UPDATE etablissement SET pseudo='$pe', mail='$mail', motdepasse='$mdp' WHERE id=$id ");
              $_update->execute();
              $erreur="Modification effectuée avec succes! ";
               } 
            else
            {
              $erreur="ATTENTION !!! Risque de doublon un enregistrement deja effectué correspond avec cette modification";
            }
          }
          else
          {
            $erreur="L'adresse mail n'est pas valide!";
          }
        }
        else
        {
          $erreur = "Seuls les caractères alphabetiques sont autorisés pour le pseudo";
        }
      }
      else
      {
        $erreur = "Le pseudo ne dois pas depasser 25 caracteres!!!";
      }
    
  
  }
  else
  {
    $erreur = "veuillez remplir tous les champs!";
  }
          }


          if(isset($_POST['supprimer']))
           {
           $id=$_POST['code'];
           if ( ($_SESSION['id']) != $id) {
                $_delete = $bdd->prepare("DELETE  FROM etablissement WHERE id=$id");
             $_delete->execute();
             $erreur="Suppression effectuée avec succes! ";
           }else{
             $erreur="Suppression impossible car ce compte est en cour d'utilisation. Connectez-vous avec un autre compte pour effectuer cette operation.";
           }
           }
?>
<!DOCTYPE html>
<html>
<title>COPEGENE Etablissement</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="font-awesome.min.css">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="jquery.min.js"></script>
<script src="bootstrap.min.js"></script>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {font-weight:bold}
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
    background-color: #9E9E9E;
    color: black;
}
.w3-btn {width:150px;}

</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<?php 
      include_once 'index_etablissement_parametre_action.php';
    ?>
<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding" title="close menu">
      <i class="fa fa-remove"></i>
    </a> 
    <img src="w3images/avatar_g2.jpg" style="width:45%;" class="w3-circle"><br><br>
    <h4 class="w3-padding-0"><b>Profil de <?php echo $_SESSION['pseudot']; ?></b></h4>
    <p class="w3-text-grey"></p>
   
  </div>
  <a href="#portfolio" onclick="w3_close()" class="w3-padding w3-text-teal"><i class="fa fa fa-info-circle fa-fw w3-margin-right"></i>INFORMATION</a> 
  <a href="#about" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>MESSAGE</a> 
  <!--<a href="#contact" onclick="w3_close()" class="w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>-->
  <a href="index_etablissement_etudiant.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-user fa-fw w3-margin-right"></i>ETUDIANTS</a>
  <a href="index_etablissement_filiere.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa-mortar-board fa-fw w3-margin-right"></i>FILIERES</a>
  <a href="index_etablissement_matiere.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-book fa-fw w3-margin-right"></i>MATIERES</a>
  <a href="index_etablissement_professeur.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-book fa-fw w3-margin-right"></i>PROFESSEUR</a>
  <a href="index_etablissement_cours.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-calendar fa-fw w3-margin-right"></i>SEANCES DE COURS</a>
   <a href="index_etablissement_controle_presence.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa  fa fa-check-square-o fa-fw w3-margin-right"></i>CONTROLE DE PRESENCE</a>
   <a href="index_etablissement_notes.php?id=<?php echo ($_SESSION['id']);?>" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-edit w3-margin-right"></i>GESTION DES NOTES</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-bar-chart-o w3-margin-right"></i>STATISTIQUES</a>
   <a href="#" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-cog w3-margin-right"></i>PARAMETRES</a>
   <a href="deconnexion.php" onclick="w3_close()" class="w3-padding"><i class="fa fa fa-sign-out w3-margin-right"></i>DECONNEXION</a>
  <div class="w3-section w3-padding-top w3-large">
    <a href="#" class="w3-hover-white w3-hover-text-indigo w3-show-inline-block"><i class="fa fa-facebook-official"></i></a>
    <a href="#" class="w3-hover-white w3-hover-text-purple w3-show-inline-block"><i class="fa fa-instagram"></i></a>
    <a href="#" class="w3-hover-white w3-hover-text-yellow w3-show-inline-block"><i class="fa fa-snapchat"></i></a>
   
  </div>
</nav>

<!-- Overlay effect when opening sidenav on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:290px">

  <!-- Header -->
  
  <header class="w3-container" id="portfolio">
    <a href="#"><img src="w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-opennav w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    
    <!--<div class="w3-section  w3-padding-8">
     <!-- <span class="w3-margin-right">Filieres:</span> -->
     <!-- <button class="w3-btn">ALL</button>-->
      <!--<button class="w3-btn w3-white"><i class="fa fa-diamond w3-margin-right"></i>Design</button>
      <button class="w3-btn w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
      <button class="w3-btn w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button>-->
    <!--</div> -->
  </header>
  <div class="w3-panel w3-margin-bottom w3-white" style="width:1230px; height: 800px;">
   <?php   
            $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
            $id=$_GET['id'];
            $_select = $bdd->prepare("SELECT * FROM etablissement WHERE id=$id ");
            $_select->execute();
            while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
          ?>  
    <div class="w3-container w3-grey">
  <h2>Modification des parametres de connexion de :  <?php echo $s->pseudo;?></h2>
</div>
<br/>
 <form method="POST" action="">
    
            <p>
          <input type="hidden"  value="<?php echo $s->id; ?>" readonly="true" name="code">
          <label>Pseudo</label>
          <input class="w3-input" value="<?php echo $s->pseudo;?>" autocomplete="off" name="pseudo" type="text"></p>
          <p>
          <label>Mail</label>
          <input class="w3-input" value="<?php echo $s->mail;?>" autocomplete="off" name="mail" type="mail"></p>
          <p>
          <label>Mot de passe</label>
          <input class="w3-input" value="<?php echo $s->motdepasse;?>" autocomplete="off" name="mdp" type="password"></p>
          
              <button  type="submit" class="btn btn-success" name="valider" >Modifier</button>
  
</form><br/>
<?php 
      }
        ?>
    <br/><br/>
   <?php   
            $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolarite1','root', '');
             $id=$_GET['id'];
            $_select = $bdd->prepare("SELECT * FROM etablissement WHERE id=$id");
            $_select->execute();
            while ($z=$_select->fetch(PDO::FETCH_OBJ)) {
          ?>  
     
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Suppression de la filiere : <?php echo $z->NomFil;?> </i></h2>
    <p style="margin-left:15px;">
      A moins que vous ne trouviez plus l'importance de ce compte dans la liste des utilisateurs, vous avez la possibilité de <a href="#demo" style="text-decoration:none; cursor:pointer;" data-toggle="collapse">supprimer le compte en question</a>
    </p>
    <div id="demo" style="margin-left:15px;" class="collapse">
    Voulez-vous réellement supprimer ce compte : <?php echo $z->pseudo; ?> ?
      <form method="POST" action="">
        <input type="hidden"  value="<?php echo $z->id; ?>" readonly="true" name="code">
        <button type="submit" class="btn btn-danger" style="margin-left:15px;" name="supprimer" >Supprimer</button>
      </form>
  </div>
 <br/><br><br><br><br><br>
 <?php
      }
 ?>
        
     
  <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
  <p class="w3-medium" style="margin-left:800px;"><b><i class="fa fa fa-arrow-left fa-fw w3-margin-right w3-text-teal"></i><a href="index_etablissement_parametre.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-2" style="text-decoration:none;">Retour Parametre</a></b></p>
  

</div>  

 
   
   
      
     
     
  
   

 
  
  <div  class="w3-black w3-center w3-padding-24">Powered by <a href="default.html" title="W3.CSS"  class="w3-hover-opacity">Joel AHOLOU</a></div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidenav
function w3_open() {
    document.getElementById("mySidenav").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_portfolio&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 15:08:53 GMT -->
</html>

