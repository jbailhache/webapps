<?php

 $platform = "chez";

 function initv ($vars)
 {
  foreach ($vars as $var)
  {
   $instr = '$GLOBALS[\'' . $var . '\'] = $_POST[\'' .  $var . '\'];';
   echo "<li>eval [" . $instr . "]";
   eval ($instr);
  }
 }

 function connexion ()
 {
	global $cnx;
	try 
	{
    		// $cnx = new mysqli ("mysql.hostinger.fr", "u251290875_ps", "sapientia", "u251290875_ps");
		// $cnx = new PDO('sqlite:' . $path_to_root . '/db/cafes_philo_paris.sqlite');
		// $cnx = new PDO('sqlite:' . getcwd() . '/../db/cafes_philo_paris.sqlite');
		$cnx = new PDO('sqlite:database.sqlite');
		if (! $cnx)
		{
			echo ("<p>Connexion à la base de données impossible<p>");
			return false;
		}
		return true;
	}
	catch (Exception $e)
	{	
		echo "<pre>";
		print_r($e);
	}
 }

 function mysql_query ($q)
 {
  global $cnx;
  echo "<p>query $q.";
  try
  {
   $r = $cnx->query ($q);
   $stmt = $cnx->prepare($q);
   if (!$stmt)
   {
    echo "<p>Erreur prepare $q</p>";
    echo "<p>"; 
    echo $cnx->errorCode();
    echo "<pre>";
    print_r($cnx->errorInfo());
    echo "</pre>";
    echo "</p>";
    return $stmt;
   }
   // echo "stmt=<pre>"; print_r($stmt); echo "</pre>";
   $status = $stmt->execute();
   if (!$status)
   {
    echo "<p>Erreur dans la requ&ecirc;te:<p>" . $q .  " : ";
    echo $cnx->errorCode();
    echo "<pre>";
    print_r($cnx->errorInfo());
    echo "</pre>";
    echo "</p>";
    return $stmt;
   }
   return $stmt;
  }
  catch (Exception $e)
  {	
	echo "<pre>";
	print_r($e);
  }
 }

 function mysql_fetch_object ($data) 
 {
  global $cnx;
  if ($data)
   return $data->fetchObject ();
  else
   return 0;
 }

 function error ()
 {
  return $cnx->errorCode();
 }

	// remove magic quotes if enabled
 	function format_input ($s)	
	{
		if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		{
			$r = stripslashes($s);
			return $r;
		}
		else return $s;
	}

	function post ($champ)
	{
		return format_input($_POST[$champ]);
	}

	// format string for value parameter of input tag : replace " by "
	function format_value ($s)
	{
		$r = str_replace('"','"',$s);
		return $r;
	}

	// format string for query with MySQL or PostgreSQL : replace ' by '' and \ by \\
	function format_query ($s)
	{
		$s1 = str_replace('\'', '\'\'', $s);
		// For MySQL and PostgreSQL uncomment the line below, for SQLite keep it commented
		// $s1 = str_replace('\\', '\\\\', $s1);
		return $s1;
	}

	foreach ($_COOKIE as $var => $val)
	{
		//echo "<p>COOKIE: $var=$val</p>";
		$$var = format_input($val);
	}

	foreach ($_POST as $var => $val)
	{
		//echo "<p>POST: $var=$val</p>";
		$$var = format_input($val);
	}

	foreach ($_GET as $var => $val)
	{
		//echo "<p>GET: $var=$val</p>";
		$$var = format_input($val);
	}

	connexion();

