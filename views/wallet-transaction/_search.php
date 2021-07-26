<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\wallet\WalletTransactionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallet-transaction-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'wallet_id') ?>

    <?php // echo $form->field($model, 'num_satoshis') ?>

    <?php // echo $form->field($model, 'ln_tx_id') ?>

    <?php // echo $form->field($model, 'user_label') ?>

    <?php // echo $form->field($model, 'external_hash') ?>

    <?php // echo $form->field($model, 'json_data') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
