<?php

namespace app\modules\site\models;

use Yii;
use \yii\base\Model;

class User extends Model
{
    
    public function User($login, $password)
    {
        $request_data = array(
            'server' => 'instatfootball.com',
            'base' => 'instat_football',
            'login' => 'views_football',
            'pass' => 'RcGBBwVqMn7K9Fdz',
            'proc' => 'cabinet_ask_user',
            'params' => [
                '@login' => [$login, 'in'],
                '@pass' => [$password, 'in'],

            ]
        );
        $ch = curl_init('http://service.instatfootball.com/ws.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        $data = json_decode($response);
        $data = $data->data;
        foreach ($data as $dat) {
            $data = $dat;
        }
        $mass = $data;
        Yii::$app->session->open();
        foreach ($mass as $k => $m){
            $_SESSION['user_info'][$k]= $m;
        }
        return !empty($mass);
    }
    
}
