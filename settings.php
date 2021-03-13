<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
session_start();
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Tantalum;
$email=$_SESSION['loggedInEmail'];
 $findCriteria = [
    "Email" => $email 
  ];
$customer = $db->Customer->find($findCriteria);


echo json_encode(iterator_to_array($customer));