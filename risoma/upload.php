<?php
 include ("platform.php");
 include ("util.php");

 function head()
 {
  echo "
<html>
<head>
<title>Menu principal</title>
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
  $nick = $_SESSION['nick'];

  $s = connexion();

  $fnick = get_fnick($nick);
 
$dossier = 'upload/' . $fnick . '/';
mkdir ($dossier, 0777, true);
// $fichier = basename($_FILES['image']['name']);
$fichier = $fnick;
$taille_maxi = 1000000;
$taille = filesize($_FILES['image']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['image']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
$fichier = $fichier . $extension;
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     /* $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); */
     $fichier = $_FILES['image']['name'];
     $f1 = $_FILES['image']['tmp_name'];
     /* echo "<p>f1=($f1)";*/
     $f2 = $dossier . $fichier;
     echo "<p>copie ($f1) -> ($f2)<p>";
     /*
     echo "_FILES=(";
     print_r($_FILES);
     echo ")<p>";
     */
     if(move_uploaded_file($f1,$f2)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
	  $q = "UPDATE " . $prefix . "members SET image = '$f2' WHERE fnick = '$fnick'";
	  query ($q);
          echo 'Upload effectu&eacute; avec succ&egrave;s !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}
}
?>
<p>
<a href=menu.php>Retour au menu principal</a>
</body>
</html>

