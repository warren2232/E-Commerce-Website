<?php
    require __DIR__ . '/vendor/autoload.php';
    session_start();
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $email= filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'Address', FILTER_SANITIZE_STRING);
    $country = filter_input(INPUT_POST, 'Country', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_NUMBER_INT);
    if($email != "" && $password != "" && $address != "" && $country != ""&& $phone != ""){//Check query parameters 
        //STORE REGISTRATION DATA IN MONGODB
        //Create instance of MongoDB client
    $mongoClient = (new MongoDB\Client);
    

    //Select a database
    $db = $mongoClient->Tantalum;
    $email=$_SESSION['loggedInEmail'];
    $findCriteria = [
    "Email"=>$email 
    ];

    //assign value from client to variable
    
    $updateCriteria =[

        "Email" => $email,
        "Password" => $password,
        "Address" => $address,
        "Country" => $country,
        "Phone" => $phone,

    ];

    $update = $db->Customer->replaceOne($findCriteria,$updateCriteria);
    
        //Output message confirming registration
        echo 'Update done for  ' . $email;
    }
    else{//A query string parameter cannot be found
        echo 'change failed';
    }
