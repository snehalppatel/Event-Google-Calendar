<?php

// Silence is golden.
//require __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/Gcalender.php';

/**
 * Plugin Name: My Google Calender Plugin
 * Description: Displays upcoming events from public calendars
 * Version: 1.0.0
 */
add_action('init', 'gcalender_script_data');

function gcalender_script_data() {
    wp_register_script("gcalender_script", WP_PLUGIN_URL . '/googlecalender/gcalender.js', array('jquery'));
    wp_localize_script('gcalender_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_enqueue_script('jquery');
    wp_enqueue_script('gcalender_script');
}


add_action("wp_ajax_my_google_calender", "my_google_calender");
add_action("wp_ajax_nopriv_my_google_calender", "my_google_calender");


function my_google_calender() {

    $client_id = '858931159995-kq83ita15ifm0rrqaq300fh4ccknbem4.apps.googleusercontent.com';
    $redirect_uri = 'http://localhost/wordpress/code.php';
    $client_secret = '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';
     if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $token_data = GetAccessToken($client_id, $redirect_uri, $client_secret, $code);
    } else {
        echo 'No direct access';
    }

    
    $user_timezone = GetUserCalendarTimezone($token_data);
    $calendar_id = 'primary';
    $event_title = the_title();
 
    $full_day_event = 1; 
    $event_time = [ 'event_date' => date('Y-m-d', strtotime(the_field('date'))) ];
     
    CreateCalendarEvent($calendar_id, $event_title, $full_day_event, $event_time, $user_timezone, $token_data);
 
}

function GetUserCalendarTimezone($access_token) {
    $url_settings = 'https://www.googleapis.com/calendar/v3/users/me/settings/timezone';
 
    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url_settings);       
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);      
    if($http_code != 200) 
        throw new Exception('Error : Failed to get timezone');
 
    return $data['value'];
} 


function CreateCalendarEvent($calendar_id, $summary, $all_day, $event_time, $event_timezone, $access_token) {
    $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events';
 
    $curlPost = array('summary' => $summary);
    if($all_day == 1) {
        $curlPost['start'] = array('date' => the_field('date'));
        $curlPost['end'] = array('date' => the_field('date'));
    }
    else {
        $curlPost['start'] = array('dateTime' => $event_time['start_time'], 'timeZone' => $event_timezone);
        $curlPost['end'] = array('dateTime' => $event_time['end_time'], 'timeZone' => $event_timezone);
    }
    $ch = curl_init();      
    curl_setopt($ch, CURLOPT_URL, $url_events);     
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
    curl_setopt($ch, CURLOPT_POST, 1);      
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json')); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));   
    $data = json_decode(curl_exec($ch), true);
    $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);      
    if($http_code != 200)
        throw new Exception('Error : Failed to create event');
 
    return $data['id'];
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
