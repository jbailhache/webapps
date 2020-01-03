<html>
<body>

<?php
 include ('platform.php');
 connexion();
 query ('CREATE TABLE " . $prefix . "members (fnick TEXT, nick TEXT, pass TEXT, presentation TEXT, wall TEXT, v_wall INTEGER, m_wall INTEGER)');
 query ('CREATE TABLE " . $prefix . "events (number INTEGER AUTO_INCREMENT NOT NULL, PRIMARY KEY(number), title TEXT, fnick TEXT, np INTEGER, year INTEGER, month INTEGER, day INTEGER, hour INTEGER, minute INTEGER, place TEXT, descr TEXT, inscriptions INTEGER)');
 query ('CREATE TABLE " . $prefix . "inscriptions_events (fnick TEXT, fnick_url TEXT, event INTEGER, event_url TEXT, position INTEGER, date TIMESTAMP)');
 query ('CREATE TABLE " . $prefix . "messages_events (event INTEGER, fnick TEXT, url TEXT, date TIMESTAMP, body TEXT)');
 query ('CREATE TABLE " . $prefix . "activities (name TEXT, descr TEXT)');
 query ('CREATE TABLE " . $prefix . "roles (activity TEXT, name TEXT, descr TEXT, number INTEGER)');
 query ('CREATE TABLE " . $prefix . "inscriptions_activities (fnick TEXT, fnick_site TEXT, activity TEXT, activity_site TEXT, role TEXT)');
 query ('CREATE TABLE " . $prefix . "messages (sender TEXT, sender_url TEXT, recipient TEXT, recipient_url TEXT, date TIMESTAMP, subject TEXT, body TEXT)');
 query ('CREATE TABLE " . $prefix . "sites (number INTEGER AUTO_INCREMENT NOT NULL, PRIMARY KEY(number), name TEXT, url TEXT)');
 query ('CREATE TABLE " . $prefix . "fields (field TEXT, fnick TEXT, value TEXT, visible INTEGER)');
 query ('CREATE TABLE " . $prefix . "diary (fnick TEXT, date TIMESTAMP NOT NULL DEFAULT NOW() , message TEXT, visible INTEGER)');
 query ('CREATE TABLE " . $prefix . "distances (myfnick TEXT, hisfnick TEXT, distance INTEGER)');
 query ('CREATE TABLE " . $prefix . "comments_members (myfnick TEXT, hisfnick TEXT, comment TEXT)');
 query ('CREATE TABLE " . $prefix . "groups (name TEXT, descr TEXT, fnick TEXT, date TIMESTAMP NOT NULL DEFAULT NOW())');
 query ('CREATE TABLE " . $prefix . "groups_members (groupname TEXT, fnick TEXT, distance INTEGER, date TIMESTAMP NOT NULL DEFAULT NOW() )');
 query ('CREATE TABLE " . $prefix . "incoming (fnick TEXT, url TEXT, pass TEXT)');
 query ('CREATE TABLE " . $prefix . "outgoing (fnick TEXT, url TEXT, pass TEXT)');
 
?>

</body>
</html>

