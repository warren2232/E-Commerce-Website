<?php

//Include libraries
require __DIR__ . '/vendor/autoload.php';
    
//Create instance of MongoDB client
$mongoClient = (new MongoDB\Client);

//Select a database
$db = $mongoClient->Tantalum;

//Extract the data that was sent to the server


$obj = $_POST['sessionStorage'];
$total = $_POST['total'];






//Start session management
session_start();



if( array_key_exists("loggedInEmail", $_SESSION) ){
    
    $Email= $_SESSION['loggedInEmail'];
}
else{
    echo 'Not logged in';
    return;
}

$currentDate = date("Y/m/d");
$currentTime= date("h:i");

$checkoutArray=[
    "Email"=> $Email,
    "date"=> $currentDate,
    "time"=> $currentTime,
    "total"=> $total,
    "products"=>json_decode($obj)
];

//Select a collection 
$collection = $db->Orders;
    //Add the new product to the database
$insertResult = $collection->insertOne($checkoutArray);

   



    //Echo result back to user
if($insertResult->getInsertedCount()==1){
echo 'good';
}
else {
echo 'Error';
}
















?>