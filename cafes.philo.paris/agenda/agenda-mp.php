<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<br><br><br><br><br><br>
<h2>Maintenance agenda</h3>
<p>
<h3>Activités périodiques</h2>

<form method=post action=agenda-mp.php>
Ajouter une activité
<br> code : <input type=text name=code>
<br> <input type=text name=nieme> ième
<select name=jdls>
<?php
 $jours = array ('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
 for ($j=0; $j<7; $j++)
  echo '<option value=' . $j . '>' . $jours[$j] . '</option>\n'; 
?>
</select>
 du mois
<br> description :
<br>
<textarea name=descr rows=10 cols=60>
</textarea>
<br><input type=submit value='Enregistrer'>
</form>

<?php
 include ("platform.php");
 $jours = array ('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
 if (connexion() < 0)
  echo '<p>Erreur connexion';
 else
 {
  echo '<p>connexion';
  echo '<p>jdls=' . $_POST['jdls'];
  if (isset ($_POST['nieme']) && $_POST['nieme'] != '')
  {
   $req = 'DELETE FROM agendap WHERE code = \'' . $_POST['code'] . '\' AND nieme = ' . $_POST['nieme'] . ' AND jdls = ' . $_POST['jdls'];
   echo '<p>' . $req;
   query ($req);
   if (isset ($_POST['descr']) && $_POST['descr'] != '')
   {
    $req = 'INSERT INTO agendap (code, nieme, jdls, descr) VALUES (\'' . $_POST['code'] . '\', ' . $_POST['nieme'] . ', ' . $_POST['jdls'] . ', \'' . format_query(format_input($_POST['descr'])) . '\')';
    echo '<p>' . $req;
    query ($req);
   }
  }
  $req = 'SELECT * FROM agendap ORDER BY jdls';
  $data = query ($req);
  echo '<p>Activités : ';
  while ($r = fetch_object ($data))
  {
   echo '<li> ' . $r->nieme . 'ième ' . $jours[$r->jdls] . ' : ' . $r->code . ' : ' . $r->descr;

  }
 }
?>
</body>
</html>
