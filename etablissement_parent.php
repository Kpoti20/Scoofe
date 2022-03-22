<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  

  if(isset($_POST['forminscription']))
{
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $mail = htmlspecialchars(trim($_POST['mail']));

  if(!empty($nom) AND !empty($prenom) AND !empty($mail))

  {
    $nomlength = strlen($nom);
    $prenomlength = strlen($prenom);
    //$pseudo = test_input($_POST["pseudo"]);
    if($nomlength <= 30)
    {
      if (preg_match("/^[a-zA-Z ]*$/",$nom)) 
      {
        if($prenomlength <= 35)
       {
        if(preg_match("/^[a-zA-Z ]*$/",$prenom))
        {
          if(filter_var($mail,FILTER_VALIDATE_EMAIL))
          {
            $reqenre=$bdd->prepare("SELECT * FROM tuteur WHERE nom = ? and prenom = ? and mail = ? ");
            $reqenre->execute(array($nom,$prenom,$mail));
            $enregistrexist =$reqenre->rowcount();
            if($enregistrexist == 0)
            { 
                $inserttut = $bdd->prepare("INSERT INTO tuteur(nom,prenom,mail) VALUES(?,?,?)");
                $inserttut->execute(array($nom,$prenom,$mail)); 
                $nom="";
                $prenom="";
                $mail="";
                $up = $bdd->prepare("UPDATE tuteur SET p1=(SELECT substr(nom,1,3) ) , P2=(SELECT substr(prenom,1,3) ) , pseudo=(SELECT concat(p1,'',p2)) , motdepasse=sha1((SELECT concat(p1,'',p2))) where id=(SELECT MAX(id) )");
                $up->execute();
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
<title>Template parent</title>
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
      include_once 'etablissement_parent.php';
    ?>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="w3images/avatar3.png" style="width:100%" alt="Avatar">
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
          

          <!--<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Setting</a></b></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Media</a></p>-->
         <p class="w3-small"><b><i class="fa fa-user fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_parent.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Parent</a></b></p>
         <p class="w3-small"><b><i class="fa fa-book fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_classe.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Filiere</a></b></p>
         <p class="w3-small"><b><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_etudiant.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Etudiant</a></b></p>
         <p class="w3-small"><b><i class="fa fa-money fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_payement.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Payement de scolarité</a></b></p>
         <p class="w3-small"><b><i class="fa fa-bar-chart-o fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_payement.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Statistiques</a></b></p>
         <hr>
         <p class="w3-small"><b><i class="fa fa-gear fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_parametre.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Paramètres</a></b></p>
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
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Nouveau Parent</i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
            <form method="POST" action="">
              <p>
              <label for="nom" >Nom</label>
              <input class="w3-input "  autocomplete="off" type="text" value="<?php if (isset($nom)) {echo $nom;} ?>" placeholder="Votre nom" id="nom" name="nom"></p>
              <p>
              <label for="prenom" >Prénom(s)</label>
              <input class="w3-input" type="text"  autocomplete="off" value="<?php if (isset($prenom)) {echo $prenom;} ?>" placeholder="Votre prénom(s)" id="prenom" name="prenom"  ></p>
              <p>
              <label for="mail" >Email</label>
              <input class="w3-input" type="email"  autocomplete="off" value="<?php if (isset($mail)) {echo $mail;} ?>" placeholder="Votre email " id="mail" name="mail"  ></p>
              

              <button  type="submit" class="btn btn-success"  name="forminscription" value="Sauvegarder" >Sauvegarder</button>
              <button  type="reset"  class="btn btn-warning"  name="annuler" >Annuler</button>
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
         
<!--Fin Formulaire de suppression-->
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
  <p>Powered by <a href="default.html" target="_blank">Joel AHOLOU</a></p>
</footer>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_cv&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 15:08:10 GMT -->
</html>
<?php

  }else{
    echo "Desole";
  }
?>