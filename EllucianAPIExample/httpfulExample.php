<?php
    //Include PHP Refsful Library
    include('./httpful.phar');
    include('./cred.php');

    // ellucian eTranscript Status Service for HCCFL 00787000
    $uri = 'https://etranscriptstest.elluciancloud.com/00787000/api/system-details/status';
    
    $response = \Httpful\Request::get($uri)
        ->authenticateWith($un, $pw)                    // authenticate with basic auth...
        ->send();                                       // and finally, fire that thing off!

    echo print_r($response->body);
    
    // Find Student API for HCCFL OPEID (00787000)
    $uri_findStudent = 'https://etranscriptstest.elluciancloud.com/00787000/qapi/students';
    $findStudent_array = array(
        'lastName' => 'Hogan',
        'firstName' => 'Cyrina',
	    'dateOfBirth' => '1966-11-01',
	    'formerLastName' => 'Hogan',
	    'studentId' => '',
        'governmentId' => ''
    );	

    $findStudent_json = json_encode($findStudent_array);
    
    $findStudent_response = \Httpful\Request::post($uri_findStudent)
        ->sendsJson()                                   // tell it we're sending (Content-Type) JSON...
        ->authenticateWith($un, $pw)                    // authenticate with basic auth...
        ->body($findStudent_json)                       // attach a body/payload...
        ->send();                                       // and finally, fire that thing off!

    echo print_r($findStudent_response->body);
    
    
    
    
    
    //Get Transcript for VCCT 01116700
    $TransRequest_uri = 'https://etranscriptstest.elluciancloud.com/01116700/api/transcript-orders/';
    $xml_request = file_get_contents('./sampleRequest.xml');
    
    $TransRequest_response = \Httpful\Request::post($TransRequest_uri)
        ->sendsXml()                                    // tell it we're sending (Content-Type) XML...
        ->expectsXml()                                  // tell it we're expecting XML as a return
        ->authenticateWith($un, $pw)                    // authenticate with basic auth...
        ->body($xml_request)                            // attach a body/payload from request XML
        ->send();                                       // and finally, fire that thing off!

    print_r($TransRequest_response);
    //$response_value = (string) $TransRequest_response->code[0]->lat;

?>


