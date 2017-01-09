<?php
use \nex\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\data\ArrayDataProvider;
use \yii\grid\GridView;
use \yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\modules\razbor\models\Razbor */
/* @var $form ActiveForm */
if (Yii::$app->session->get('user_info') == null){
    return Yii::$app->response->redirect(Url::to('/site/login'));
}
?>
<div class="site-razbor">

    <?php $form = ActiveForm::begin(['action' =>['razbor/razbor']]); ?>
    
        <div class="form-group">
            <?= Html::input('hidden', 'RazborForm[userid]', Yii::$app->session->get('user_info')['id'], ['class' => 'id', 'placeholder' => 'id пользователя']) ?>
        </div>
    
        <?= $form->field($model, 'date1', ['options' => ['class' => 'form-group col-sm-3']])->label(false)->widget(DatePicker::className(),[
                'language' => 'ru',
                'placeholder' => 'Дата начала',
                'clientOptions' =>[
                    'format' => 'YYYY-MM-DD',
                ],
                'options' => [
                    'value' => Yii::$app->session->get('date1')
                ]
            ]
        ) ?>

        <?= $form->field($model, 'date2', ['options' => ['class' => 'form-group col-sm-3']])->label(false)->widget(DatePicker::className(),[
                'language' => 'ru',
                'placeholder' => 'Дата конца',
                'clientOptions' =>[
                    'format' => 'YYYY-MM-DD',
                ],
                'options' => [
                    'value' => Yii::$app->session->get('date2')
                ]
            ]
        ) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Выполнить', ['class' => ['btn btn-primary', 'btn_apply']]) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>

<div class="container-fluid text-center">
<?php
$dataProvider = new ArrayDataProvider([
    'allModels' => $_SESSION['query'],
    'pagination' => [
        'pageSize' => 15,
    ],
    'sort' => [
        'attributes' => ['TIME_B','PART_OF','MATCH_NAME','MISTAKES','RATING','QUANT_M'],
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['attribute' => 'TIME_B',
            'label' => 'Дата разбора',
            'value' => function($data){
            return explode('.', $data['TIME_B'])[0];}],
        ['label' => 'Кол-во разобранных матчей',
            'attribute' => 'PART_OF',
            'value' => function($data){
                return str_pad($data['PART_OF'], 4, 0, STR_PAD_LEFT);
            }],
        ['attribute' => 'MATCH_NAME',
            'label' => 'Названия комманд'],
        ['attribute' => 'MISTAKES',
            'label' => 'Ошибки'],
        ['attribute' => 'RATING',
            'label' => 'Рейтинг',
            'value' => function($data){
                return $data['RATING'] ? str_pad($data['RATING'], 4, 0, STR_PAD_LEFT) : 'Не проверено';
            }],
        ['attribute' => 'QUANT_M',
            'label' => 'Кол-во маркеров']
    ]
]);
?>
</div>
