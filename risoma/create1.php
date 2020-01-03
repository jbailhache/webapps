<html>
<body>

<?php
 include ('platform.php');
 connexion();
 query ('CREATE TABLE " . $prefix . "members (nick TEXT, pass TEXT, presentation TEXT)');
 query ('CREATE TABLE " . $prefix . "events (number INTEGER, title TEXT, np INTEGER, year INTEGER, month INTEGER, day INTEGER, hour INTEGER, minute INTEGER, place TEXT, descr TEXT, inscriptions INTEGER)');
 query ('CREATE TABLE " . $prefix . "inscriptions_events (nick TEXT, nick_site TEXT, event INTEGER, event_site TEXT, position INTEGER)');
 query ('CREATE TABLE " . $prefix . "activities (name TEXT, descr TEXT)');
 query ('CREATE TABLE " . $prefix . "roles (activity TEXT, name TEXT, descr TEXT, number INTEGER)');
 query ('CREATE TABLE " . $prefix . "inscriptions_activities (nick TEXT, nick_site TEXT, activity TEXT, activity_site TEXT, role TEXT)');
 query ('CREATE TABLE " . $prefix . "messages (sender TEXT, sender_site TEXT, recipient TEXT, recipient_site TEXT, subject TEXT, body TEXT)');
 query ('CREATE TABLE " . $prefix . "sites (name TEXT)');
 
?>

</body>
</html>

