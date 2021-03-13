<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
$keywords= filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
//Create instance of MongoDB client
if($keywords != ""  ){
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Tantalum;
$findCriteria=[
    '$text'=>['$search'=>$keywords]
];
$products = $db->Products->find($findCriteria);

echo json_encode(iterator_to_array($products));
}