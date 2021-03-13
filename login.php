<?php
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    //Get name and address strings - need to filter input to reduce chances of SQL injection etc.
    $email= filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
 
    if($email != "" && $password != "" ){//Check query parameters 
        //STORE REGISTRATION DATA IN MONGODB
        //Create instance of MongoDB client
    $mongoClient = (new MongoDB\Client);

    //Select a database
    $db = $mongoClient->Tantalum;

    $findcriteria=[
        "Email" =>$email,
        "Password" => $password
    ];
   
    $collection = $db->Customer;

    $count =$collection->count($findcriteria);
  

    //Check that there is exactly one customer
    if($count == 0){
        echo 'Invalid username or password';
        return;
    }
    else if($count > 1){
        echo 'Database error: Multiple customers have same username.';
        return;
    }
     
    //Start session for this user
    $_SESSION['loggedInEmail'] = $email;
    
    //Inform web page that login is successful
    echo 'Welcome'. $email;  
    
}



?>
