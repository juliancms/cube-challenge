<?php

class IndexFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['site']);
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#cubeTest-form', []);
        $I->expectTo('see validations errors');
        $I->see('T Tests cannot be blank');
    }

    public function submitFormWithIncorrectField(\FunctionalTester $I)
    {
        $I->submitForm('#cubeTest-form', [
            'CubeTestsForm[T_tests]' => 'words',
        ]);
        $I->expectTo('see alert message of wrong field type');
        $I->see('T Tests must be an integer.');
    }

    public function submitFormSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#cubeTest-form', [
          'CubeTestsForm[T_tests]' => '2',
        ]);
        $I->dontSeeElement('#cubeTest-form');
        $I->see('Settings');
        $I->see('Test 1 of 2');
    }
}
