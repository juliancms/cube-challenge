<?php

class IndexFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site']);
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#cubeSetting-form', []);
        $I->expectTo('see validations errors');
        $I->see('T Tests cannot be blank');
        $I->see('N Coordinates cannot be blank');
        $I->see('M Operations cannot be blank');
    }

    public function submitFormWithIncorrectField(\FunctionalTester $I)
    {
        $I->submitForm('#cubeSetting-form', [
            'CubeSettingForm[T_tests]' => 'words',
            'CubeSettingForm[N_coordinates]' => '5d3',
            'CubeSettingForm[M_operations]' => '33.33',
        ]);
        $I->expectTo('see that all the fields are wrong');
        $I->see('T Tests must be an integer.');
        $I->see('N Coordinates must be an integer.');
        $I->see('M Operations must be an integer.');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#cubeSetting-form', [
          'CubeSettingForm[T_tests]' => '2',
          'CubeSettingForm[N_coordinates]' => '4',
          'CubeSettingForm[M_operations]' => '5',
        ]);
        $I->dontSeeElement('#cubeSetting-form');
        $I->see('Cube Settings:');
        $I->see('T: 2');
        $I->see('N: 4');
        $I->see('M: 5');
    }
}
