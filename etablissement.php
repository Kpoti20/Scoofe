<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
if (isset($_GET['id']) AND $_GET['id'] > 0) 
{
  $getid = intval($_GET['id']);
  $requser = $bdd->prepare('SELECT * FROM etablissement WHERE id = ? ');
  $requser->execute(array($getid));
  $userinfo=$requser->fetch(); 


?>
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="w3-light-grey">

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
                    <a href="editionprofil.php">Editer mon profil</a>
                    <a href="deconnexion.php">Deconnexion</a>
                    <?php
                    }
                    ?>
          </div>
        </div>
        <div class="w3-container">
          <!--<p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i></p>-->
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>Ecrire un message</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>Boite de reception</p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>Carnet d'adresse</p>
          <hr>

          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Setting</b></p>
          <p>Adobe Photoshop</p>
          <div class="w3-progress-container w3-round-xlarge w3-small">
            <div class="w3-progressbar w3-round-xlarge w3-teal" style="width:90%">
              <div class="w3-center w3-text-white">90%</div>
            </div>
          </div>
          <p>Photography</p>
          <div class="w3-progress-container w3-round-xlarge w3-small">
            <div class="w3-progressbar w3-round-xlarge w3-teal" style="width:80%">
              <div class="w3-center w3-text-white">80%</div>
            </div>
          </div>
          <p>Illustrator</p>
          <div class="w3-progress-container w3-round-xlarge w3-small">
            <div class="w3-progressbar w3-round-xlarge w3-teal" style="width:75%">
              <div class="w3-center w3-text-white">75%</div>
            </div>
          </div>
          <p>Media</p>
          <div class="w3-progress-container w3-round-xlarge w3-small">
            <div class="w3-progressbar w3-round-xlarge w3-teal" style="width:50%">
              <div class="w3-center w3-text-white">50%</div>
            </div>
          </div>
          <br>

          <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b></p>
          
          <div class="w3-progress-container w3-round-xlarge">
            
          </div>
          
          <div class="w3-progress-container w3-round-xlarge">
            
          </div>
          
          <div class="w3-progress-container w3-round-xlarge">
            <div ></div>
            
          </div>
          <p><a href="" target="_parent" class="w3-padding-large w3-hover-white">ETABLISSEMENTS</a></p>
          <br>
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i></h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b></b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>J<span class="w3-tag w3-teal w3-round"></span></h6>
          <p></p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>W</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i></h6>
          <p></p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>G</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i></h6>
          <p></p><br>
        </div>
      </div>

      <div class="w3-container w3-card-2 w3-white">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>E</h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>W</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>F</h6>
          <p>W</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>L</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2</h6>
          <p>M</p>
          <hr>
        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>S</b></h5>
          <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2</h6>
          <p>B</p><br>
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
