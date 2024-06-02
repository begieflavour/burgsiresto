<?php

$db = new SQLite3('members.db');
 

$query = "CREATE TABLE IF NOT EXISTS members (name STRING, price STRING, address STRING, description STRING)";
$db->exec($query);

$query = "CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username STRING, password STRING)";
$db->exec($query);
 
?>