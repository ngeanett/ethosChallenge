<?php
    use Httpful\Request;
    
    // Auth API call to gain the $client_access_token
    function authToken(){
        global $uri, $auth, $authHeader, $bearerHeader, $bannerKey;
        
        $auth_response = Request::post($uri . $auth)
            ->addHeader($authHeader, $bearerHeader. $bannerKey)
            ->send();
            
        return $auth_response->body;
    }
    
    // Persons Look-up
    function searchPersonByFname($fnameArray){
        global $uri, $personsCriteria, $authHeader, $bearerHeader;
        
        $response = Request::get($uri . $personsCriteria. $fnameArray)
            ->addHeader($authHeader, $bearerHeader. authToken())
            ->sendsJson()
            ->send();

        return $response->body;
    }
    
    // Person Holds Look-up
    function searchPersonHolds($id){
        global $uri, $personHolds, $authHeader, $bearerHeader;
        
        $response = Request::get($uri . $personHolds. $id)
            ->addHeader($authHeader, $bearerHeader. authToken())
            ->sendsJson()
            ->send();
        
        return $response->body;
    }
    
    function buildPersonsSearchArray($fname, $lname){
        return $persons_array =
            array(
                "names" => 
                    array(
                        array(
                            'firstName' => $fname,
                            'lastName' => $lname,
                        )
                    )
                );
    }
    
    
    function attendanceRequest(){
        global $uri, $attendanceURI, $authHeader, $bearerHeader;
    
        $attendanceResponse = Request::get($uri . $attendanceURI . $anakin_id)
            ->addHeader($AuthorizationHeader, $bearerHeader. authToken())
            ->sendsJson()
            ->send();                                
    
        ShowAttendance($attendanceResponse);
    }        
    
    // Display an attendance Array
    function ShowAttendance($a){
        
        $presentFull = 0;
        $presentPartial = 0;
        $absentNotExcused = 0;
        $absentExcused = 0;
        
        foreach ($a->body as $item) {
            // presentFull
            if ($item->attendance->category === 'presentFull') {
                $presentFull++;
            }
        
            // presentPartial
            if ($item->attendance->category === 'presentPartial') {
                $presentPartial++;
            }
        
            // absentNotExcused
            if ($item->attendance->category === 'absentNotExcused') {
                $absentNotExcused++;
            }
        
            // absentExcused
            if ($item->attendance->category === 'absentExcused') {
                $absentExcused++;
            }
        }

        echo '<html>';
        echo "<ul>";
        echo "<li>Full attendance for " . $presentFull . " classes</li>";
        echo "<li>Partial attendance: " . $presentPartial . " classes</li>";   
        echo "<li>Excused absenses: " . $absentNotExcused . " classes</li>";   
        echo "<li>Unexcused absenses: " . $absentExcused . " classes</li>";
        echo "</ul>";
        
        echo "<img src='anakin.gif'>";
        echo '</html>';
    }
    
    // Used for debugging array
    function print_array_pretty($arr){
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    
?>    
