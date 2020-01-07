<HTML>
<head>
<title>Toplists</title>
</head>

<!--
<body>
<h2>Liste des toplists</h2>

<ul>
-->

<?php
	include ("util.php3");
	include ("look.php3");
	if (connexion() > 0)
	{
		pageheader ("Liste des toplists");
		$query = "SELECT * FROM paramlists ORDER BY nomlist";
		$data = mysql_query ($query);
		while ($rec = mysql_fetch_object ($data))
		{
			echo ("<li><a href=\"toplist.php3?nomlist=");
			echo ($rec->nomlist);
			echo ("\">");
			echo ($rec->nomlist);
			echo ("</a>");
		}
		pageend ();      
	}
?>

<!--
</ul>

</body>
-->
</HTML>
