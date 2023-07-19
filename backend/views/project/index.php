<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Project;

$this->title = Yii::t('backend', 'Projects');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['white-space' => 'wrap'], 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'status',
                'value' => function(Project $model){
                    return $model->getStatusName();
                },
                'filter' => [
                    0 => 'Новий',
                    1 => 'Планування',
                    2 => 'В роботі',
                    3 => 'Закритий',
                    4 => 'Завершений',
                ],
 
            ],
            //'id',
            'title',
            'desciption:html',
            
            //'start_date',
            'finish_date',
            //'creater_id',
            //'created_at',
            //'updated_at',
            //'version',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Project $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
