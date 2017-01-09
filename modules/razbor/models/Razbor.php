<?php
namespace app\modules\razbor\models;

use Yii;
class Razbor extends \yii\base\Model
{
    public $id;
    public $date1;
    public $date2;
    
    public function getRazbor()
    {
        session_start();
        $this->id = $_SESSION['userid'];
        $this->date1 = $_SESSION['date1'];
        $this->date2 = $_SESSION['date2'] ? $_SESSION['date2'] : date('Y-m-d');
        
        $request_data = array(
            'server' => 'instatfootball.com',
            'base' => 'football',
            'login' => 'views_football',
            'pass' => 'RcGBBwVqMn7K9Fdz',
            'proc' => 'prc_user_marks_stat_get_inner',
            'params' => [
                '@sellers_user_id' => [$this->id, 'in'],
                '@date_b' => [$this->date1, 'in'],
                '@date_e' => [$this->date2, 'in']
            ]
        );
        
        $ch = curl_init('http://service.instatfootball.com/ws.php');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
    
        $data = json_decode($response, $assoc = true);
        $data = $data['data'];
        return $_SESSION['query'] = $data;
    }
    
}