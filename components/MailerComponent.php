<?php
namespace app\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


class MailerComponent extends Component
{
    public static function initMailer($to,$template='activity',$data=[])
    {
        if (stripos($to,'@')!==FALSE) {
            return Yii::$app->mailer->compose($template,$data)
                ->setTo($to)
                ->setFrom([getenv('DEFAULT_EMAIL_FROM')=>Yii::$app->name]);
        }
        else {
            return FALSE;
        }

    }

}
