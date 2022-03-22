<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  

  if(isset($_POST['forminscription']))
{
    $nom = htmlspecialchars(trim($_POST['nom']));
    $des = htmlspecialchars(trim($_POST['des']));
    

  if(!empty($nom) AND !empty($des))

  {
    $nomlength = strlen($nom);
    $deslength = strlen($des);
    //$pseudo = test_input($_POST["pseudo"]);
    if($nomlength <= 10)
    {
      if (preg_match("/^[a-zA-Z ]*$/",$nom)) 
      {
        if($deslength <= 35)
       {
        if(preg_match("/^[a-zA-Z ]*$/",$des))
        {
           $reqenre=$bdd->prepare("SELECT * FROM filiere WHERE lib = ? and des = ? ");
           $reqenre->execute(array($nom,$des));
           $enregistrexist =$reqenre->rowcount();
              if($enregistrexist == 0)
              { 
                  $inserttut = $bdd->prepare("INSERT INTO filiere(lib,des) VALUES(?,?)");
                  $inserttut->execute(array($nom,$des)); 
                  "<br/>";
                  $erreur="Enregistrement effectué avec succes! "; 
              } 
              else
              {
                $erreur="ATTENTION !!! Enregistrement deja effectué";
              }  
        }
        else
        {
          $erreur = "Seuls les caractères alphabetiques sont autorisés pour la description";
        }
      }
      else
      {
        $erreur = "La description ne dois pas depasser 35 caracteres!!!";
      }
    }else
    {
      $erreur="Seuls les caractères alphabetiques sont autorisés pour le nom";
    }  
  }else
    {
      $erreur="Le nom ne dois pas depasser 10 caracteres!!!";
    }
  }
  else
  {
    $erreur = "veuillez remplir tous les champs!";
  }

}
if (isset($_GET['id'])) 
  {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM etablissement WHERE id = ? ');
    $requser->execute(array($getid));
    $userinfo=$requser->fetch(); 
    $_SESSION['id'] = $userinfo['id'];
    $_SESSION['pseudot']= $userinfo['pseudo'];
    $_SESSION['mail']= $userinfo['mail'];
?>
<!DOCTYPE html>
<html>
<title>Template classe</title>
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
      include_once 'etablissement_classe.php';
    ?>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="w3images/avatar_hat.jpg" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            
           <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
              <br/><br/>
             Pseudo = <?php echo $userinfo['pseudo']; ?>
              <br/>
              Mail = <?php echo $userinfo['mail']; ?>
                <?php
                  if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
                  
                    ?>
                          </div>
        </div>
        <div class="w3-container">
        <br/>
          <!--<p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i></p>-->
          <p><i class="fa fa-pencil-square-o fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-small w3-hover-white" style="text-decoration:none;">Ecrire</a></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-small w3-hover-white" style="text-decoration:none;">Boite de reception</a></p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-small w3-hover-white" style="text-decoration:none;">Carnet d'adresse</a></p>
          <hr>

          <!--<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Setting</a></b></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Media</a></p>-->
         <p class="w3-small"><b><i class="fa fa-user fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_parent.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Parent</a></b></p>
         <p class="w3-small"><b><i class="fa fa-book fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_classe.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Filiere</a></b></p>
         <p class="w3-small"><b><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_etudiant.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Etudiant</a></b></p>
         <p class="w3-small"><b><i class="fa fa-money fa-fw w3-margin-right w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Payement de scolarité</a></b></p>
         <hr>
         <p class="w3-small"><b><i class="fa fa-gear fa-fw w3-margin-right w3-text-teal"></i><a href="editionprofil.php" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Paramètres</a></b></p>
         <p class="w3-small"><b><i class="fa fa-sign-out fa-fw w3-margin-right w3-text-teal"></i><a href="deconnexion.php" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Déconnexion</a></b></p>
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
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Nouvelle Filiere</i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
            <form method="POST" action="">
              <p>
              <label for="nom" >Nom</label>
              <input class="w3-input "  autocomplete="off" type="text"  placeholder="Le nom de la classe" id="nom" name="nom"></p>
              <p>
              <label for="des" >Description</label>
              <input class="w3-input" type="text"  autocomplete="off" placeholder="La description de la classe" id="des" name="des"  ></p>
              <button  type="submit" class="btn btn-default"  name="forminscription" value="Sauvegarder" >Sauvegarder</button>
              <button  type="submit"  class="btn btn-default"  name="" value="Sauvegarder" >Annuler</button>
            </form><br/>
            <?php
      if (isset($erreur))
      {?>
         <script>  alert('<?php  echo  $erreur  ;?>')</script>
      <?php   
      }

        ?>
          </div>
</div>
        </div>
        </div>

      <div class="w3-container w3-card-2 ">
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des Filieres</i></h2>
    <?php   
    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
    $search="";
    if (isset($_POST['search'])) {
      $search=$_POST['search'];
      $_select = $bdd->prepare("SELECT * FROM filiere WHERE lib like '%$search%' or des like '%$search%'");
    } else {
      $_select = $bdd->prepare("SELECT * FROM filiere order by idfil desc");
    }
    
    $_select->execute();
    ?>

<form method="POST" action="">
  
  <div class="input-group">
    <input type="text" class="form-control" style="margin-left:15px; " name="search" value="<?php if (isset($search)) {echo ($search);} ?>" placeholder="Search..">
    <div class="input-group-btn">
      <button class="btn btn-default" style="margin-right:300px; " type="submit">
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
        <th>ID Classe</th>        
        <th>Nom Classe</th>
        <th>Description Classe</th>
      
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>

     <?php  while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
?>    
      <tr>
        <td><?php echo $s->idfil;?></td>
        <td><?php echo $s->lib;?></td>
        <td><?php echo $s->des;?></td>
        
        <td>
          <a onclick="document.getElementById('<?php echo $s->idfil;?>').style.display='block'" style="text-decoration:none;" class="">Action</a>
        </td>
       
 <!--Formulaire de modification--> <div id="<?php echo $s->idfil;?>" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-8">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('<?php echo $s->idfil;?>').style.display='none'" 
        class="w3-closebtn">&times;</span>
        <h2>Operation: Modification/Suppression</h2>
      </header><br/>
      <div class="w3-container">
        
      <form class="w3-container" method="POST" action="">
        <p>
        <input type="hidden"  value="<?php echo $s->idfil; ?>" readonly="true" name="code">
        <label>Nom</label>
        <input class="w3-input" value="<?php echo $s->lib;?>" name="nom" type="text"></p>
        <p>
        <label>Prenom(s)</label>
        <input class="w3-input" value="<?php echo $s->des;?>" name="des" type="text"></p>
        
        <button class="button button2" name="valider" >Modifier</button>
        <button class="button button3" name="supprimer" >Supprimer</button>
        <?php

          if(isset($_POST['valider'])){
            $idt=$_POST['code'];
            $nom=$_POST['nom'];
            $des=$_POST['des'];
            
            $_update = $bdd->prepare("UPDATE filiere SET lib='$nom', des='$des' WHERE idfil=$idt ");
            $_update->execute();
            
    }
      if(isset($_POST['supprimer'])){
            $idt=$_POST['code'];
             $_delete = $bdd->prepare("DELETE  FROM filiere WHERE idfil=$idt");
             $_delete->execute();
           }
    ?>
    </form>
    </div>
    </div>
    </div><!--Fin de formulaire de modification-->
         
<!--Fin Formulaire de suppression-->
</div>
      </tr>
     <?php

    }
    ?>
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
