<?php


    $request_data = array(
        'server' => 'main',
        'base' => 'hockey',
        'login' => 'reports',
        'pass' => 'GY7tEaaB4S',
        'proc' => 'ask_match_period_team_player',
        'params' => [
            '_pn_limit' => [7, 'in'],
        
        ]
    );
    $ch = curl_init('http://service.instatfootball.com/ws.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    
    $data = json_decode($response, true);
    var_dump($data);
