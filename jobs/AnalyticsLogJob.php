<?php
namespace app\jobs;

use app\components\AnalyticsComponent;

class AnalyticsLogJob extends \yii\base\BaseObject implements \yii\queue\JobInterface
{
    public $userId;
    public $eventName;
    public $params = [];

    public function execute($queue)
    {
        AnalyticsComponent::executeLog($this->userId,$this->eventName,$this->params);
    }
}