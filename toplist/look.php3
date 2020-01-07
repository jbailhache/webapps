<?php
	function pageheader ($title)
	{
		echo ("<body bgcolor=#ff9900>");
		echo ("<center><table border=1 bordercolor=#330099 cellpadding=5 cellspacing=1>");
		echo ("<tr><td bgcolor=#330099 align=center><font color=#ffffff><h4><b>");
		echo ($title);
		echo ("</b></h4></font></td></tr>");
		echo ("<tr><td bgcolor=#ff9900>");
      }

	function formheader ($title, $action)
	{
		pageheader ($title);
		echo ("<form method=post action=$action>");
	}

	function pageend ()
	{
		echo ("</td></tr></table></center></body>");
	}

	function formend ()
	{
		echo ("</form>");
		pageend ();
	}

?>
