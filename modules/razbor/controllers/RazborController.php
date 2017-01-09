<?php

namespace app\modules\razbor\controllers;

use app\modules\razbor\models\RazborForm;
use Yii;
use app\modules\razbor\models\Razbor;

class RazborController extends DefaultController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
    
    public function actionRazbor()
    {
        $razbor = new Razbor();
        session_start();
        if ($_POST) {
            $razbor->id = $_SESSION['userid'] = $_POST['RazborForm']['userid'];
            $razbor->date1 = $_SESSION['date1'] = $_POST['RazborForm']['date1'];
            $razbor->date2 = $_SESSION['date2'] = $_POST['RazborForm']['date2'];
            $razbor->getRazbor();
        }
        $model = new RazborForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                echo 'cool :)';
            }
        }
        return $this->render('razbor', [
            'model' => $model,
        ]);
    }

}
