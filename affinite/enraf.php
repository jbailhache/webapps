<HTML>
<head>
<title>Enregistrement du profil</title>
</head>
<body>
<?php
 include ("util.php");
 connexion();
 $queryprofil = "INSERT INTO afprofil (profil, pseudo, action) VALUES ('$profil', '$afpseudo', '$action')";
 $r = mysql_query ($queryprofil);
 if (!$r)
  echo ("<p>Requ�te $queryprofil incorrecte.");

 $querybut = "SELECT * FROM afbut";
 $databut = mysql_query ($querybut);
 /*echo ("amiti�: $amiti�<p>");*/
 while ($recbut = mysql_fetch_object ($databut))
 {
   $butvar = varencode ($recbut->but);
   $instr = "\$x = $$butvar;";
   /*echo ($instr);*/
   eval ($instr); 
   /*echo ("<p>$x $recbut->but");*/
   if ($x == "yes")
   {
    echo ("<p>But $recbut->but s�lectionn�");  

    $querycateg = "SELECT * FROM afcateg";
    $datacateg = mysql_query ($querycateg);
    while ($reccateg = mysql_fetch_object ($datacateg))
    {
     /*echo ("<p>Cat�gorie $reccateg->categorie");*/
     $querycarac = "SELECT * FROM afcarac WHERE categorie = '$reccateg->categorie' ORDER BY caractere";
     /*echo ($query1);*/
     $datacarac = mysql_query ($querycarac);
     while ($reccarac = mysql_fetch_object ($datacarac))
     {
      /*echo ("<p>Caract�re $reccarac->caractere");*/
      $caracvar = varencode ($reccateg->categorie) . varencode ($reccarac->caractere);
      $instr = "\$reponse = $$caracvar;";
      /*echo ("<p>instr = $instr.");*/
      $reponse = "";
      eval ($instr);
      if ($reponse != "")
      {
       $valeur = valnum ($reponse);
       echo ("<p>R�ponse pour $reccateg->categorie $reccarac->caractere = $reponse, valeur = $valeur.");
       $queryaf = "INSERT INTO affinite (action, pseudo, profil, but, categorie, caractere, reponse, valeur) VALUES ('$action', '$afpseudo', '$profil', '$recbut->but', '$reccateg->categorie', '$reccarac->caractere', '$reponse', '$valeur')";
       //echo ("<p>MySQL $queryaf.");
       $r = mysql_query ($queryaf);
       if (!$r)
        echo ("<p>Requete $queryaf incorrecte.");
      }
     }

    }
   }
 }
 echo ("<p>Profil enregistr�.<p><a href=index.php>Retour au sommaire</a>");
?>
</body>
</HTML>
