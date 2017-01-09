<?php

namespace app\modules\site\controllers;

use app\modules\site\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\site\models\LoginForm;
use app\modules\site\models\ContactForm;

class SiteController extends DefaultController
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->session->removeAll();
        return $this->goHome();
    }
}
