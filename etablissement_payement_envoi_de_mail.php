<?php
  session_start();
  $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
  if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
if (isset($_POST['envoi_message'])) {

    $des=$_POST['destinataire'];
    $mes=$_POST['message'];
      
  if (isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['message']) AND !empty($_POST['message'])) {
    
    $destinataire = htmlspecialchars($_POST['destinataire']);
    $message = htmlspecialchars($_POST['message']);

    $id_destinataire= $bdd->prepare('SELECT id from tuteur where mail = ?');
    $id_destinataire->execute(array($destinataire));
     $dest_exist = $id_destinataire->rowCount();
  
    if($dest_exist == 1){
       $id_destinataire = $id_destinataire->fetch();
       $id_destinataire = $id_destinataire['id'];
  
       $ins = $bdd->prepare('INSERT INTO message(id_expediteur, id_destinataire,message) values (?,?,?)');
       $ins->execute(array($_SESSION['id'],$id_destinataire,$message));
       $error="Votre message a bien été envoyé !";
  }else{
    $error="Cet utilisateur n'existe pas !";
  }
  } else {
    $error="Veuillez completez tous les champs";
  }
}

$destinataires = $bdd->query('SELECT pseudo FROM membres ORDER BY pseudo')


?>
<!DOCTYPE html>
<html>
<title>Template Payement Action</title>
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
  .button3 {background-color: #B20808;}
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
      include_once 'etablissement_payement_envoi_de_mail.php';
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
            
           <h2>Profil de <?php echo $_SESSION['pseudot']; ?></h2>
             Pseudo = <?php echo $_SESSION['pseudot']; ?>
              <br/>
              Mail = <?php echo $_SESSION['mail']; ?><br>
              <!--ID = <?php echo $_SESSION['id']; ?>-->
                
                          </div>
        </div>
        <div class="w3-container">
        <br/>
          <!--<p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i></p>-->
          <p><i class="fa fa-pencil-square-o fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" style="margin-left:10px; text-decoration:none;" target="_parent" class="w3-padding-small w3-hover-white" style="text-decoration:none;">Ecrire</a></p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" style="margin-left:10px; text-decoration:none;" target="_parent" class="w3-padding-small w3-hover-white" style="text-decoration:none;">Boite de reception</a></p>
          <p><i style="margin-left:3px;" class="fa fa-address-book-o w3-margin-right w3-large w3-text-teal"></i><a href="" style="margin-left:15px; text-decoration:none;" target="_parent" class="w3-padding-small w3-hover-white" style="text-decoration:none;">Carnet d'adresse</a></p>
          <hr>

          <!--<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Setting</a></b></p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><a href="" target="_parent" class="w3-padding-large w3-hover-white">Media</a></p>-->
         <p class="w3-small"><b><i class="fa fa-user fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_parent.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Parent</a></b></p>
         <p class="w3-small"><b><i class="fa fa-book fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_classe.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Filiere</a></b></p>
         <p class="w3-small"><b><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_etudiant.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Etudiant</a></b></p>
         <p class="w3-small"><b><i class="fa fa-money fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_payement.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Payement de scolarité</a></b></p>
         <p class="w3-small"><b><i class="fa fa-bar-chart-o fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_payement.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Statistiques</a></b></p>
         <hr>
         <p class="w3-small"><b><i class="fa fa-gear fa-fw w3-margin-right w3-text-teal"></i><a href="editionprofil.php" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Paramètres</a></b></p>
         <p class="w3-small"><b><i class="fa fa-sign-out fa-fw w3-margin-right w3-text-teal"></i><a href="deconnexion.php" target="_parent" class="w3-padding-large w3-hover-white" style="text-decoration:none;">Déconnexion</a></b></p>
          
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
      <?php   
            $bdd = new PDO('mysql:host=127.0.0.1; dbname=scolariteweb','root', '');
            $idp=$_GET['idp'];
            $_select = $bdd->prepare("SELECT * FROM payement WHERE idp=$idp ");
            $_select->execute();
            $_selecttu = $bdd->prepare("SELECT tut FROM etudiant,payement WHERE payement.mate=etudiant.identite AND idp=$idp ");
            $_selecttu->execute();
            $_selectmod = $bdd->prepare("SELECT DISTINCT(mo) FROM etudiant,payement WHERE payement.mate=etudiant.identite AND idp=$idp ");
            $_selectmod->execute();
            $_selectfor = $bdd->prepare("SELECT form FROM etudiant,payement WHERE payement.mate=etudiant.identite AND idp=$idp");
            $_selectfor->execute();
            $_selectsco = $bdd->prepare("SELECT sco FROM etudiant,payement WHERE payement.mate=etudiant.identite AND idp=$idp");
            $_selectsco->execute();
            $_selectmtr = $bdd->prepare("SELECT sum(mont) as mtr FROM etudiant,payement WHERE payement.mate=etudiant.identite AND mat=(select mat from etudiant,payement WHERE payement.mate=etudiant.identite and idp=$idp)");
            $_selectmtr->execute();
            while ($s=$_select->fetch(PDO::FETCH_OBJ)) {


          ?>  

      <div class="w3-container w3-card-2  w3-margin-bottom">
        <h2 class="w3-text-teal w3-padding-4" style="margin-left:30px;"><i>Envoi de notification du payement de l'étudiant(e) :  <?php echo $et=$s->mate;?>  </i></h2>
        <div class="w3-container">
          <div class="w3-row-padding w3-light-grey w3-padding-16 w3-container">
          <div class="w3-content">
           
            <form method="POST" action="">
              <?php while(($e=$_selectmod->fetch(PDO::FETCH_OBJ))){ ?>
               <!--<p><label>Modalite</label>-->
            <input type="hidden" class="w3-input" name="mod" value="<?php echo $e->mo ; ?>"/>
          </p>
              <?php while(($a=$_selectfor->fetch(PDO::FETCH_OBJ))){ ?>
              <p>
                <!--<label>Formation</label>-->
                <input type="hidden" name="form" class="w3-input" value="<?php echo $a->form ; ?>"> 
              </p><?php } ?>
              <?php while(($x=$_selectsco->fetch(PDO::FETCH_OBJ))){ ?>
              <p>
                <!--<label>Scolarite</label>-->
                <input type="hidden" name="sco"  class="w3-input" value="<?php echo $x->sco ; ?>">
              </p>
              <?php while ($l=$_selectmtr->fetch(PDO::FETCH_OBJ)) { ?>
              <p>
                <!--<label>Montant Réglé</label>-->
                <input type="hidden" name="mtr" class="w3-input" value="<?php echo $l->mtr ; ?>">
              </p>
              <p>
                <!--<label>Montant restant sur periode</label>-->
                <input type="hidden" name="mtp" class="w3-input" value="<?php echo ((($x->sco)/($e->mo))-($s->mont)) ; ?>">
              </p>
              <p>
                <!--<label>Montant restant sur scolarite</label>-->
                <input type="hidden" name="mts" class="w3-input" value="<?php echo (($x->sco)-($l->mtr)) ; ?>">
              </p>
             <p><!--<label>ID Etudiant</label>-->
          <input class="w3-input" type="hidden"  value="<?php echo $s->idp; ?>" readonly="true" name="idp"/></p>
          
          <p><label>Etudiant</label>
         <input class="w3-input" value="<?php echo $s->mate;?>" name="etu" id="etu" type="text" autocomplete="off" >
          </p>
          <?php while(($q=$_selecttu->fetch(PDO::FETCH_OBJ))){ ?>
          <p>
          <label>Tuteur ou Parent </label>
          <input class="w3-input" value="<?php echo $q->tut;?>" autocomplete="off" name="destinataire" type="text">
        </p>
        <?php }  ?>
        <p><label>Message</label><br><?php  ?>
          <textarea class="w3-large"  rows="6" cols="70" style="height: 200px;" name="message" > <?php  echo "Cher parent ou tuteur votre étudiant  ".$s->mate." a effectué(e) le payement de la scolarité au montant de " .$s->mont. " f CFA ce ".$s->ljr."."?>
             Situation financière.
              <?php echo "Pour la scolarite ".$x->sco." f CFA, le frais période par rapport à la modalité choisie est : ".($x->sco)/($e->mo)." f CFA . L'étudiant(e) ".$s->mate." a reglé :".$s->mont. " f CFA, le montant restant sur frais période est : ".((($x->sco)/($e->mo))-($s->mont))." f CFA . Le restant net à payer est : ".(($x->sco)-($l->mtr))." f CFA."
            ?> </textarea><?php } ?><?php } ?><?php } ?>
        </p>

              <button  type="submit" class="btn btn-success" name="envoi_message" >Informer le parent ou tuteur</button>
                
            </form>
            <br/>
            
            
            
              </div>
          </div>
        </div>
      </div>
      
        <?php 
      }
        ?>
        
  </div><br/>
</div>
        
      </div>
  
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div><br/>
    <?php
      if (isset($error))
      {?>
         <script>  alert('<?php  echo  $error  ;?>')</script>
      <?php   
      }?>
  <p class="w3-medium" style="margin-left:1150px;"><b><i class="fa fa fa-arrow-left fa-fw w3-margin-right w3-text-teal"></i><a href="etablissement_payement.php?id=<?php echo ($_SESSION['id']);?>" target="_parent" class="w3-padding-2" style="text-decoration:none;">Retour Payement</a></b></p>
  
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
<script>
  $(document).ready(function(){
    $('#etu').keyup(function(){
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
      $('#etu').val($(this).text());
      $('#etudiantList').fadeOut();
    });
  });
</script>