<?php

namespace backend\controllers;

use Yii;
use common\models\Project;
use common\models\ProjectSearch;
use common\models\TaskSearch;
use common\models\UserSearch;
use common\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\StaleObjectException;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller{

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
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex(){
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){

        $model = $this->findModel($id);
        
        $taskSearchModel = new TaskSearch(['project_id' => $id]);
        $taskDataProvider = $taskSearchModel->search($this->request->queryParams);
        
        $userSearchModel = new UserSearch();
        $userDataProvider = $userSearchModel->search($this->request->queryParams);
        
        $commentSearchModel = new CommentSearch();
        $commentDataProvider = $commentSearchModel->search($this->request->queryParams);
        
        return $this->render('view', [
            'model' => $model,
            'taskDataProvider' => $taskDataProvider,
            'taskSearchModel' => $taskSearchModel,
            'userDataProvider' => $userDataProvider,
            'userSearchModel' => $userSearchModel,
            'commentDataProvider' => $commentDataProvider,
            'commentSearchModel' => $commentSearchModel,
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(){
        $model = new Project();
        $model->creater_id = Yii::$app->user->id;
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id){
        $model = $this->findModel($id);
        
        try {
            if ($this->request->isPost && $model->load($this->request->post())) {
                //print_r($model);
                //die();
                if ($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } catch (StaleObjectException $e) {
            Yii::$app->session->setFlash('error', 'Ваша версія запису не є актуально. Збереження не відбулось');
            /* 
             * TODO:
             * Далі тут можна реалізувати порівняння записів актуального з бази та запису, який намагався зберегти користувач
             * Думаю, що треба це зробити через окрему форму із двома наборами полів
             */
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }
    
}
