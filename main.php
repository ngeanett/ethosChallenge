<?php
    require('const.php');    
    require('httpful.phar');    
    require_once('restFunctions.php');
    
    $personsResults = searchPersonByFname(json_encode(buildPersonsSearchArray($_POST['fname'], $_POST['lname'])));
    
    print_array_pretty($personsResults);
    
    echo $personsResults->id;
    
    searchPersonHolds($id);

/*

    echo "" . $persons_response->body[0]->names[0]->fullName .
        " AKA " . $persons_response->body[0]->names[1]->fullName .
         ' (ID: '. $anakin_id . ')' . 
         ' Did not have a stellar attendance record.';   
    
    $attendanceResponse = Request::get($uri . $attendanceURI . $anakin_id)
        ->addHeader($AuthorizationHeader, $bearerHeader. $client_access_token)
        ->sendsJson()
        ->send();                                       
    
    print_array_pretty($attendanceResponse->body);
    
    ShowAttendance($attendanceResponse);
    */
?>