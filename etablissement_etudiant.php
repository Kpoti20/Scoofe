<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  
  if(isset($_POST['forminscription']))
{
        $nom = htmlspecialchars(trim($_POST['nom']));
        $pre = htmlspecialchars(trim($_POST['pre']));
        $pre1 = htmlspecialchars(trim($_POST['pre1']));
        $sx = $_POST['sx'];
        $ct= $_POST['ct'];
        $for= $_POST['for'];
        $md = $_POST['md'];
        $fil = $_POST['fil'];
        $tut = $_POST['tut'];
      if(!empty($nom) AND !empty($pre) AND !empty($pre1) AND ($sx!="Selectionnez le sexe") AND !empty($ct) AND ($for!="Selectionnez la formation de l'étudiant") AND !empty($md) AND ($fil!="Selectionnez la filiere de l'étudiant") AND ($tut!="Selectionnez le tuteur de l'étudiant"))

      {
        $nomlength = strlen($nom);
        $prelength = strlen($pre);
        $pre1length = strlen($pre1);
        $ctlength = strlen($ct);
        $mdlength = strlen($md);
        //$pseudo = test_input($_POST["pseudo"]);
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
                            
                            $inserttut = $bdd->prepare("INSERT INTO etudiant(no,pr,pre,se,te,form,mo,fil,tut) VALUES(?,?,?,?,?,?,?,?,?)");
                            $inserttut->execute(array($nom,$pre,$pre1,$sx,$ct,$for,$md,$fil,$tut)); 
                           $update = $bdd->prepare("UPDATE etudiant SET identite=(SELECT concat(no,' ',pr,' ',pre)) WHERE mat=(SELECT MAX(mat))");
                            $update->execute();
                            $nom="";
                            $pre="";
                            $pre1="";
                            $sx="";
                            $ct="";
                            $for="";
                            $md="";
                            $fil="";
                            $tut="";
                            "<br/>";
                            $erreur="Enregistrement effectué avec succes! "; 
                            $up = $bdd->prepare(" UPDATE etudiant set sco = ( case when form = 'BTS' then 385000 when form = 'Licence' then 500000 when form = 'Master' then 600000 when form = 'Formation Modulaire' then 150000 else 200000 end)");
                            $up->execute();

                           /* $up1 = $bdd->prepare(" UPDATE etudiant set idf=(SELECT idfil FROM filiere WHERE etudiant.fil=filiere.lib) ");
                            $up1->execute();

                            $up2 = $bdd->prepare(" UPDATE etudiant set idt=(SELECT id FROM tuteur WHERE etudiant.tut=tuteur.mail) ");
                            $up2->execute();*/
                        } 
                        else
                        {
                          $erreur="ATTENTION !!! Enregistrement deja effectué";
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
                      $erreur = "SVP Veuillez selectionnez la fomation l'étudiant !";
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
<title>Template etudiant</title>
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
    width: 50%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 4px;
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
      include_once 'etablissement_etudiant.php';
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
            
           <h2 class="w3-margin-top" >Profil de <?php echo $userinfo['pseudo']; ?></h2>
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
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Enregistrement des Etudiant(e)s</i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
            <form method="POST" action="">
    
              <p>
              <label for="nom" >Nom</label>
              <input class="w3-input "  type="text" value="<?php if (isset($nom)) {echo $nom; } ?>" autocomplete="off" placeholder="Nom Etudiant" id="nom" name="nom"></p>
              <p>
              <label for="pre" >Prénom 1</label>
              <input class="w3-input" type="text" value="<?php if (isset($pre)) {echo $pre; } ?>" autocomplete="off" placeholder="Premier prénom Etudiant" id="pre" name="pre"></p>
              <p>
              <p>
              <label for="pre1" >Prénom 2</label>
              <input class="w3-input" type="text" autocomplete="off" value="<?php if (isset($pre1)) {echo $pre1;} ?>" placeholder="Deuxieme prénom Etudiant" id="pre1" name="pre1"></p>
              <p>
              <label for="sx" >Sexe</label>
              <select name="sx" class="w3-select" id="sx" >
                <option value="">Selectionnez le sexe</option>
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
              </select>
              </p>
              <p>
              <label for="ct">Contact</label>
              <input class="w3-input" type="tel" autocomplete="off" value="<?php if (isset($ct)) {echo $ct; } ?>" placeholder="Contact Etudiant" id="ct" name="ct"></p>
              <p>
                <label for="for">Formation</label>
                <select name="for" class="w3-select" id="for">
                  <option>Selectionnez la formation de l'étudiant</option>
                  <option value="BTS">BTS</option>
                  <option value="Licence">Licence</option>
                  <option value="Master">Master</option>
                  <option value="Formation Modulaire">Formation Modulaire</option>
                </select>
              </p>
              <p>
              <label for="md">Modalité</label>
              <input class="w3-input" type="number" autocomplete="off" min="1" max="10" value="<?php if (isset($md)) {echo $md; } ?>" placeholder="Modalite de payement Etudiant" id="md" name="md"></p>
              <p>
              <label for="fil" >Filière</label><select  class="w3-select" name="fil">
              <option value="">Selectionnez la filiere de l'étudiant</option>
     <?php
     
     $_select=$bdd->query("SELECT idfil,lib  FROM filiere");
         while ($S = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $S->lib; ?></option>
     <?php
         }
     ?>

   </select></p>
              <p>
              <label for="tut" >Tuteur</label>
              <select  class="w3-select" name="tut">
                <option value="">Selectionnez le tuteur de l'étudiant</option>
     <?php
     
     $_select=$bdd->query("SELECT mail FROM tuteur");
         while ($S = $_select->fetch(PDO::FETCH_OBJ)) {
     ?>

           <option><?php echo $S->mail; ?></option>
     <?php
         }
     ?>

   </select></p>
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
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des étudiants</i></h2>
    <?php 

    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
    $search="";
    if (isset($_POST['search'])) {
      $search=$_POST['search'];
      $_select = $bdd->prepare("SELECT * FROM etudiant WHERE no like '%$search%' ");
    } else {
        $_select = $bdd->prepare("SELECT * FROM etudiant order by mat desc");
    }
    $_select->execute();
    ?>

<form method="POST" action="">
  
  <div class="input-group">
    <label for="choix" style="margin-left:15px;">Rechercher par </label>
    <select class=""  style="width:150px; margin-left:15px;" name="choix">
      <option value="">Nom</option>
      <option value="">Prénom 1</option>
      <option value="">Prénom 2</option>
      <option value="">Masculin</option>
      <option value="">Féminin</option>
      <option value="">Sexe</option>
      <option value="">Filiere</option>
      <option value="">Modalité</option>
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
      
  <table style="width:800px;">
    <thead>
      <tr>
        <th>ID </th>       
        <th>Nom</th>
        <th>Prénom 1</th>
        <th>Prénom 2</th>
        <th>Sexe</th>
        <th>Contact</th>
        <th>Formation</th>
        <th>Modalite</th>
        <th>Filiere</th>
        <th>Tuteur</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>
   
	 <?php  while ($s=$_select->fetch(PDO::FETCH_OBJ)){
?>  
      <tr>
       
        <td><?php echo $s->mat;?></td>
        <td><?php echo $s->no;?></td>
        <td><?php echo $s->pr;?></td>
        <td><?php echo $s->pre;?></td>
        <td><?php echo $s->se;?></td>
        <td><?php echo $s->te;?></td>
        <td><?php echo $s->form;?></td>
        <td><?php echo $s->mo;?></td>
        <td><?php echo $s->fil;?></td>
        <td><?php echo $s->tut;?></td>
        <td>
   
     <a href="etablissement_etudiant_action.php?mat=<?php echo $s->mat;?>" target="_parent"  style="text-decoration:none;">Action</a></td>
		     <?php
                    }
                    ?>
</div> 
        
    </tr>
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