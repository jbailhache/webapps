<body>
<br><br><br><br><br><br>
<div align=center>

<?php
 include ('platform.php');

 if (!connexion())
  echo "*** ERREUR CONNEXION ***";

 /*echo "mode=[$mode]<br>";*/

 echo "_GET=<pre>";
 print_r($_GET);
 echo "</pre>";

 echo "_POST=<pre>";
 print_r($_POST);
 echo "</pre>";

 if ($_GET['acces'] == 'validation')
 {
  if (strlen($v_numero) > 0)
  {
   
   $req = "UPDATE blog SET visible = '$v_valeur' WHERE numero = '$v_numero'"; 
   $status = query ($req);
   /*
   echo $req;
   echo '->';
   echo $status;
   echo '<br>';
   */

   /*
   $req = "SELECT * FROM blog WHERE numero = $v_numero";
  
   $data = query ($req);
   $r = fetch_object ($data);
   
   $req1 = "DELETE FROM blog WHERE numero = $v_numero";
   $st1 = query ($req1);

   $req2 = "INSERT INTO blog (numero, date, titre, reponsea, modifde, motscles, auteur, motdepasse, visible, texte) VALUES (" . $r->numero . "," . $r->date . ",'" . $r->titre . "'," . $r->reponsea . "," . $r->modifde . ",'" . $r->motscles . "','" . $r->auteur . "','" . $r->motdepasse . "',1,'" . $r->texte . "')";
   $st2 = query ($req2);

   echo "<br>$req<br>$req1 -> ($st1)<br>$req2 -> ($st2)<br>";
   */
  }
 }

 function afficher_message ($r, $mode)
 {
  echo '<tr><td bgcolor="#ccddee" >';
  echo ' [';
  echo $r->numero;
  echo '] ';
  if ($r->modifde != 0)
   echo 'modification de [' . $r->modifde . '] ';
  if ($r->reponsea != 0) 
   echo 'en réponse à [' . $r->reponsea . '] '; 
  echo date ('d/m/Y h:i', $r->date);
  echo ' de ';
  echo $r->auteur;
  
  echo '<br>Mots-clés : ';
  echo $r->motscles;
  echo '<br><b>';
  echo $r->titre;
  echo '</b>';
  echo '<br>';
  /* if ($_GET['detail'] > 0) */
  if ($_GET['resume'] != 'oui')
   echo $r->texte;
  else
   echo '<a href=?mode=un&afnum=' . $r->numero . "&detail=1>Afficher l'article</a>";
  echo '<br><br>';
  echo '<table border=0><tr><td valign=top>';
  echo '<form method=post action=?mode=aucun>';
  echo '<input type=submit value="Répondre ou commenter">';
  echo '<input type=hidden name=operation value=repondre>';
  echo '<input type=hidden name=r_reponsea value="';
  echo $r->numero;
  echo '"><input type=hidden name=r_titre value="Re: ';
  echo $r->titre;
  echo '"><input type=hidden name=r_motscles value="';
  echo $r->motscles;
  echo '">';
  echo '</form>';
  echo '</td><td>';
  echo '<form method=post action=?mode=aucun>';
  echo '<input type=submit value="Modifier">';
  echo '<input type=hidden name=operation value=modifier>';
  echo '<input type=hidden name=m_numero value="';
  echo $r->numero;
  echo '"><input type=hidden name=m_titre value="';
  echo $r->titre;
  echo '"><input type=hidden name=m_reponsea value="';
  echo $r->reponsea;
  echo '"><input type=hidden name=m_motscles value="';
  echo $r->motscles;
  echo '"><input type=hidden name=m_auteur value="';
  echo $r->auteur;
  /*
  echo '"><input type=hidden name=m_motdepasse value="';
  echo $r->motdepasse;
  */
  echo '"><input type=hidden name=m_texte value="';
  /* if ($_GET['detail'] > 0) */
   echo $r->texte;
  echo '">';
  echo '</form>';
  
  if ($_GET['acces'] == 'validation')
  {
   echo '</td><td valign=top>';
   echo '<form method=post>';
   
   if ($r->visible == 0)
   {
      echo '<input type=submit value="Rendre visible">';
	echo '<input type=hidden name=v_valeur value=1>';   
   }
   else
   { 
      echo '<input type=submit value="Rendre invisible">';
	echo '<input type=hidden name=v_valeur value=0>'; 
   }
   echo '<input type=hidden name=acces value=validation>';
   echo '<input type=hidden name=v_numero value=' . $r->numero . '>';
   
  }  

  echo '</td></tr></table>';
  echo '</td></tr>';
 }

 function afficher_arbo ($n, $tri, $mode)
 {
   $req1 = "SELECT * FROM blog WHERE reponsea = $n";

   /*echo "mode=[$mode]<br>";*/
   if ($_GET['acces'] != 'validation')
    $req1 = $req1 . " AND visible = 1";

   /* echo "<br>$req1"; */

    if ($tri == 'recent')
     $req1 = $req1 . ' ORDER BY date DESC';
    else if ($tri == 'ancien')
     $req1 = $req1 . ' ORDER BY date';
    else if ($tri == 'titre')
     $req1 = $req1 . ' ORDER BY titre';
    else if ($tri == 'motscles')
     $req1 = $req1 . ' ORDER BY motscles';
    else if ($tri == 'auteur')
     $req1 = $req1 . ' ORDER BY auteur';

   /* echo $req1; */
   $data1 = query ($req1);
   while ($r1 = fetch_object($data1))
   {
    afficher_message ($r1, $mode);
    afficher_arbo ($r1->numero, $tri, $mode);
   }
  
 }

 function afficher_arbo_motcle ($n)
 {
  $req1 = 'SELECT * FROM motscles ORDER BY motcle WHERE reponsea = $n';
  $data1 = query ($req1);
  while ($r1 = fetch_object ($data1))
  {
     afficher_message ($r1);
     afficher_arbo_motcle ($r1->numero);
  }

 }

 /*if (connexion() > 0)*/
 {
  $tri=$_GET['tri'];

  if (strlen($_GET['mode']) > 0)
	$mode = $_GET['mode'];
  else if (strlen ($_POST['mode']) > 0)
	$mode = $_POST['mode'];

  if (strlen($_GET['operation'])>0)
	$operation = $_GET['operation'];
  else if (strlen($_POST['operation'])>0)
	$operation = $_POST['operation']; 

  if (strlen($_GET['numero_a_modifier'])>0)
	$numero_a_modifier = $_GET['numero_a_modifier'];
  else if (strlen($_POST['numero_a_modifier'])>0)
	$numero_a_modifier = $_POST['numero_a_modifier']; 

  if (strlen($_GET['r_titre']) > 0)
	$r_titre = $_GET['r_titre'];
  else if (strlen ($_POST['r_titre']) > 0)
	$r_titre = $_POST['r_titre'];

  if (strlen($_GET['r_motscles']) > 0)
	$r_motscles = $_GET['r_motscles'];
  else if (strlen ($_POST['r_motscles']) > 0)
	$r_motscles = $_POST['r_motscles'];

  if (strlen($_GET['r_reponsea']) > 0)
	$r_reponsea = $_GET['r_reponsea'];
  else if (strlen ($_POST['r_reponsea']) > 0)
	$r_reponsea = $_POST['r_reponsea'];
  
  if (strlen($tri) == 0)
   $tri = 'recent';

  /* echo 'mode=' . $_GET['mode']; */
  /* echo 'cbdetail=' . $_GET['cbdetail']; */

  ?>
  <form method=get>
	<table border=1 cellpadding=10>
	<tr>
	<td>Affichage des articles</td>
	<td>Ordre des articles</td>
	<td><input type=submit value="Afficher"></td>
	</tr><tr>
	<td valign=top>
	<!--Affichage des articles-->
	<input type=radio name=mode value="aucun"> Aucun 
	<br><input type=radio name=mode value="lin"> Linéaire
	<br><input type=radio name=mode value="arbo"> Arborescent
	<br><input type=radio name=mode value="un"> Un seul
	<br>Numéro : <input type=text name=afnum>
	</td><td valign=top>
	<!--Ordre des articles-->
	<input type=radio name=tri value="recent"> Du plus récent au plus ancien
	<br><input type=radio name=tri value="ancien"> Du plus ancien au plus récent
	<br><input type=radio name=tri value="motscles"> Mots clés
	<br><input type=radio name=tri value="titre"> Titre
	<br><input type=radio name=tri value="auteur"> Auteur
	</td><td valign=top>
	<!--
	<input type=checkbox name=detail value="1"> Afficher le texte
	-->
	<input type=checkbox name=resume value=oui> Affichage résumé
	</td>
	</tr></table>
  </form>
  <?php

  echo '<table border=5 bordercolor=blue bgcolor=blue cellspacing=4 cellpadding=20>';

  if (strlen($mode) == 0)
   $mode = 'arbo';

  if ($mode == 'un')
  {
   $req = 'SELECT * FROM blog WHERE numero = ' . $_GET['afnum'];
   $data = query ($req);
   while ($r = fetch_object ($data))
   {
    afficher_message ($r, $mode);
   }

  }
  else if ($mode == 'lin')
  {


   if ($tri == 'motcle')
   {
    $req = 'SELECT * FROM motscles ORDER BY motcle';
    $data = query ($req);
    while ($r = fetch_object ($data))
    {
     afficher_message ($r);
    }
   }

   else
   {

    $req = 'SELECT * FROM blog';
    if ($_GET['acces'] != 'validation')
     $req = $req . ' WHERE visible = 1';
    if ($tri == 'recent')
     $req = $req . ' ORDER BY date DESC';
    else if ($tri == 'ancien')
     $req = $req . ' ORDER BY date';
    else if ($tri == 'titre')
     $req = $req . ' ORDER BY titre';
    else if ($tri == 'motscles')
     $req = $req . ' ORDER BY motscles';
    else if ($tri == 'auteur')
     $req = $req . ' ORDER BY auteur';
    /*echo $req;*/

    $data = query ($req);
    while ($r = fetch_object ($data))
    {
     afficher_message ($r, $mode);
    }

   }


  }
  else if ($mode == 'arbo') 
  {
    if ($tri == 'motcle')
    {
     afficher_arbo_motcle (0);
    }
    else
    {
     afficher_arbo (0, $tri, $mode);
    }
  }

  echo '</table>';
  
 }


/***********************************/


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

  /*echo '<br>enreg=' . $enreg . ' operation=' . $operation . '<br>';*/
  /*
  if ($enreg == 'oui')
   $operation = 'nouveau';
  */
?>

<form method=post>

<input type=hidden name=operation value=<?php echo $operation; ?>>

<input type=hidden name=enreg value=oui>

<input type=hidden name=numero_a_modifier value="<?php 
 if ($operation == 'modifier')
  echo $m_numero;
 ?>">
 
<h3>Poster un article</h3>
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
	echo $req;
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



?>
<br>
<!--
<a href=gestion.php?operation=nouveau>Nouvel article</a>
-->
<br>
</div>
</body>
