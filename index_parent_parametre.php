<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  if(isset($_POST['valider']))
    {
            $id=$_POST['code'];
            $no= $_POST['nom'];
            $pe = $_POST['pe'];
            $mail = $_POST['mail'];
  if(!empty($no) AND !empty($pe) AND !empty($mail))
  {
    $nomlength = strlen($no);
    $prenomlength = strlen($pe);
    //$pseudo = test_input($_POST["pseudo"]);
    if($nomlength <= 30)
    {
      if (preg_match("/^[a-zA-Z ]*$/",$no)) 
      {
        if($prenomlength <= 35)
       {
        if(preg_match("/^[a-zA-Z ]*$/",$pe))
        {
          if(filter_var($mail,FILTER_VALIDATE_EMAIL))
          {
            $reqenre=$bdd->prepare("SELECT * FROM tuteur WHERE nom = ? and prenom = ? and mail = ? ");
            $reqenre->execute(array($no,$pe,$mail));
            $enregistrexist =$reqenre->rowcount();
            if($enregistrexist == 0)
            { 
              $_update = $bdd->prepare("UPDATE tuteur SET nom='$no', prenom='$pe', mail='$mail' WHERE id=$id ");
              $_update->execute();
              $erreur="Modification effectuée avec succes! ";

              $up = $bdd->prepare("UPDATE tuteur SET p1=(SELECT substr(nom,1,3) ) , P2=(SELECT substr(prenom,1,3) ) , pseudo=(SELECT concat(p1,'',p2)) , motdepasse=sha1((SELECT concat(p1,'',p2))) where id=(SELECT MAX(id) )");
                $up->execute();
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
          $erreur = "Seuls les caractères alphabetiques sont autorisés pour le prenom";
        }
      }
      else
      {
        $erreur = "Le prenom ne dois pas depasser 35 caracteres!!!";
      }
    }else
    {
      $erreur="Seuls les caractères alphabetiques sont autorisés pour le nom";
    }  
  }else
    {
      $erreur="Le nom ne dois pas depasser 30 caracteres!!!";
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
           $_delete = $bdd->prepare("DELETE  FROM tuteur WHERE id=$id");
           $_delete->execute();
           $erreur="Suppression effectuée avec succes! ";
           }

?>
<!DOCTYPE html>
<html>
<title>Parent Action</title>
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

tr:nth-child(even){background-color: #f2f2f2
}

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
      include_once 'index_parent_parametre.php';
    ?>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="w3images/avatar5.png" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            
           <h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>
              <br/><br/>
             Pseudo = <?php echo $_SESSION['pseudo']; ?>
              <br/>
              Mail = <?php echo $_SESSION['mail']; ?>
                
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
          
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
      <?php   
            $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
            $id=$_GET['id'];
            $_select = $bdd->prepare("SELECT * FROM tuteur WHERE id=$id ");
            $_select->execute();
            while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
          ?>  
      <div class="w3-container w3-card-2  w3-margin-bottom">
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Modification du parent : <?php echo $s->nom;?> </i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
          
            <form method="POST" action="">
    
             <p>
          <input type="hidden"  value="<?php echo $s->id; ?>" readonly="true" name="code">
          <label>Nom</label>
          <input class="w3-input" value="<?php echo $s->nom;?>" autocomplete="off" name="nom" type="text"></p>
          <p>
          <label>Prénom</label>
          <input class="w3-input" value="<?php echo $s->prenom;?>" autocomplete="off" name="pe" type="text"></p>
          <p>
          <label>Mail</label>
          <input class="w3-input" value="<?php echo $s->mail;?>" autocomplete="off" name="mail" type="email"></p>
          
              <button  type="submit" class="btn btn-success" name="valider" >Modifier</button>

            </form><br/>
            
              
              </div>
          </div>
        </div>
      </div>
        <?php 
      }
        ?>
        <?php   
            $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
            $id=$_GET['id'];
            $_select = $bdd->prepare("SELECT * FROM tuteur WHERE id=$id");
            $_select->execute();
            while ($z=$_select->fetch(PDO::FETCH_OBJ)) {
          ?>  
     <!-- <div class="w3-container w3-card-2 ">
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Suppression du parent : <?php echo $z->nom;?> </i></h2>
    <p style="margin-left:15px;">
      A moins que vous ne trouviez plus l'importance de ce parent dans votre liste des parents, vous avez la possibilité de <a href="#demo" style="text-decoration:none; cursor:pointer;" data-toggle="collapse">supprimer le parent en question</a>
    </p>
    <div id="demo" style="margin-left:15px;" class="collapse">
    Voulez-vous réellement supprimer ce parent : <?php echo $z->nom; ?> ?
      <form method="POST" action="">
        <input type="hidden"  value="<?php echo $z->id; ?>" readonly="true" name="code">
        <button type="submit" class="btn btn-danger" style="margin-left:15px;" name="supprimer" >Supprimer</button>
      </form>
  </div>
  <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?><br/>
        
</div>-->
      
        
    
  
  </div><br/>
</div>
        
      </div>
      <?php
                   }
                   ?>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div><br/>
  <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
  <p class="w3-medium" style="margin-left:1150px;"><b><i class="fa fa fa-arrow-left fa-fw w3-margin-right w3-text-teal"></i><a href="index_parent_reception.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-2" style="text-decoration:none;">Retour</a></b></p>
            
  
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
