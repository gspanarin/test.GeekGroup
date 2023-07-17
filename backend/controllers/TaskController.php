<?php

namespace backend\controllers;

use Yii;
use common\models\Task;
use common\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($project_id){
        $model = new Task();
        $model->project_id = $project_id;
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $model->creater_id = Yii::$app->user->id;
              
                if ($model->save()){
                    //return $this->redirect(['view', 'id' => $model->id]);
                    return $this->redirect(['project/view', 'id' => $project_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
    
    
    
    
    
    
    
    
    
    
    
    public function actionAjaxCreate($project_id, $creater_id){
        $model = new Task();
        $model->project_id = $project_id;
        $model->creater_id = $creater_id;
        $model->version = 0;
        if ($this->request->isAjax) {
            if ($model->load($this->request->post()) ) {
                if ($model->save()){
                    return Json::encode(array('status' => 'success', 'type' => 'success', 'message' => 'Task was created'));
                }
            }
            $model->loadDefaultValues();
        }

        return $this->renderAjax('ajax-create', [
            'model' => $model,
        ]);
    }
    
    
    public function actionAjaxView($id){
        return $this->render('ajax', [
            'model' => $this->findModel($id),
        ]);
    }
 
    
    public function actionAjaxUpdate($id){
        $model = $this->findModel($id);

        if ($this->request->isAjax && $model->load($this->request->post()) && $model->save()) {
            return Json::encode(array('status' => 'success', 'type' => 'success', 'message' => 'Task was updated'));
        }

        return $this->renderAjax('ajax-update', [
            'model' => $model,
        ]);
    }
    
    
    public function actionAjaxDelete($id){
        $this->findModel($id)->delete();

        return Json::encode(array('status' => 'success', 'type' => 'success', 'message' => 'Task was deleted'));
    }
    
}
