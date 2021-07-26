<?php

namespace app\controllers\v1\node;

use app\controllers\v1\BaseApiController;
use app\modules\node\models\LnNode;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class BaseNodeController extends BaseApiController
{
    public $nodeObject;

    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['view']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['index']);
        return $actions;
    }

    protected function verbs(){
        return [
            //'create' => ['POST'],
            //'update' => ['PUT','PATCH','POST'],
            //'delete' => ['DELETE'],
            //'view' =>   ['GET','OPTIONS'],
            //'index'=>   ['GET'],
        ];
    }

    public function beforeAction($event)
    {
        if ($node_id = Yii::$app->request->getQueryParam('node_id')) {
            if ($node_id == 'default')
                return parent::beforeAction($event);

            $this->nodeObject = LnNode::find()->where(['id'=>$node_id,'user_id'=>Yii::$app->user->id])->one();

            if (!$this->nodeObject) {
                throw new BadRequestHttpException('Invalid node id: '.$node_id);
            }

        } else {
            throw new BadRequestHttpException('Request must contain node_id');
        }

        return parent::beforeAction($event);
    }
}
