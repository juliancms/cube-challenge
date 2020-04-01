<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('Cube Challenge');

        $I->amGoingTo('set the cube with integer values');
        $I->fillField('input[name="cubeSetting-form[T_tests]"]', '2');
        $I->fillField('input[name="cubeSetting-form[N_coordinates]"]', '4');
        $I->fillField('input[name="cubeSetting-form[M_operations]"]', '5');
        $I->click('send-button');
        $I->wait(2); // wait for button to be clicked

        $I->expectTo('see cube info');
        $I->see('Cube Settings:');
        $I->see('N: 4');
    }
}
