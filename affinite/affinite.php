<HTML>
<head>
<title>Affinit�</title>
</head>
<body>
<h3>Affinit�</h3>
<form method=post action=enraf.php>

<?php
 include ("util.php");
 if (connexion() > 0)
 {
  if ($afpseudo == "")
  {
   echo ("<a href=ident.php>Identifiez-vous</a> d'abord si vous �tes inscrit, sinon <a href=inscrip.php>inscrivez-vous</a>.");
  }
  else
  {
  echo ("<input type=hidden name=action value=$action>");
  if ($action == "inscription")
  {
   echo ("<p>Indiquez les renseignements vous concernant ci-dessous : <p>");
   echo ("<p>Vous pouvez donner un nom � ce profil : <input type=text name=profil><p>");
  }
  if ($action == "recherche")
  {
   echo ("<p>Vous pouvez donner un nom au profil recherch� : <input type=text name=profil><p>");
  }
   echo ("<p>Commencez par cr�er les r�ponses manquantes en cliquant sur \"autre\".");
   echo ("Ensuite cochez votre but ou vos buts.");
   echo ("Puis indiquez dans les cases � gauche de chaque r�ponse si cette r�ponse correspond.<p>");
   echo ("Vous pouvez r�pondre oui, non, un peu, beaucoup, pas du tout, ou une valeur num�rique (0 pour non, 1 pour oui, 0.5 pour un peu, 2 pour beaucoup...)<p>");
   echo ("<h4>Attention : Vous devez d'abord ajouter toutes les questions et r�ponses manquantes avant de commencer � r�pondre !</h4><p>");

   echo ("Votre but :<ul>");
   $query = "SELECT * FROM afbut";
   $data = mysql_query ($query);
   while ($rec = mysql_fetch_object ($data))
   {
    $butvar = varencode ($rec->but);
    echo ("<li><input type=checkbox name=$butvar value=yes> $rec->but");
   }
   echo ("<li> <a href=crebut.php?action=$action>autre</a>");
   echo ("</ul>");
  
  $query = "SELECT * FROM afcateg ORDER BY position";
  $data = mysql_query ($query);
  while ($rec = mysql_fetch_object ($data))
  {
   echo ("<p> [$rec->position] ");
   echo ($rec->categorie);
   echo (" : <ul>");
   $query1 = "SELECT * FROM afcarac WHERE categorie = '$rec->categorie' ORDER BY caractere";
   /*echo ($query1);*/
   $data1 = mysql_query ($query1);
   while ($rec1 = mysql_fetch_object ($data1))
   {
    echo ("<li> ");
    echo (" <input type=text name=");
    $caracvar = varencode ($rec->categorie) . varencode ($rec1->caractere);
    echo ($caracvar);
    /*echo ($rec1->caractere);*/
    echo (" size=10> ");
    echo ($rec1->caractere);
   }
   $categurl = urlencode ($rec->categorie);
   echo ("<li> <a href=crecarac.php?action=$action&categorie=$categurl>autre</a></ul>");
  }
  echo ("<p><a href=crecateg.php?action=$action>Ajouter une question</a>");
  echo ("<p><input type=submit value=Valider></form>");
 }
 }

?>
<p>

<a href="index.php">Retour au sommaire</a>
<p>
<a href="http://teledev.multimania.com/log/">log</a> Ne passez pas � c�t� des choses compliqu�es !

</body>
</HTML>



