<?php

function trace ()
{
 return 0;
}

function get_fnick ($nick)
{
  global $prefix;
  $q = "SELECT * FROM " . $prefix . "members WHERE nick = '$nick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $fnick = $r->fnick;
  return $fnick;
}

function get_nick ($fnick)
{
  global $prefix;
  $q = "SELECT * FROM " . $prefix . "members WHERE fnick = '$fnick'";
  $d = query ($q);
  $r = fetch_object ($d);
  $nick = $r->nick;
  return $nick;
}

function get_distance ($myfnick, $hisfnick)
{
 global $prefix;
 /*
 $myfnick = get_fnick ($mynick);
 $hisfnick = get_fnick ($hisnick);
 */
 if ($myfnick == $hisfnick)
  return 0;
 $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$myfnick' AND hisfnick = '$hisfnick' AND hisurl = ''";
 $d = query ($q);
 $r = fetch_object($d);
 $dist = $r->distance;
 if ($dist)
  return $dist;
 else
  return 40;
}

function get_distance_remote ($myfnick, $hisfnick, $hisurl)
{
 global $prefix;
 /*
 $myfnick = get_fnick ($mynick);
 $hisfnick = get_fnick ($hisnick);
 */
 if ($myfnick == $hisfnick)
  return 0;
 $q = "SELECT * FROM " . $prefix . "distances WHERE myfnick = '$myfnick' AND hisfnick = '$hisfnick' AND hisurl = '$hisurl'";
 $d = query ($q);
 $r = fetch_object($d);
 $dist = $r->distance;
 if ($dist)
  return $dist;
 else
  return 40;
}

function is_member ($group, $fnick)
{
 global $prefix;
 $q = "SELECT * FROM " . $prefix . "groups_members WHERE groupname = '$group' AND fnick = '$fnick' AND url = ''";
 $d = query ($q);
 $r = fetch_object ($d);
 return $r;
}

function is_member_remote ($group, $fnick, $url)
{
 global $prefix;
 $q = "SELECT * FROM " . $prefix . "groups_members WHERE groupname = '$group' AND fnick = '$fnick' AND url = '$url'";
 $d = query ($q);
 $r = fetch_object ($d);
 return $r;
}

function remote_is_member ($myfnick, $url, $group, $fnick)
{
    global $prefix;
    $localurl = get_local_url();
    $q = "SELECT * FROM " . $prefix . "outgoing WHERE fnick = '$myfnick' AND url = '$url'";
    if (trace()) { echo "<p>$q"; }
    $d = query ($q);
    $r = fetch_object ($d);
    if ($r)
    {
     $mypass = $r->pass;

     $urlask = $url . "ask_is_member.php?myfnick=$myfnick&myurl=$localurl&mypass=$mypass&group=$group&fnick=$fnick";
     if (trace()) echo "<p>$urlask";
     $s = get_url ($urlask);
     if (trace()) echo "<p>remote_is_member($myfnick,$url,$group,$fnick)->$s.";
     if ($s == "YES") return 1;
    }
    return 0;
}

function get_url ($url)
{
   $s = 0;
   try
   {
    $s = @file_get_contents ($url);
   }
   catch (Exception $e)
   {
    $s = 0;
   }
   return $s;
}

function get_array_url ($header, $url)
{
   if (trace()) { echo "<p>$url"; }
   $a = 0;
   try
   {
    $s = @file_get_contents ($url);
    if (trace()) { echo "<p>Result: ($s) " . ord($s); } 
    if (ord($s) == 13)
    {
     $s = substr ($s, 1);
    }
    if (trace()) { echo "<p>Result: ($s) " . ord($s); } 
    if (ord($s) == 10)
    {
     $s = substr ($s, 1);
    }
    if (! $s)
    {
     $a = 0;
    }
    else
    {
     /*
     echo "<p>s=($s)";
     echo "(";
     echo substr($s,0,strlen($header)+1);
     echo ")";
     */
     if (trace()) echo "<p>header=($header)";
    
     if (substr($s,0,strlen($header)+1) == $header . ":")
     {
      $a = preg_split ('/;/', substr($s,strlen($header)+1,strlen($s)-strlen($header)-1));
     }
     else
     {
      $a = 0;
     }
    }
   }
   catch (Exception $e)
   {
    if (trace()) echo "<p>Exception";
    $a = 0;
   }
   if (trace()) echo "<p>a=$a";
   if ($a == 0)
   {
    return $a;
   }
   else
   {
    $b = array();
    for ($i=0; $i<count($a)-1; $i++)
    {
     if (trace()) { echo " i=$i:(" . $a[$i] . ")"; }
     $b[] = $a[$i];
    }
    return $b;
   }
}

 function gen_pass ()
 {
  $pass = '';
  for ($i=0; $i<32; $i++)
  {
   $r = rand(ord('a'),ord('z'));
   $c = chr ($r);
   $pass = $pass . $c;
  }
  return $pass;
 }

 function create_remote_account ($fnick, $url, $pass)
 {
  $local_url = get_local_url ();
  $url1 = $url . "create_remote_account.php?fnick=$fnick&url=$local_url&pass=$pass";  
  if (trace()) echo "<p>$url1"; 
  $p = @file_get_contents ($url1); 
 }

 function filter1($in) {
	$search = array ('@[ ]@i','@[^a-zA-Z0-9_-éèêëÊËàâäÂÄîïÎÏûùüÛÜôöÔÖç]@');
	$replace = array ('_','');
	return preg_replace($search, $replace, $in);
 }

 function filter($in) {
	$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_]@');
	$replace = array ('e','a','i','u','o','c','_','');
	return preg_replace($search, $replace, $in);
 }

 function treat_string ($s)
 {
  if (get_magic_quotes_gpc())
   return $s;
  else
   return addslashes($s);
 }

 function is_visible1 ($v, $d)
 {
  return $v >= $d;
 }

function mkarray ($s)
{
 $r = array();
 $a = preg_split ('/;/', $s);
 foreach ($a as $i => $x)
 {
  $b = preg_split ('/:/', $x);
  /* print_r($b); 
  echo sizeof($b);*/
  if (sizeof($b) < 2)
  {
   /* echo " aaa "; */
   $r[''] = $x;
  }
  else  
  {
   /* echo " bbb "; */
   $r[$b[0]] = $b[1];
  }
 }
 return $r;
}

function is_visible ($v, $d)
{
 /*print_r($v); echo ' '; 
 print_r($d); echo ' ';*/
 $av = mkarray ($v);
 $ad = mkarray ($d);
 $r = 0;
 foreach ($av as $kv => $xv)
 {
  if ($xv == '')
   $xv = 0;
  $xd = $ad[$kv];
  if ($xd == '')
   $xd = 100;
  /*echo "<p>kv='$kv' xv='$xv' xd='$xd' ";*/
  if ($xv >= $xd)
  {
   $r = 1;
   break;
  }
 }
 return $r;
}

?>
