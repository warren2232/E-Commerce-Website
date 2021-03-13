<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
  session_start();  
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);
$email=$_SESSION['loggedInEmail'];
//Select a database
$db = $mongoClient->Tantalum;
$findCriteria = [
    "Email" => $email,
];

$collection = $db->Orders;
$result = $collection->find($findCriteria);

echo json_encode(iterator_to_array($result));
 

