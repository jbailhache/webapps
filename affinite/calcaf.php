<HTML>
<head>
<title>Calcul d'affinit�</title>
</head>
<body>
<h3>Calcul d'affinit� entre deux profils</h3>
<?php
 include ("util.php");
 include ("utilaf.php");
 echo ("<ul><li>But : $but");
 echo ("<li> Premier profil : $action1 de $pseudo1 $profil1");
 echo ("<li> Second profil  : $action2 de $pseudo2 $profil2</ul>");
 $af = affinite ($but, $action1, $pseudo1, $profil1, $action2, $pseudo2, $profil2);
 echo ("<p>Coefficient d'affinit� : $af.");
?>
<p>
<a href=index.php>Retour au sommaire</a>
<p>
<b><a href="http://teledev.multimania.com/log/">log</a></b> Ne passez pas � c�t� des choses compliqu�es !

</body>
</HTML>

