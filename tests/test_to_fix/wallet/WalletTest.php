<?php

namespace tests\unit\models;

use app\behaviors\UserAccessKeyBehavior;
use app\models\wallet\Wallet;
use app\models\StatusType;
use app\models\User;
use Yii;

class WalletTest extends \Codeception\Test\Unit
{
    public $tester;

    protected function _before()
    {
        \Yii::$app->user->login(User::findIdentity(147));
    }

    public function testCreateWallet()
    {
        expect_that($w = new Wallet());
        expect_that($w->user_id = Yii::$app->user->id);
        expect_that($w->user_label = 'Wallet 1');
        expect($w->save())->true();
    }

    public function testWalletPermissions()
    {
        expect_that($w = new Wallet());
        expect_that($w->user_id = Yii::$app->user->id);
        expect_that($w->user_label = 'Wallet 2');
        expect($w->save())->true();

        $auth = Yii::$app->authManager;

        expect($auth->checkAccess($w->getUserAccessKeys(UserAccessKeyBehavior::ROLE_WALLET_ADMIN)[UserAccessKeyBehavior::ROLE_WALLET_ADMIN][0],UserAccessKeyBehavior::ROLE_WALLET_ADMIN))->true();
        expect($auth->checkAccess($w->getUserAccessKeys(UserAccessKeyBehavior::ROLE_WALLET_INVOICE)[UserAccessKeyBehavior::ROLE_WALLET_INVOICE][0],UserAccessKeyBehavior::ROLE_WALLET_INVOICE))->true();
        expect($auth->checkAccess($w->getUserAccessKeys(UserAccessKeyBehavior::ROLE_WALLET_READ)[UserAccessKeyBehavior::ROLE_WALLET_READ][0],UserAccessKeyBehavior::ROLE_WALLET_READ))->true();

    }

    public function testFindByKey()
    {
        expect_that($w = new Wallet());
        expect_that($w->user_id = Yii::$app->user->id);
        expect_that($w->user_label = 'Wallet 3');
        expect($w->save())->true();

        expect_that($key = $w->getFirstAccessKeyByRole(UserAccessKeyBehavior::ROLE_WALLET_ADMIN));

        expect(Wallet::findByKey($key))->isInstanceOf('\app\models\wallet\Wallet');
    }

    public function testCalculateBalance()
    {
        expect_that($w = Wallet::findOne(7));
        expect($w->calculateBalance())->equals(50);
    }

    public function testUpdateBalance()
    {
        expect_that($w = Wallet::findOne(7));
        expect($w->updateBalance())->true();
        expect(Wallet::findOne(7)->balance)->equals(50);
    }

    public function testGetIsEligibleToWithdraw()
    {
        expect_that($w = Wallet::findOne(7));
        expect($w->getIsEligibleToWithdraw(50))->true();
        expect($w->getIsEligibleToWithdraw(200))->false();
    }
}
