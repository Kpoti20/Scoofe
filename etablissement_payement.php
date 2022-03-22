<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  
  if(isset($_POST['forminscription']))
{

          
          $mat=$_POST['mat'];
          $mt=$_POST['mt'];
      if(!empty($mat) AND !empty($mt))

      {
                
                $mtl = strlen($mt);
                $datactu = date('Y-m-d');
               //  if($jr==$datactu)
               // {
                   if($mat!="Desole aucun étudiant ne correspond à votre recherche")
                  {
                   if($mtl>0)
                    {
                         
                            $inserttut = $bdd->prepare("INSERT INTO payement(ljr,mate,mont) VALUES('$datactu',?,?)");
                            $inserttut->execute(array($mat,$mt)); 
                            $jr="";
                            $mat="";
                            $mt="";
                            "<br/>";
                            $erreur="Enregistrement effectué avec succes! "; 
                      }
                      else
                      {
                        $erreur="SVP Veuillez saisir un montant correct et different de zero";
                      }
                    }
                    else
                    {
                      $erreur = "SVP Veuillez choisir un étudiant";
                    }
               
              }else
                {
                  $erreur="Veuillez remplir tous les champs !!! !";
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
<title>Template payement</title>
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

    ul{
      background-color: #eee;
      cursor: pointer;

    }
    li{
      padding:12px; 
    }
  
</style>
<body class="w3-light-grey">
<?php 
      include_once 'etablissement_payement.php';
    ?>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="w3images/avatar3.png" style="width:100%; height: 300px;" alt="Avatar">
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
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Nouveau Payement</i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
            <form method="POST" action="">

              <p>
              <label for="mat" >Etudiant</label>
              <input type="text" name="mat" id="mat" autocomplete="off" class="w3-input"  placeholder="Choisir un étudiant"><div id="etudiantList"></div>
              </p>
              <p>
              <label for="mt" >Montant à payer </label>
              <input class="w3-input "  type="number" value="<?php if (isset($mt)) {echo $mt; } ?>" autocomplete="off" placeholder="Montant à payer " id="mt" name="mt"></p>
              
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
        <h2 class="w3-text-teal w3-padding-16" style="margin-left:15px;"><i>Liste des payements</i></h2>
    <?php 

    $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
    $search="";
    if (isset($_POST['search'])) {
      $search=$_POST['search'];
      $_select = $bdd->prepare("SELECT * FROM payement WHERE idp like '%$search%' ");
    } else {
        $_select = $bdd->prepare("SELECT * FROM payement order by idp desc");
    }
    $_select->execute();
    ?>

<form method="POST" action="">
  
  <div class="input-group">
    <label for="choix" style="margin-left:15px;">Rechercher par </label>
    <select class=""  style="width:150px; margin-left:15px;" name="choix">
      <option value="">Date</option>
      <option value="">Etudiant</option>
      <option value="">Montant</option>
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
        <th>Date</th>
        <th>Etudiant</th>
        <th>Montant restant</th>
        <th>Montant à payer</th>
        <th>Opérations</th>
        <th>Notification de payement</th>
      </tr>
    </thead>
    <tbody>
   
	 <?php  while ($s=$_select->fetch(PDO::FETCH_OBJ)){
?>  
      <tr>
       
        <td><?php echo $s->idp;?></td>
        <td><?php echo $s->ljr;?></td>
        <td><?php echo $s->mate;?></td>
        <td><?php echo $s->montre;?></td>
        <td><?php echo $s->mont;?></td>
        <td>
   
     <a href="etablissement_payement_action.php?idp=<?php echo $s->idp;?>" target="_parent"  style="text-decoration:none;">Action</a></td><td><a href="etablissement_payement_envoi_de_mail.php?idp=<?php echo $s->idp;?>" target="_parent"  style="text-decoration:none;">Informer le parent ou tuteur </a></td>
		     <?php
                    }
                    ?></tr>
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
<script>
  $(document).ready(function(){
    $('#mat').keyup(function(){
      var query = $(this).val();
      if (query != '') 
      {
        $.ajax({
          url:"search.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
            $('#etudiantList').fadeIn();
            $('#etudiantList').html(data);
          }
        }); 
      } 
    });
    $(document).on('click', 'li', function(){
      $('#mat').val($(this).text());
      $('#etudiantList').fadeOut();
    });
  });
</script>
<?php

  }else{
    echo "Desole ";
  }
?>