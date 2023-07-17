<?php

namespace backend\controllers;

use Yii;
use common\models\Comment;
use common\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller{
    
    
    /**
     * @inheritDoc
     */
    public function behaviors(){
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
     * Lists all Comment models.
     *
     * @return string
     */
    public function actionIndex(){
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(){
        $model = new Comment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comment model.
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
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = Comment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
    
    
    
    
    
    
    
    
    
    
    
    public function actionAjaxCreate($user_id, $project_id = null, $task_id = null){
        $model = new Comment();
        $model->project_id = $project_id;
        $model->user_id = $user_id;
        $model->version = 0;
        
        if ($this->request->isAjax) {
            if ($model->load($this->request->post()) ) {
                if ($model->save()){
                    return Json::encode(array('status' => 'success', 'type' => 'success', 'message' => 'Comment was added'));
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
