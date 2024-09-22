<?php

$db = new Database();

$results = $db->query("SELECT * FROm X");1

$results["id"];

$results = $db->queryWithResultClass("");

$results->data["id"];
$results->rowCount;

UPDATE klant SET naam = "Henk Henkersen"WHERE id = 2;