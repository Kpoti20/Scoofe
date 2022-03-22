<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  if(isset($_POST['valider']))
{
            $idt=$_POST['code'];
            $nom = htmlspecialchars(trim($_POST['nom']));
            $pre = htmlspecialchars(trim($_POST['pre']));
            $pre1 = htmlspecialchars(trim($_POST['pre1']));
            $sx = $_POST['sx'];
            $ct= $_POST['ct'];
            $for= $_POST['for'];
            $md = $_POST['md'];
            $fil = $_POST['fil'];
            $tut = $_POST['tut'];
                      
  if(!empty($nom) AND !empty($pre) AND !empty($pre1) AND ($sx!="Selectionnez le sexe") AND !empty($ct) AND ($for!="Selectionnez la formation de l'étudiant") AND !empty($md) AND ($fil!="Selectionnez la filiere de l'étudiant") AND ($tut!="Selectionnez le tuteur de l'étudiant")){
           $nomlength = strlen($nom);
        $prelength = strlen($pre);
        $pre1length = strlen($pre1);
        $ctlength = strlen($ct);
        $mdlength = strlen($md); 
        if($nomlength <= 30)
        {
          if (preg_match("/^[a-zA-Z ]*$/",$nom)) 
          {
            if($prelength <= 15)
           {
            if(preg_match("/^[a-zA-Z ]*$/",$pre))
            {
              if($pre1length <= 15)
             {
               if(preg_match("/^[a-zA-Z ]*$/",$pre1))
              {
                if($sx=="Masculin" or $sx=="Féminin")
               {
                  if($ctlength>=2)
                 {
                  if($for!="Selectionnez la formation de l'étudiant")
                  {
                   if(($mdlength>0) and ($mdlength<=10))
                  {
                    if($fil!="Selectionnez la filiere de l'étudiant")
                   {
                     if($tut!="Selectionnez le tuteur de l'étudiant")
                    {
             
                        $reqenre=$bdd->prepare("SELECT * FROM etudiant WHERE no = ? and pr = ? and pre = ? and se = ? and te = ? and form = ? and mo = ? and fil = ? and tut = ? ");
                        $reqenre->execute(array($nom,$pre,$pre1,$sx,$ct,$for,$md,$fil,$tut));
                        $enregistrexist =$reqenre->rowcount();
                        if($enregistrexist == 0)
                        {           
                              $_update = $bdd->prepare("UPDATE etudiant SET no='$nom', pr='$pre', pre='$pre1', se='$sx', te='$ct', form='$for', mo='$md', fil='$fil', tut='$tut' WHERE mat=$idt ");
                              $_update->execute();
                              $erreur="Modification effectuée avec succes! ";
                              $up = $bdd->prepare(" UPDATE etudiant set sco = ( case when form = 'BTS' then 385000 when form = 'Licence' then 500000 when form = 'Master' then 600000 when form = 'Formation Modulaire' then 150000 else 200000 end)");
                            $up->execute();

                            /*$up1 = $bdd->prepare(" UPDATE etudiant set idf=(SELECT idfil FROM filiere WHERE etudiant.fil=filiere.lib) ");
                            $up1->execute();

                            $up2 = $bdd->prepare(" UPDATE etudiant set idt=(SELECT id FROM tuteur WHERE etudiant.tut=tuteur.mail) ");
                            $up2->execute();*/
                         } 
                        else
                        {
                          $erreur="ATTENTION !!! Risque de doublon un enregistrement deja effectué correspond avec cette modification";
                        }
                      }
                      else
                      {
                        $erreur="SVP Veuillez selectionnez le tuteur de l'etudiant !";
                      }
                    }
                      else
                      {
                        $erreur="SVP Veuillez selectionnez la filiere de l'etudiant !";
                      }
                    }
                    else
                    {
                      $erreur = "SVP Veuillez saisir une modalite de payement compris entre 1 et 10 pour l'etudiant !";
                    }
                  }else
                    {
                      $erreur= "SVP Veuillez selectionnez la formation de l'étudiant";
                    }
                  }
                  else
                  {
                    $erreur = "SVP Veuillez saisir le numero de contact de l'etudiant !";
                  }  
              }else
                {
                  $erreur="SVP Veuillez selectionnez le sexe de l'etudiant !";
                }
              }
              else
                 {
                   $erreur = "Seuls les caractères alphabetiques sont autorisés pour le deuxieme prénom ! ";
                 }
               }
               else
                {
                  $erreur = "Le deuxieme prénom ne dois pas depasser 15 caracteres !!!  ";
                }
                 }
               else
                  {
                    $erreur = "Seuls les caractères alphabetiques sont autorisés pour le premier prénom !! ";
                  }
                }
               else
                  {
                    $erreur = "Le premier prénom ne dois pas depasser 15 caracteres !!! ";
                  }
                }
               else
                  {
                    $erreur = "Seuls les caractères alphabetiques sont autorisés pour le nom !! ";
                  }
                }
               else
                  {
                    $erreur = "Le nom ne dois pas depasser 15 caracteres !!! ";
                  }
                }
               else
                  {
                    $erreur = "Veuillez remplir tous les champs !!! ";
                  }        
}


          if(isset($_POST['supprimer']))
           {
           $idt=$_POST['code'];
           $_delete = $bdd->prepare("DELETE  FROM etudiant WHERE mat=$idt");
           $_delete->execute();
           $erreur="Suppression effectuée avec succes! ";
           }
