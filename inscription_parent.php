<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif; }
.w3-navbar,h1,button
 {font-family: "Montserrat", sans-serif; }
.fa-anchor,.fa-coffee {font-size:200px}
#te{
   background-color: #097CF6;
}
</style>
<body>

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
      <li><a class="w3-padding-large" href="inscription_parent.php" target="_parent">PARENTS</a></li>
      
    </ul>
  </div>
</div>

<!-- Header -->
<header  class="w3-container w3-blue w3-center w3-padding-128" >
  <h1  class="w3-margin w3-jumbo">MyScoofe</h1>
  <p class="w3-xlarge">Suivi de mes payements de scolarités</p>
  <button class="w3-btn w3-padding-16 w3-large w3-margin-top " style="color: #ffff; ">Login</button>

</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>ETABLISSEMENTS</h1>
      <h5 class="w3-padding-32">En vue d’atteindre l’objectif de la plateforme, tout tuteur ou parent désirant  suivre l’évolution du payement de scolarité de son ou ses  étudiant(s)  a l’obligation de créer un compte parent.</h5>

      <p class="w3-text-grey">Grace à la <a style="text-decoration:none;" href="inscription_parent_inscription.php" target="_parent"><strong style="color:#B25312;" >création d’un compte</strong></a>, les parents recevront une  notification à chaque opération de payement de scolarité mentionnant la somme payée  par son étudiant ainsi que le montant restant de la scolarité. Ce compte parent est un excellent  moyen pour les parents de suivre la formation de leurs enfants  tout en restant en contact avec l’administration. <a style="text-decoration:none;" href="inscription_parent_connexion.php" target="_parent"><strong style="color:#B25312;">Connectez-vous</strong></a> pour vivre l’expérience!</p>
    </div>

    <div class="w3-third w3-center" >
     
      <i class="fa fa-anchor w3-padding-64 " style="color: #097CF6; " ></i>
      
    </div>
  </div>
</div>

<!-- Second Grid -->
<!--<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-coffee w3-padding-64  w3-margin-right" style="color: #097CF6; "></i>
    </div>

    <div class="w3-twothird">
      <h1>OBJECTIFS</h1>
      <h5 class="w3-padding-32">Aider les parents d’étudiants à contrôler et à suivre l’évolution de la scolarité de leurs enfants partout où ils se trouveraient et à n’importe quel moment</h5>

      <p class="w3-text-grey">Favoriser une bonne communication entre les parents d’étudiants et les établissements d’enseignement supérieurs.</p>
    </div>
  </div>
</div>
-->
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
