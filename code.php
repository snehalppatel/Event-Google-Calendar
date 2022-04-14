<?php
 $client_id = '858931159995-kq83ita15ifm0rrqaq300fh4ccknbem4.apps.googleusercontent.com';
    $redirect_uri = 'http://localhost/wordpress/code.php';
    $client_secret = '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';
     if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $token_data = GetAccessToken($client_id, $redirect_uri, $client_secret, $code);
    } else {
        echo 'No direct access';
    }

    
    
function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) { 
    $url = 'https://www.googleapis.com/oauth2/v4/token';            
 
    $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url);        
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
    curl_setopt($ch, CURLOPT_POST, 1);      
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);    
    $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);      
    if($http_code != 200) 
        throw new Exception('Error : Failed to receieve access token');
     
    return $data;
}