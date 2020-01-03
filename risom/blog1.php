<?php

 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Informations concernant un membre</title>
</head>
<body>
";
 }

 session_start();
 if(!isset($_SESSION['nick'])) 
 {
  head();
  echo "<p>Vous n'&ecirc;tes pas identifi&eacute;<p><a href=index.php>Cliquez ici pour vous identifier</a>";
  /* print_r($_SESSION); */
 }
 else
 {
  head();
  echo "<p><h3>Je suis " . $_SESSION['nick'] . "</h3>";
  echo "<a href=menu.php>Retour au menu principal</a>";
  $mynick = $_SESSION['nick'];

  $s = connexion();

  $myfnick = get_fnick($mynick);
  if (isset ($_GET['hisfnick']))
  {
   $hisfnick = $_GET['hisfnick'];
  }
  else if (isset ($_POST['hisfnick']))
  {
   $hisfnick = $_POST['hisfnick'];
  }
  else
  {
   $hisfnick = ''; 
  }

 if (trace()) echo "<p>hisfnick=($hisfnick)";

 $forum = 'reflexions';
 if (strlen($_GET['forum']) > 0)
  $forum = $_GET['forum'];
 else if (strlen($_POST['forum']) > 0)
  $forum = $_POST['forum'];

$titrepage = 'Blog';
if (strlen($_GET['titrepage']) > 0)
 $titrepage = $_GET['titrepage'];
else if (strlen($_POST['titrepage']) > 0)
 $titrepage = $_POST['titrepage']; 

$m_numero = $_POST['m_numero'];
$m_titre = $_POST['m_titre'];
$m_auteur = $_POST['m_auteur'];
$m_motscles = $_POST['motscles'];

$validauto = 1;

/*
 if (!connexion())
  echo "*** ERREUR CONNEXION ***";
*/

?>

<html>
<head>
<title><?php echo $titrepage; ?></title>
</head>
<body>
<br><br><br><br><br><br>

<div align=center>

<?php

 if ($_GET['acces'] == 'validation')
 {
  if (strlen($v_numero) > 0)
  { 
   $req = "UPDATE " . $prefix . "blog SET visible = '$v_valeur' WHERE fnick = '$hisfnick' AND forum = '$forum' and numero = '$v_numero'"; 
   $status = query ($req);
  }
 }

 function afficher_message ($r, $mode)
 {
  global $hisfnick;
  if (strlen($_GET['afjour1'])>0)
  {
   $date1=mktime(0,0,0,$_GET['afmois1'],$GET['afjour1'] ,$_GET['afannee1']);
   $date2=mktime(23,59,59,$_GET['afmois2'],$_GET['afjour2'],$_GET['afannee2']);
   if ($r->date<$date1 || $r->date>$date2)
    return;
  }
  if ($_GET['afsansrep'] == 'oui' && $r->reponsea != 0)
   return;
  if (strlen($r->texte)==0)
   return;
  echo '<tr><td bgcolor=#eecc66>';
  echo '[';
  echo $r->numero;
  echo '] posté par ';
  echo $r->auteur;
  echo ' le ';
  echo date ('d/m/Y H:i', $r->date);
  
  if ($r->reponsea != 0) 
   echo '<br>en réponse à [' . $r->reponsea . '] '; 
  
  echo '<br>Mots-clés : ';
  echo $r->motscles;
  echo '<br><b>';
  echo $r->titre;
  echo '</b>';
  echo '<br>';

  if ($_GET['resume'] != 'oui')
   echo '<br>' . $r->texte;
  else
   echo '<a href=?mode=un&afnum=' . $r->numero . "&detail=1>Afficher l'article</a>";
  echo '<br><br>';
  echo '<table border=0><tr><td valign=top>'; 
  echo '<form method=post action=?mode=aucun>';
  echo '<input type=hidden name=hisfnick value="' . $hisfnick . '">';
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
  echo '</td><td valign=top>'; 
  echo '<form method=post action=?mode=aucun>';
  echo '<input type=hidden name=hisfnick value="' . $hisfnick . '">';
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
 
  echo '">';
  
  echo '</form>';
  
  if ($_GET['acces'] == 'validation')
  {
   echo '</td><td valign=top>'; 
   echo '<form method=post>';
   echo '<input type=hidden name=hisfnick value="' . $hisfnick . '">';
   
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
   global $forum;
   global $prefix;
   global $hisfnick;

   $req1 = "SELECT * FROM " . $prefix . "blog WHERE fnick = '$hisfnick' AND forum = '$forum' AND reponsea = $n";

   if ($_GET['acces'] != 'validation')
    $req1 = $req1 . " AND visible = 1";

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

   $data1 = query ($req1);

   if (strlen($_GET['afnombre']) == 0)
    $max=100;
   else
    $max=$_GET['afnombre'];

   $i = 0;
   while ($r1 = fetch_object($data1))
   {
    $i += 1;
    if ($i > $max) break;
    if ($n == 0 && $i > 1)
    {
	
	echo '</table><br>';
      echo '<table border=3 bordercolor=#776622 bgcolor=#776622 cellspacing=4 cellpadding=20>';
	
    }
    if ($_GET['afrepavant'] == 'oui')
    {
     afficher_arbo ($r1->numero, $tri, $mode);
     afficher_message ($r1, $mode);
    }
    else
    {
     afficher_message ($r1, $mode);
     afficher_arbo ($r1->numero, $tri, $mode);
    }
   }
  
   
 }

 function afficher_arbo_motcle ($n)
 {
  global $prefix;
  global $hisfnick;
  $req1 = "SELECT * FROM " . $prefix . "motscles ORDER BY motcle WHERE fnick = '$hisfnick' AND reponsea = $n";
  $data1 = query ($req1);
  while ($r1 = fetch_object ($data1))
  {
     afficher_message ($r1);
     afficher_arbo_motcle ($r1->numero);
  }

 }

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
/* 270 */
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

  ?>

<h2><?php echo $titrepage . " de " . $hisfnick; ?></h2>

<!-- formulaire nouvel article -->

<table border=3 bordercolor=#776622 bgcolor=#eecc66>
<tr><td>

<?php if (trace ()) echo "<p>hisfnick=($hisfnick)"; ?>

<form method=post action="?mode=arbo&enreg=oui">
<input type=hidden name=hisfnick value="<?php echo $hisfnick; ?>">

<input type=hidden name=forum value="<?php echo $forum; ?>">
<input type=hidden name=titrepage value="<?php echo $titrepage; ?>">

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
Texte : 
<br>
<textarea rows=20 cols=60 name=texte>
<?php
 if ($operation == 'modifier')
 {
  /* echo '/' . $m_numero . '/' . $_POST['m_numero'] . '/' . $_GET['m_numero'] . '/'; */
  $req="SELECT * FROM " . $prefix . "blog WHERE fnick = '$hisfnick' AND forum = '$forum' AND numero = $m_numero";
  /* echo $req; */
  $data=query($req);
  $r=fetch_object($data);
  echo $r->texte;
 }
  

?>
</textarea>
<br>
<input type=submit value="Envoyer">

</form>

</td></tr>
</table>

<br>

<!-- options d'affichage -->

<h3>Options d'affichage</h3>

  <form method=get>
	<input type=hidden name=hisfnick value="<?php echo $hisfnick; ?>">
	<input type=hidden name=forum value="<?php echo $forum; ?>">
	<input type=hidden name=titrepage value="<?php echo $titrepage; ?>">

	<table border=3 cellpadding=10 bordercolor=#776622 bgcolor=#eecc66>
	<tr>
	<td>Affichage des articles</td>
	<td>Ordre des articles</td>
	<td>Autres options</td>
	</tr><tr>
	<td valign=top>
	<!--Affichage des articles-->
	<input type=radio name=mode value="arbo"<?php 
		if ($_GET['mode'] == 'arbo') echo ' checked';
	?>> Arborescent (articles suivis de leurs réponses)
	<br><input type=radio name=mode value="lin"<?php
                if ($_GET['mode'] == 'lin') echo ' checked';
	?>> Linéaire (sans tenir compte des réponses)	
	<br><input type=radio name=mode value="un"<?php
		if ($_GET['mode'] == 'un') echo ' checked';
	?>> Un seul article :
	numéro <input type=text name=afnum size=8 value="<?php echo $_GET['afnum']; ?>">
      <br><input type=radio name=mode value="aucun"<?php
		if ($_GET['mode'] == 'aucun') echo ' checked';
	?>> Aucun 
	</td><td valign=top>
	<!--Ordre des articles-->
	<input type=radio name=tri value="recent"<?php
		if ($_GET['tri'] == 'recent') echo ' checked';
	?>> Du plus récent au plus ancien
	<br><input type=radio name=tri value="ancien"<?php
		if ($_GET['tri'] == 'ancien') echo ' checked';
	?>> Du plus ancien au plus récent
	<br><input type=radio name=tri value="motscles"<?php
		if ($_GET['tri'] == 'motscles') echo ' checked';
	?>> Mots clés
	<br><input type=radio name=tri value="titre"<?php
		if ($_GET['tri'] == 'titre') echo ' checked';
	?>> Titre
	<br><input type=radio name=tri value="auteur"<?php
		if ($_GET['tri'] == 'auteur') echo ' checked';
	?>> Auteur
	</td><td valign=top>
	<!--
	<input type=checkbox name=detail value="1"> Afficher le texte
	-->
	<input type=checkbox name=resume value=oui<?php
		if ($_GET['resume'] == 'oui') echo ' checked';
	?>> Affichage résumé (sans le texte)
	<br>
	<input type=checkbox name=afrepavant value=oui<?php
		if ($_GET['afrepavant'] == 'oui') echo ' checked';
	?>> Afficher les réponses avant
	<br>
	<input type=checkbox name=afsansrep value=oui<?php
		if ($_GET['afsansrep'] == 'oui') echo ' checked';
	?>> Ne pas afficher les réponses
	<br>
	Afficher les <input type=text name=afnombre size=8 value="<?php
         echo $_GET['afnombre']; ?>"> premiers articles
      <br>
	<table><tr><td>
	Date entre le </td><td>
	<input type=text name=afjour1 size=2 value="<?php echo $_GET['afjour1']; ?>">/<input type=text name=afmois1 size=2 value="<?php echo $_GET['afmois1']; ?>">/<input type=text name=afannee1 size=4 value="<?php echo $_GET['afannee1']; ?>">
	</td></tr><tr><td>
	et le </td><td>
	<input type=text name=afjour2 size=2 value="<?php echo $_GET['afjour2']; ?>">/<input type=text name=afmois2 size=2 value="<?php echo $_GET['afmois2']; ?>">/<input type=text name=afannee2 size=4 value="<?php echo $_GET['afannee2']; ?>">
	</td></tr></table>

	</td>
	</tr></table>
	<input type=submit value="Afficher">
  </form>
  <?php

  echo '<table border=3 bordercolor=#776622 bgcolor=#776622 cellspacing=4 cellpadding=20>';

  if (strlen($mode) == 0)
   $mode = 'arbo';

  if ($mode == 'un')
  {
   $req = "SELECT * FROM " . $prefix . "blog WHERE fnick = '$hisfbick' AND numero = " . $_GET['afnum'];
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
    $req = "SELECT * FROM " . $prefix . "motscles WHERE fnick = '$hisfnick' ORDER BY motcle";
    $data = query ($req);
    while ($r = fetch_object ($data))
    {
     afficher_message ($r);
    }
   }

   else
   {

    $req = "SELECT * FROM " . $prefix . "blog WHERE fnick = '$hisfnick' AND forum = '$forum'";
    if ($_GET['acces'] != 'validation')
     $req = $req . ' AND visible = 1';
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
    $n=0;
    if (strlen($_GET['afnombre'])==0)
     $max=100;
    else
     $max=$_GET['afnombre'];
    while ($r = fetch_object ($data))
    {
     $n += 1;
     if ($n > $max) break;
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
  $reponsea = $_POST['reponsea'];
  $motscles = $_POST['motscles'];
  $auteur = $_POST['auteur'];
  $texte = $_POST['texte'];
  $motdepasse = $_POST['motdepasse'];

  if ($r_reponsea == '')
   $r_reponsea = '0';
  if ($numero_a_modifier == '')
   $numero_a_modifier = '0';

  ?>

<?php
  $enreg = $_GET['enreg'];
  /* echo "<p>enreg=($enreg)"; */
  if ($enreg == 'oui')
  {
   $auj = time();
   echo date ("d/m/Y",$auj);
   echo '<br>';
   
   if ($trace)
   {
    echo '<br>operation='.$operation.'<br>';
   }
   if ($operation == 'modifier')
   {
    $req = "DELETE FROM " . $prefix . "blog WHERE fnick = '$hisfnick' AND forum = '$forum' AND numero = $numero_a_modifier AND motdepasse = '$motdepasse'";
    echo '<br>' . $req . '<br>';
    $status = query ($req);
   }

   {

    $titre1 = treat_string ($titre);
    $auteur1 = treat_string ($auteur);
    $texte1 = treat_string ($texte);

    $req = "INSERT INTO " . $prefix . "blog (fnick, numero, forum, titre, reponsea, modifde, motscles, auteur, motdepasse, visible, texte, date) VALUES ('$hisfnick', $numero_a_modifier, '$forum', '$titre1', $reponsea, $numero_a_modifier, '$motscles', '$auteur1', '$motdepasse', $validauto, '$texte1', $auj)";
    /* echo $req; */
    $status = query ($req);
    if (!$status)
    {
     echo ("Erreur enregistrement article<br>");
     echo $req;
    }
    else
    {
     echo ("Article enregistré<br>");
     if ($trace) echo $req;
    }
    $tok = strtok ($motscles,';');
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
</html>
