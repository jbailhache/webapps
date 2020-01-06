<body>

<br><br><br><br><br><br>

<?php
 include ('platform.php');
 if (connexion() > 0)
 {
  $titre = $_POST['titre'];
  $motscles = $_POST['motscles'];
  $texte = $_POST['texte'];
  $motdepasse = $_POST['motdepasse'];
/*
  $r_titre = $_POST['r_titre'];
  $r_motscles = $_POST['r_motscles'];
  $r_reponsea = $_POST['r_reponsea'];
*/
  if ($r_reponsea == '')
   $r_reponsea = '0';
  if ($numero_a_modifier == '')
   $numero_a_modifier = '0';

  echo '<br>enreg=' . $enreg . ' operation=' . $operation . '<br>';
  /*
  if ($enreg == 'oui')
   $operation = 'nouveau';
  */
?>

<form method=post action=gestion.php>

<input type=hidden name=operation value=<?php echo $operation; ?>>

<input type=hidden name=enreg value=oui>

<input type=hidden name=numero_a_modifier value="<?php 
 if ($operation == 'modifier')
  echo $m_numero;
 ?>">
 
Titre : <input type=text name=titre size=60 value="<?php 
 if ($operation == 'repondre')
  echo $r_titre;
 else if ($operation == 'modifier')
  echo $m_titre;
?>"><br>
Auteur : <input type=text name=auteur size=60 value="<?php
 if ($operation == 'modifier')
  echo $m_auteur;
?>"><br>
Mot de passe : <input type=password name=motdepasse size=60><br>
<br>
En réponse à l'article numéro : <input type=text name=reponsea value="<?php 
 if ($operation == 'repondre')
  echo $r_reponsea;
 else if ($operation == 'modifier')
  echo $m_reponsea;
 else
  echo '0';
 ?>"><br>
Mots clés : <input type=text name=motscles size=60 value="<?php 
 if ($operation == 'repondre')
  echo $r_motscles;
 else if ($operation == 'modifier')
  echo $m_motscles;
?>">
<br>
Texte : <input type=submit value="Enregistrer">
<br>
<textarea rows=20 cols=60 name=texte>
<?php
 if ($operation == 'modifier')
  echo $m_texte;
?>
</textarea>
<br>

</form>

<?php
  /* if (strlen($titre) > 0) */
  if ($enreg == 'oui')
  {
   $auj = time();
   echo date ("d/m/Y",$auj);
   echo '<br>';
   
   /*
   $req = "DELETE FROM blog WHERE titre = '$titre'";
   $status = query ($req);
   if (strlen($texte) > 0) 
   */

   echo '<br>operation='.$operation.'<br>';
   if ($operation == 'modifier')
   {
    $req = "DELETE FROM blog WHERE numero = $numero_a_modifier AND motdepasse = '$motdepasse'";
    echo '<br>' . $req . '<br>';
    $status = query ($req);
   }
   if ($operation != 'modifier' || strlen($texte) > 0)
   {
    $req = "INSERT INTO blog (titre, reponsea, modifde, motscles, auteur, motdepasse, texte, visible, date) VALUES ('$titre', $reponsea, $numero_a_modifier, '$motscles', '$auteur', '$motdepasse', 0, '$texte', $auj)";
    $status = query ($req);
    if (!$status)
    {
     echo ("Erreur enregistrement message<br>");
     echo $req;
    }
    else
    {
     echo ("Message enregistré<br>");
     echo $req;
    }
    $tok = strtok ($motscles,';');
    while ($tok && strlen($tok)>0)
    {
     echo "<br>[$tok]";
     $req1 = "INSERT INTO motscles (motcle, motscles, titre, reponsea, auteur, motdepasse, texte, date) VALUES ('$tok', '$motscles', '$titre', $reponsea, '$auteur', '$motdepasse', '$texte', $auj)";
     echo $req1;
     $status = query ($req1);
     $tok = strtok (';');
    }
   }
  }
 }
?>

</body>
