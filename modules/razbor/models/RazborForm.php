<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.12.2016
 * Time: 10:21
 */

namespace app\modules\razbor\models;


use yii\base\Model;

class RazborForm extends Model
{
    public $date1;
    public $date2;
    
    public function rules()
    {
        return [
            [['date1'], 'required', 'message' => 'Это поле не может быть пустым'],
            [['date2'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'date1' => false,
            'date2' => false
        ];
    }
}