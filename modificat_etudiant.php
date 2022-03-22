<div id="<?php echo $s->mat;?>" class="w3-modal w3-animate-opacity">
    <div class="w3-modal-content w3-card-8">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('<?php echo $s->mat;?>').style.display='none'" class="w3-closebtn">&times;</span>
		
        <h2>Operation: Modification/Suppression</h2>
      </header><br/>
    <div class="w3-container">
        
          <form class="w3-container" method="POST" action="">
          <p>
          <input type="hidden"  value="<?php echo $s->mat; ?>" readonly="true" name="code">
          <label>Nom</label>
          <input class="w3-input" value="<?php echo $s->no;?>" name="nom" type="text"></p>
          <p>
          <label>Prenom 1</label>
          <input class="w3-input" value="<?php echo $s->pr;?>" name="pre" type="text"></p>
          <p>
          <label>Prenom 2</label>
          <input class="w3-input" value="<?php echo $s->pre;?>" name="pre1" type="text"></p>
          <p>
          <label>Sexe</label>
          <select name="sx" class="w3-select"  id="sx" >
              <option><?php echo $s->se;?></option>
              <option value="Masculin">Masculin</option>
              <option value="Féminin">Féminin</option>
              </select>
          </p>
          <p>
          <label>Date de naissance</label>
          <input class="w3-input" value="<?php echo $s->dn;?>" name="dt" type="date"></p>
          <p>
          <label>Contact</label>
          <input class="w3-input" value="<?php echo $s->te;?>" name="ct" type="tel"></p>
          <p>
          <label>Modalite</label>
          <input class="w3-input" value="<?php echo $s->mo;?>" name="md" type="number"></p>
          <p>
          <label>Filiere</label>
          
          <select name="fil" class="w3-select"  id="fil" >
                    <option><?php echo $s->fil;?></option>
              <?php
         
                   $_select=$bdd->query("SELECT lib  FROM filiere");
                   while($s = $_select->fetch(PDO::FETCH_OBJ)) 
                   {
              ?>
                    <option><?php echo $s->lib; ?></option>
                   <?php
                   }
                   ?>
              
          </select>
          </p>
          <p>
          <label>Tuteur</label>
              <select  class="w3-select" name="tut">
                    <option><?php echo $s->tut; ?></option>
              <?php
         
                  $_select=$bdd->query("SELECT concat(nom,'    ',prenom,'   ',mail) as tu FROM tuteur");
                  while ($s = $_select->fetch(PDO::FETCH_OBJ)) {
              ?>
                    <option><?php echo $s->tu; ?></option>
                   <?php
                   }
                   ?>
              </select>
          </p>
		
          <button class="button button2" name="valider" >Modifier</button>
          <button class="button button3" name="supprimer" >Supprimer</button>
       
			<?php

					if(isset($_POST['valider']))
					{
					  $idt=$_POST['code'];
					  $nom = htmlspecialchars(trim($_POST['nom']));
					  $pre = htmlspecialchars(trim($_POST['pre']));
					  $pre1 = htmlspecialchars(trim($_POST['pre1']));
					  $sx = $_POST['sx'];
					  $dt = $_POST['dt'];
					  $ct= $_POST['ct'];
					  $md = $_POST['md'];
					  $fil = $_POST['fil'];
					  $tut = $_POST['tut'];
					  $_update = $bdd->prepare("UPDATE etudiant SET no='$nom', pr='$pre', pre='$pre1', se='$sx', dn='$dt', te='$ct', mo='$md', fil='$fil', tut='$tut' WHERE mat=$idt ");
					  $_update->execute();
					
					}
				   if(isset($_POST['supprimer']))
				   {
					$idt=$_POST['code'];
					 $_delete = $bdd->prepare("DELETE  FROM etudiant WHERE mat=$idt");
					 $_delete->execute();
				   }
			?>
			    
        </form>
    </div>
   </div>
 </div><