<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Material;
use app\models\Search;
use \yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) 
    {

       return true;

    }

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

    /*
     * Displays homepage.
     *
     * @return string
    */

    public function actionIndex()
    {
        //return $this->render('index');
        $this->redirect('site/main');
    }

    public function actionSearchResult()
    {
        return $this->render('site/search_result');
    }



    public function actionMainSearch()
    {
        $request = Yii::$app->request;
        $post = $request->post();

        if(!empty($post))
        {
            $_SESSION["mainSearchPost"] = $post;
        }


        $search_category = $request->post('search_category',$_SESSION["mainSearchPost"]["search_category"]);
        $search_value = $request->post('search_value',$_SESSION["mainSearchPost"]["search_value"]);

        $functionName = "get".$search_category;
        $viewName = "search_".$search_category;

        $data = Search::$functionName($search_value);

        $tempExplode = explode("~~",$search_value);

        $search_value = (count($tempExplode) > 1) ? $tempExplode[1] : $search_value;

        $js = Yii::getAlias('@web/js/custom/index.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render("search_result",array(
            "viewData" => $data,
            "view" => $viewName,
            "search_category"=>$search_category,
            "search_value"=>$search_value,
            ));

        // frontend->Controller->Model->Data back to controller->Controller->View->Sent back to User
    }

    public function actionMainSearchInfo()
    {
        $request = Yii::$app->request;
        $post = $request->post();

        if(!empty($post))
        {
            $_SESSION["mainSearchInfoPost"] = $post;
        }


        $search_category = $request->post('search_category',$_SESSION["mainSearchInfoPost"]["search_category"]);
        $search_value = $request->post('search_value',$_SESSION["mainSearchInfoPost"]["search_value"]);

        $functionName = "get".$search_category;
        $viewName = "search_".$search_category;

        $data = Search::$functionName($search_value);

        $tempExplode = explode("~~",$search_value);

        $search_value = (count($tempExplode) > 1) ? $tempExplode[1] : $search_value;

        $js = Yii::getAlias('@web/js/custom/index.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render("search_result",array(
            "viewData" => $data,
            "view" => $viewName,
            "search_category"=>$search_category,
            "search_value"=>$search_value,
        ));

        // frontend->Controller->Model->Data back to controller->Controller->View->Sent back to User
    }


    public function actionGetPrufzeichen()
    {
        if (Yii::$app->request->isAjax)
        {
            $request = Yii::$app->request;
            $val = $request->post('q');


            $sql = "SELECT id as id, pz as text FROM material  WHERE pz ILIKE '%{$val}%'";
            $pzExist = Yii::$app->db->createCommand($sql)->queryAll();

            print json_encode($pzExist);

            exit;

        }
    }

    public function actionGetUrteile()
    {
        if (Yii::$app->request->isAjax)
        {
            $request = Yii::$app->request;
            $val = $request->post('q');


            $sql = "SELECT id as id, part_label as text FROM material_family WHERE part_label ILIKE '%{$val}%'";
            $plExist = Yii::$app->db->createCommand($sql)->queryAll();

            print json_encode($plExist);

            exit;

        }
    }

    public function actionGetWerkstoffe()
    {
        if (Yii::$app->request->isAjax)
        {
            $request = Yii::$app->request;
            $val = $request->post('q');


            $sql = "SELECT DISTINCT On (pz_alt1) id as id, pz_alt1 as text FROM material WHERE pz_alt1 ILIKE '%{$val}%'";
            $werkstoff = Yii::$app->db->createCommand($sql)->queryAll();

            print json_encode($werkstoff);

            exit;

        }
    }

    public function actionGetLagerort()
    {
        if (Yii::$app->request->isAjax)
        {
            $request = Yii::$app->request;
            $val = $request->post('q');


            $sql = "SELECT DISTINCT On (storage_location) id as id, storage_location as text FROM material_family";
            $werkstoff = Yii::$app->db->createCommand($sql)->queryAll();

            print json_encode($werkstoff);

            exit;

        }
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
       
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
           return $this->redirect('main');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }



    public function actionMain()
    {
        $js = Yii::getAlias('@web/js/custom/index.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render('moechtensie');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPrint()
    {
        $js = Yii::getAlias('@web/js/qztray/qz-tray.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        $js = Yii::getAlias('@web/js/qztray/jsrsasign.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        $js = Yii::getAlias('@web/js/qztray/sign-message.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        $js = Yii::getAlias('@web/js/custom/printLabels.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render('labelprint');
    }

    public function actionSearch()
    {
        return $this->render('search');
    }

}
