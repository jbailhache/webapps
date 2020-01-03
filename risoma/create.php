<html>
<body>

<?php
 include ("platform.php");
 connexion();
 $q = "CREATE TABLE " . $prefix . "members (fnick TEXT, nick TEXT, pass TEXT, presentation TEXT, wall TEXT, v_wall INTEGER, m_wall INTEGER, given REAL, received REAL, startday INTEGER, stopday INTEGER, image TEXT, mirror TEXT DEFAULT '')";
 echo "<p>$q";
 query ($q);
 query ("CREATE TABLE " . $prefix . "events (number INTEGER AUTO_INCREMENT NOT NULL, PRIMARY KEY(number), title TEXT, fnick TEXT, np INTEGER, period INTEGER, year INTEGER, month INTEGER, day INTEGER, hour INTEGER, minute INTEGER, nth INTEGER, dayofweek INTEGER, place TEXT, descr TEXT, inscriptions INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "inscriptions_events (fnick TEXT, fnick_url TEXT, event INTEGER, event_url TEXT, position INTEGER, date TIMESTAMP, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "messages_events (event INTEGER, fnick TEXT, url TEXT, date TIMESTAMP, body TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "activities (name TEXT, descr TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "roles (activity TEXT, name TEXT, descr TEXT, number INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "inscriptions_activities (fnick TEXT, fnick_site TEXT, activity TEXT, activity_site TEXT, role TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "messages (sender TEXT, sender_url TEXT, recipient TEXT, recipient_url TEXT, date TIMESTAMP, subject TEXT, body TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "sites (number INTEGER AUTO_INCREMENT NOT NULL, PRIMARY KEY(number), name TEXT, url TEXT, distance INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "fields (field TEXT, fnick TEXT, value TEXT, visible INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "diary (fnick TEXT, date TIMESTAMP NOT NULL DEFAULT NOW() , message TEXT, visible INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "distances (myfnick TEXT, myurl TEXT, hisfnick TEXT, hisurl TEXT, distance INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "comments_members (myfnick TEXT, myurl TEXT, hisfnick TEXT, hisurl TEXT, comment TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "groups (name TEXT, descr TEXT, fnick TEXT, url TEXT, date TIMESTAMP NOT NULL DEFAULT NOW(), mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "groups_members (groupname TEXT, fnick TEXT, url TEXT, distance INTEGER, date TIMESTAMP NOT NULL DEFAULT NOW(), mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "incoming (fnick TEXT, url TEXT, pass TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "outgoing (fnick TEXT, url TEXT, pass TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "walls (fnick TEXT, name TEXT, content TEXT, visible INTEGER, modifiable INTEGER, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "offers (number INTEGER AUTO_INCREMENT NOT NULL, PRIMARY KEY(number), fnick TEXT, categ TEXT, descr TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "needs (number INTEGER AUTO_INCREMENT NOT NULL, PRIMARY KEY(number), fnick TEXT, categ TEXT, descr TEXT, mirror TEXT DEFAULT '' )");
 query ("CREATE TABLE " . $prefix . "exchanges (tofnick TEXT, tourl TEXT, byfnick TEXT, byurl TEXT, value REAL, year INTEGER, month INTEGER, day INTEGER, categ TEXT, descr TEXT, mirror TEXT DEFAULT '' )");
 
?>

</body>
</html>