?>
<!DOCTYPE html>
<html>
<title>Template etudiant Action</title>
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
      include_once 'etablissement_etudiant_action.php';
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
            
           <h2>Profil de <?php echo $_SESSION['pseudot']; ?></h2>
              <br/><br/>
             Pseudo = <?php echo $_SESSION['pseudot']; ?>
              <br/>
              Mail = <?php echo $_SESSION['mail']; ?>
                
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
          
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
      <?php   
            $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
            $mat=$_GET['mat'];
            $_select = $bdd->prepare("SELECT * FROM etudiant WHERE mat=$mat ");
            $_select->execute();
            while ($s=$_select->fetch(PDO::FETCH_OBJ)) {
          ?>  
      <div class="w3-container w3-card-2  w3-margin-bottom">
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Modification de l'étudiant : <?php echo $s->no;?> </i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
          
            <form method="POST" action="">
    
             <p>
          <input type="hidden"  value="<?php echo $s->mat; ?>" readonly="true" name="code">
          <label>Nom</label>
          <input class="w3-input" value="<?php echo $s->no;?>" autocomplete="off" name="nom" type="text"></p>
          <p>
          <label>Prenom 1</label>
          <input class="w3-input" value="<?php echo $s->pr;?>" autocomplete="off" name="pre" type="text"></p>
          <p>
          <label>Prenom 2</label>
          <input class="w3-input" value="<?php echo $s->pre;?>" autocomplete="off" name="pre1" type="text"></p>
          <p>
          <label>Sexe</label>
          <select name="sx" class="w3-select"  id="sx" >
              <option><?php echo $s->se;?></option>
              <option value="Masculin">Masculin</option>
              <option value="Féminin">Féminin</option>
              </select>
          </p>
          <p>
          <label>Contact</label>
          <input class="w3-input" value="<?php echo $s->te;?>" autocomplete="off" name="ct" type="tel"></p>
          <p>
          <label>Formation</label>
          <select name="for" class="w3-select" id="for">
                  <option><?php echo $s->form; ?></option>
                  <option value="BTS">BTS</option>
                  <option value="Licence">Licence</option>
                  <option value="Master">Master</option>
                  <option value="Formation Modulaire">Formation Modulaire</option>
                </select>
          </p>
          <p>
          <label>Modalite</label>
          <input class="w3-input" value="<?php echo $s->mo;?>" autocomplete="off" name="md" type="number"></p>
          <p>
          <label>Filiere</label>
          
          <select name="fil" class="w3-select"  id="fil" >
                    <option><?php echo $s->fil;?></option>
              <?php
         
                   $_select=$bdd->query("SELECT idfil,lib  FROM filiere");
                   while($p = $_select->fetch(PDO::FETCH_OBJ)) 
                   {
              ?>
                    <option><?php echo $p->lib; ?></option>
                   <?php
                   }
                   ?>
              
          </select>
          </p>
          <p>
          <label>Tuteur</label>
              <select name="tut" class="w3-select" id="tut">
                    <option><?php echo $s->tut;?></option>
              <?php
                  $_select=$bdd->query("SELECT mail  FROM tuteur");
                  while ($o = $_select->fetch(PDO::FETCH_OBJ)) {
              ?>
                    <option><?php echo $o->mail; ?></option>
                   <?php
                   }
                   ?>
              </select>
          </p>
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
            $mat=$_GET['mat'];
            $_select = $bdd->prepare("SELECT * FROM etudiant WHERE mat=$mat ");
            $_select->execute();
            while ($z=$_select->fetch(PDO::FETCH_OBJ)) {
          ?>  
      <div class="w3-container w3-card-2 ">
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Suppression de l'étudiant : <?php echo $z->no;?> </i></h2>
    <p style="margin-left:15px;">
      A moins que vous ne trouviez plus l'importance de cet étudiant dans votre liste d'étudiant, vous avez la possibilité de <a href="#demo" style="text-decoration:none; cursor:pointer;" data-toggle="collapse">supprimer l'étudiant en question</a>
    </p>
    <div id="demo" style="margin-left:15px;" class="collapse">
    Voulez-vous réellement supprimer l'étudiant : <?php echo $z->no; ?>
      <form method="POST" action="">
        <input type="hidden"  value="<?php echo $z->mat; ?>" readonly="true" name="code">
        <button type="submit" class="btn btn-danger" style="margin-left:15px;" name="supprimer" >Supprimer</button>
      </form>
  </div>
  <br/>
        
</div>
      
        
    
  
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
  <p class="w3-medium" style="margin-left:1150px;"><b><i class="fa fa fa-arrow-left fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_etudiant.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-2" style="text-decoration:none;">Retour Etudiant</a></b></p>
            
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
