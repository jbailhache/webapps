<?php
 function filter1($in) {
	$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
	$replace = array ('e','a','i','u','o','c','_','');
	return preg_replace($search, $replace, $in);
}

function filter2($txt) {
  $masque = "[?!]";
  $txt = eregi_replace($masque, "", $txt);

  $masque = "[àâä@]";
  $txt = eregi_replace($masque, "a", $txt);

  $masque = "[éèêë€]";
  $txt = eregi_replace($masque, "e", $txt);

  $masque = "[ïì]";
  $txt = eregi_replace($masque, "i", $txt);

  $masque = "[ôö]";
  $txt = eregi_replace($masque, "o", $txt);

  $masque = "[ùûü]";
  $txt = eregi_replace($masque, "u", $txt);

  $masque = "[ç]";
  $txt = eregi_replace($masque, "c", $txt);

  $masque = "[&]";
  $txt = eregi_replace($masque, "et", $txt);

  $masque = " +";
  $txt = eregi_replace($masque, "_", $txt);

  return(strtolower($txt));
  }

function filter($in) {
	$search = array ('@[ ]@i','@[^a-zA-Z0-9_-éèêëÊËàâäÂÄîïÎÏûùüÛÜôöÔÖç]@');
	$replace = array ('_','');
	return preg_replace($search, $replace, $in);
}

 echo filter("José Duv@l");
?>

