<html>
<body>

<?php
 include ('platform.php');
 connexion();

 query ('drop table ' . $prefix . 'activities');
 query ('drop table ' . $prefix . 'comment_member');
 query ('drop table ' . $prefix . 'comments_members');
 query ('drop table ' . $prefix . 'diary');
 query ('drop table ' . $prefix . 'distances');
 query ('drop table ' . $prefix . 'events');
 query ('drop table ' . $prefix . 'fields');
 query ('drop table ' . $prefix . 'groups');
 query ('drop table ' . $prefix . 'groups_members');
 query ('drop table ' . $prefix . 'incoming');
 query ('drop table ' . $prefix . 'inscriptions_activities');
 query ('drop table ' . $prefix . 'inscriptions_events');
 query ('drop table ' . $prefix . 'members');
 query ('drop table ' . $prefix . 'messages');
 query ('drop table ' . $prefix . 'messages_events');
 query ('drop table ' . $prefix . 'outgoing');
 query ('drop table ' . $prefix . 'roles');
 query ('drop table ' . $prefix . 'sites');
 query ('drop table ' . $prefix . 'walls');
 query ('drop table ' . $prefix . 'offers');
 query ('drop table ' . $prefix . 'needs');
 query ('drop table ' . $prefix . 'exchanges');

 echo "<p>Done.";
?>

