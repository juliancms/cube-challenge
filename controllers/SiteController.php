<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CubeSettingForm;
use app\models\Cube;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
       * Displays homepage.
       *
       * @return string
       */
      public function actionIndex()
      {
          $model = new CubeSettingForm();
          $n = 0;
          if ($model->load(Yii::$app->request->post()) && $model->send()) {
              $cube = new Cube($model->getN_coordinates(), $model->getM_operations());
              $t = $model->getT_tests();
              $n = $model->getN_coordinates();
              $m = $model->getM_operations();
              return $this->render('operation', [
                  'model' => $model,
                  'T' => $t,
                  'N' => $n,
                  'M' => $m,
              ]);
          }
          return $this->render('index', [
              'model' => $model,
          ]);
      }
}
