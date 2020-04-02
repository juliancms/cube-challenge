<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('Number of Tests');

        $I->amGoingTo('set the tests with an integer value');
        $I->fillField('input[name="cubeTest-form[T_tests]"]', '2');
        $I->click('send-button');
        $I->wait(2); // wait for button to be clicked

        $I->expectTo('see cube info');
        $I->see('Settings:');
        $I->see('Test 1 of 2');
    }
}
