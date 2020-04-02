<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CubeSettingForm;
use app\models\CubeOperationForm;
use app\models\CubeTestsForm;
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
       * Displays Index form to entry number of tests
       *
       * @return string
       */
      public function actionIndex()
      {
          // Initialize array
          $operations_total = array();

          //Create Form to access the validators of the Model
          $model = new CubeTestsForm();

          //Validate if the form is submited and the validators are succesfull
          if ($model->load(Yii::$app->request->post()) && $model->send()) {

              /**
                 * Store number the following vars in a session to access it later:
                 * t = number of tests to be performed (posted from the form)
                 * t2 = present test
              */
              $t = $model->getT_tests();
              \Yii::$app->session->set('t', $t);
              \Yii::$app->session->set('t2', 1);

              // Create the array where the results from the operations query will be recorded
              \Yii::$app->session->set('operations_total', $operations_total);

              // redirect to the next form actionSetting()
              return $this->redirect(array('setting'));
          }

          //Render the view of the index action (file views/site/index.php)
          return $this->render('index', [
              'model' => $model,
          ]);
      }


    /**
       * Displays Setting form to configure N and M values.
       *
       * @return string
       */
      public function actionSetting()
      {
          // receives values for t and t2 stored in the session
          $t = \Yii::$app->session->get('t');
          $t2 = \Yii::$app->session->get('t2');

          //Receive all the results from the QUERY commands of the present Test (t2)
          $operations_total = \Yii::$app->session->get('operations_total');

          // creates form to access the validators of the Model
          $model = new CubeSettingForm();

          //Validate if the form is submited and the validators are succesfull
          if ($model->load(Yii::$app->request->post()) && $model->send()) {

              // Receive the values N and M from the form
              $n = $model->getN_coordinates();
              $m = $model->getM_operations();

              // Store in session the m (number of operations to be done) and
              // store m2 which will be the current operation
              \Yii::$app->session->set('m', $m);
              \Yii::$app->session->set('m2', 1);

              //Creates, configure and store the cube with the values N and M
              //For every test(t2) a new cube is created in this action
              $cube = new Cube($model->getN_coordinates(), $model->getM_operations());
              $cube = new Cube($n, $m);
              \Yii::$app->session->set('cube', $cube);

              // Redirect to next form actionOperation(), send N variable
              return $this->redirect(array('operation',
                  'n' => $n,
              ));
          }

          //Render the view of the setting action (file views/site/setting.php)
          return $this->render('setting', [
              'model' => $model,
              't' => $t,
              't2' => $t2,
              'operations_total' => $operations_total,
          ]);
      }

      /**
         * Displays operation form to submit the Cube commands
         *
         *
         * @return string
         */
        public function actionOperation($n)
        {
            /* Receives variables from the session to be displayed in the view
             * and to compare if the operations (m2) and test (t2) are complete
            */
            $t = \Yii::$app->session->get('t');
            $t2 = \Yii::$app->session->get('t2');
            $m2 = \Yii::$app->session->get('m2');
            $m = \Yii::$app->session->get('m');

            //Receive array of numbers of operations done
            // stored from the Model CubeOperation every time a QUERY command is sent
            $operations_total = \Yii::$app->session->get('operations_total');

            // creates form to access the validators of the Model and send commands to the cube
            $model = new CubeOperationForm();

            //Validate if the form is submited and the validators are succesfull
            if ($model->load(Yii::$app->request->post()) && $model->send()) {

                //Receive all the results from the QUERY commands of the present Test (t2)
                $operations_total = \Yii::$app->session->get('operations_total');

                //Because a operation (m) is done increases m2 and store it
                $m2++;
                \Yii::$app->session->set('m2', $m2);

                //When operation m2 suprass m, the operations are complete and restart the settings of the Cube
                // When t2 suprass t, the present test is complete and redirect to the end page
                if($m2 > $m){
                  //Because the operations are complete increases t2 and store it
                  $t2++;
                  \Yii::$app->session->set('t2', $t2);
                  if($t2 > $t){
                    \Yii::$app->session->set('t2', $t2);
                    return $this->redirect('end');
                  }
                  Yii::$app->session->setFlash('OperationsFinished');
                  return $this->redirect(array('setting'));
                };

            }

            //Render the view of the operation action (file views/site/operation.php)
            return $this->render('operation', [
                'model' => $model,
                't' => $t,
                't2' => $t2,
                'n' => $n,
                'm' => $m,
                'm2' => $m2,
                'operations_total' => $operations_total,
            ]);
        }

        /**
           * Displays End text with the results
           *
           * @return string
           */
          public function actionEnd()
          {
            //Receive array of numbers of operations done
            // stored from the Model CubeOperation every time a QUERY command is sent
            $operations_total = \Yii::$app->session->get('operations_total');

              //Render the view of the end action (file views/site/end.php)
              return $this->render('end', [
                  'operations_total' => $operations_total,
              ]);
          }
}
