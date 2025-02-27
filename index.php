
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyScoofe.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <link rel="stylesheet" href="w3.css">
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;

  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 10px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
     /* background-color: #f4511e;*/
      background-color: #009688; 
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	
<nav  class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">MyScoofe</a>
    </div>
    <div  class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <!--<li><a href="#services">SERVICES</a></li>-->
        <li><a href="#parent">PARENTS</a></li>
        <li><a href="#etablis">ETABLISSEMENTS</a></li>
        <li><a href="#contact">CONTACT</a></li>
      </ul>
    </div>
  </div>
</nav>

<div style="  background-color: #009688; " class="jumbotron text-center">
  <h1></h1> 
  <p>Suivi de mes payements de scolarités</p> 
  
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About </h2><br>
      <h4>MyScoofe crée le début de l’année 2018 est une application de notification du payement de scolarité aux parents. L'acronyme MyScoofe vient de "My School Fees" en anglais qui signifie mes scolarités concerne plus les parents d'étudiants. L'application web est spécialement conçue pour les établissements d’enseignement supérieurs et les parents d’étudiants </h4><br>
      <p>MyScoofe met à la disposition des parents d’étudiants la possibilité de suivre les payements de scolarités de leurs enfants. En ce qui concerne les établissements d’enseignement supérieurs la plateforme est un excellent moyen d’être en contact direct avec les parents d’étudiants et également  suivre l’évolution du payement de scolarité de chaque étudiant. L'objectif de l'application web est d'aider les parents d’étudiants à contrôler et à suivre l’évolution de la scolarité de leurs enfants partout où ils se trouveraient et à n’importe quel moment.
	  Favoriser une bonne communication entre les parents d’étudiants et les établissements d’enseignement supérieurs nous tient vraiment à coeur.</p>
      <br>
    </div>
    <div class="col-sm-4">
      <span style="color: #009688; "  class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<!--<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span style="color: #097CF6; " class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>NOS VALEURS</h2><br>
      <h4><strong>OJECTIFS:</strong> </h4><br>
      <p><strong>VISION:</strong> </p>
    </div>
  </div>
</div>-->

<!-- Container (Services Section) -->
	<div id="parent" class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span style="color: #009688; " class="glyphicon glyphicon-user logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>PARENTS</h2><br>
      <h4>En vue d’atteindre l’objectif de l'application, tout tuteur ou parent désirant  suivre l’évolution du payement de scolarité de son ou ses  étudiant(s) disposera d'un compte parent qu'il peut créer ou lui sera attribué apres l'inscription des étudiants. Grace à la <a style="text-decoration:none; cursor:pointer;" href="index_inscription_parent.php" target="_parent"><strong style="color:#B25312;" >création d’un compte</strong></a>, les parents recevront une  notification à chaque opération de payement de scolarité mentionnant la somme payée  par son étudiant ainsi que le montant restant de la scolarité. Ce compte parent est un excellent  moyen pour les parents de suivre la formation de leurs enfants  tout en restant en contact avec l’administration. <a style="text-decoration:none;" href="index_connexion_parent.php" target="_parent"><strong style="color:#B25312;">Connectez-vous</strong></a> pour vivre l’expérience! </h4><br>
			
	  
      <!--<p><strong>VISION:</strong> </p>-->
		
      
	  <!--Fin du modal-->
    </div>
  </div>
</div>

<!-- Container (Portfolio Section) -->
	<div id="etablis" class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
      <span style="color: #009688; " class="glyphicon glyphicon-education logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>ETABLISSEMENTS</h2><br>
      <h4>L'utilisation de MyScoofe permet à l'établissement d’enseignement supérieur de definir ses étudiants et d'enregistrer les payements de scolarités  de chaque étudiant. Grace à la création d’un <a style="text-decoration:none;" href="index_inscription_etablissement.php" target="_parent"><strong style="color:#B25312;" >compte établissement </strong></a> l’ajout, la modification, la suppression de chaque opération  de payement seront les actions possibles concernant les étudiants. Apres ces actions il sera nécessaire d’envoyer  une notification des payements et le montant restant de la scolarité aux parents d’étudiants.<a style="text-decoration:none;" href="index_connexion_etablissement.php" target="_parent"><strong style="color:#B25312;"> Connectez-vous</strong></a> pour vivre cette expérience ! </h4><br>
      <!--<p><strong>VISION:</strong> </p>-->
    </div>
  </div>
</div>

<!-- Container (Pricing Section) -->


<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">Ecrivez-nous</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Lomé, TOGO</p>
      <p><span class="glyphicon glyphicon-phone"></span> +228 22 22 26 06</p>
      <p><span class="glyphicon glyphicon-envelope"></span> def@defitech.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
var myCenter = new google.maps.LatLng(41.878114, -87.629798);

function initialize() {
var mapProp = {
  center:myCenter,
  zoom:12,
  scrollwheel:false,
  draggable:false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };

var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<footer class="container-fluid text-center w3-teal" >
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Copyright <a href="" title="Visit w3schools">Joel AHOLOU</a></p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>

<!-- Mirrored from www.w3schools.com/bootstrap/tryit.asp?filename=trybs_theme_company_complete_animation by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Dec 2016 18:41:41 GMT -->
</html>
