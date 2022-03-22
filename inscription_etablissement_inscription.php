<?php
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
if(isset($_POST['forminscription']))
{

    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $mail2 = htmlspecialchars(trim($_POST['mail2']));
    $mdp = $_POST['mdp'];
    $mdp2 = $_POST['mdp2'];

  if(!empty($pseudo) AND !empty($mail) AND !empty($mail2) AND !empty($mdp) AND !empty($mdp2))
   
  {
     $mdpe = sha1($mdp);
    $mdp23 = sha1($mdp2);
    $pseudolength = strlen($pseudo);
    //$pseudo = test_input($_POST["pseudo"]);
    if($pseudolength <= 255)
    {
      if (preg_match("/^[a-zA-Z ]*$/",$pseudo)) 
      {
        if($mail == $mail2)
        {
          if(filter_var($mail,FILTER_VALIDATE_EMAIL))
          {
            $reqmail=$bdd->prepare("SELECT * FROM etablissement WHERE mail = ? ");
            $reqmail->execute(array($mail));
            $mailexist =$reqmail->rowcount();
            if($mailexist == 0)
            { 

              if($mdpe == $mdp23)
              {
                $insertmbr = $bdd->prepare("INSERT INTO etablissement(pseudo,mail,motdepasse) VALUES(?,?,?)");
                $insertmbr->execute( array($pseudo,$mail,$mdpe)); 
                "<br/>";
                $erreur="votre compte a ete cree avec succes!"; 
              }
              else
              {
                $erreur ="Vos mot de passe ne correspondent pas!";
              }
            } 
            else
            {
              $erreur="Ce Adresse mail est deja utiliser";
            }
        }
        else
        {
          $erreur="votre adresse mail n est pas valide!";
        }
      }
      else
      {
        $erreur="vos adresse mail ne correspondent pas!";
      }
    }
    else
    {
      $erreur = "Seuls les caractères alphabetiques sont autorisés";
    }
  }else
    {
      $erreur="votre pseudo ne dois pas depasser 255 caracteres!!!";
    }
  }
  else
  {
    $erreur = "veuillez remplir tous les champs!";
  }

}

?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif; }
.w3-navbar,h1,button
 {font-family: "Montserrat", sans-serif; }
.fa-anchor,.fa-coffee {font-size:200px}
#te{
   background-color: #097CF6;
}
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;

    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.button2 {background-color: #008CBA;}
</style>
<body>
<?php 
      include_once 'inscription_etablissement_inscription.php';
    ?>
<!-- Navbar -->
<div id="te" class="w3-top">
  <ul  class="w3-navbar w3-blue w3-card-2 w3-left-align w3-large">
    <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
      <a class="w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    </li>
    <li><a href="#" class="w3-padding-large w3-white">ACCUEIL</a></li>
    
    <li class="w3-hide-small"><a href="inscription_etablissement.php" target="_parent" class="w3-padding-large w3-hover-white">ETABLISSEMENTS</a></li>
    <li class="w3-hide-small"><a href="inscription_parent.php" target="_parent" class="w3-padding-large w3-hover-white">PARENTS</a></li>
    
  </ul>

  <!-- Navbar on small screens -->
  <div  id="navDemo" class="w3-hide w3-hide-large w3-hide-medium">
    <ul class="w3-navbar w3-left-align w3-large w3-blue">
      
      <li><a class="w3-padding-large" href="inscription_etablissement.php" target="_parent">ETABLISSEMENTS</a></li>
      <li><a class="w3-padding-large" "inscription_parent.php" target="_parent">PARENTS</a></li>
      
    </ul>
  </div>
</div>

<!-- Header -->
<!--<header  class="w3-container w3-blue w3-center w3-padding-128" >
  <h1  class="w3-margin w3-jumbo">MyScoofe</h1>
  <p class="w3-xlarge">Suivi de mes payements de scolarités</p>
  <button class="w3-btn w3-padding-16 w3-large w3-margin-top " style="color: #ffff; ">Login</button>

</header>-->

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>ETABLISSEMENTS</h1>
      <h5 class="w3-padding-32">En vue d’atteindre l’objectif de la plateforme, chaque établissement  d’enseignement supérieur  a  la possibilité de suivre l’évolution et l’enregistrement des payements de scolarité  de chaque étudiant. </h5>

      <p class="w3-text-grey">Grace à la création d’un <a style="text-decoration:none;" href="inscription_etablissement_inscription.php" target="_parent"><strong style="color:#B25312;" >compte établissement </strong></a> l’ajout, la modification, la suppression de chaque opération  de payement seront les actions possibles concernant les étudiants. Apres ces actions il sera nécessaire d’envoyer  une notification des payements et le montant restant de la scolarité aux parents d’étudiants.<a style="text-decoration:none;" href="inscription_etablissement_connexion.php" target="_parent"><strong style="color:#B25312;">Connectez-vous</strong></a> pour vivre cette expérience !</p>
    </div>

    <div class="w3-third w3-center" >
     
      <i class="fa fa-anchor w3-padding-64 " style="color: #097CF6; " ></i>
      
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    

    <div class="w3-container">
      <h2>Création de compte Etablissement</h2>
    </div>

    <form class="w3-container w3-light-grey" method="POST" action="<?php echo htmlspecialchars("inscription_etablissement_inscription.php");?>"  >
      <p>
      <label for="pseudo" >Pseudo</label>
      <input class="w3-input "  type="text" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" placeholder="Votre pseudo" id="pseudo" name="pseudo"></p>
      <p>
      <label for="mail" >Mail</label>
      <input class="w3-input" type="email" value="<?php if (isset($mail)) {echo $mail;} ?>" placeholder="Votre mail" id="mail" name="mail"  ></p>
      <p>
      <label for="mail2" >Confirmation de mail</label>
      <input class="w3-input" type="email" value="<?php if (isset($mail2)) {echo $mail2;} ?>" placeholder="Votre mail de confirmation" id="mail2" name="mail2"  ></p>
      <p>
      <label for="mdp">Mot de passe</label>
      <input class="w3-input" type="password" placeholder="Votre password" id="mdp" name="mdp" ></p>
      <p>
      <label for="mdp2">Confirmation de mot de passe</label>
      <input class="w3-input"  type="password"  placeholder="Confirmez votre password" id="mdp2" name="mdp2" ></p>
      
      <button  type="submit" class="button button2" name="forminscription" >S'inscrire</button>
    </form>
     <?php
      if (isset($erreur))
      {
        echo "<font color='red'>" .$erreur. "</font>";
      }
        ?>
  </div>
</div>

<!--<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
</div>-->

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-blue">  
  <div class="w3-xlarge w3-padding-32">
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-facebook-official"></i></a>
   <a href="#" class="w3-hover-text-red"><i class="fa fa-pinterest-p"></i></a>
   <a href="#" class="w3-hover-text-light-blue"><i class="fa fa-twitter"></i></a>
   <a href="#" class="w3-hover-text-grey"><i class="fa fa-flickr"></i></a>
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-linkedin"></i></a>
 </div>
 <p>Powered by <a href="default.html" target="_blank">Joel Aholou</a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_start_page&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 15:09:34 GMT -->
</html>
