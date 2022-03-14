<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\models\Info;

class InfoController extends \yii\web\Controller
{

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    public function actionIndex() {
        // Create query

        $js = Yii::getAlias('@web/js/custom/lieferantTable.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);
                            
        $js = Yii::getAlias('@web/js/custom/material.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render('index');
    }

    public function actionLieferant()
    {
        return $this->render('lieferant');
    }

    public function actionGetMaterialLieferant()
    {
        if (Yii::$app->request->isAjax) 
        {
            $json = Info::getMaterialLieferant();
            echo $json;
            exit;
        }
        
    }

    public function actionNeueLieferantForm()
    {
        if (Yii::$app->request->isAjax) 
        {
            return $this->renderPartial('create');
        }
        
    }

    public function actionSaveNeueLieferant()
    {
        if (Yii::$app->request->isAjax) 
        {
            $request = Yii::$app->request;
            $post = Yii::$app->request->post();

            $post = array_map(function($value) 
            {
                if(trim($value) === "" && $value != 0)
                {
                   return NULL;
                }

                
                else
                {
                    $value = str_replace("'", "", $value);
                    $value = str_replace('"', "", $value);
                    return trim($value);
                }

            }, $post);

            $post["c_id"] = $_SESSION['__id'];
            $post["m_id"] = $_SESSION['__id'];

            $post["ctime"] = "now()";
            $post["mtime"] = "now()";

            $post["nickname"] = $post["fullname"];

           $result = Yii::$app->db->createCommand()->insert("organization", $post)->execute();

           if($result)
           {
             $json = '{"success":"true","error":"false"}';
           }

           else{
            $json = '{"success":"false","error":"true"}';
           }

           echo $json;

        }
        
    }

    public function actionSaveNeueMaterial()
    {
        if (Yii::$app->request->isAjax) 
        {
            $request = Yii::$app->request;
            $post = Yii::$app->request->post("material");

            $post = array_map(function($value) 
            {
                if(trim($value) === "" && $value != 0)
                {
                   return NULL;
                }

                else
                {
                    $value = str_replace("'", "", $value);
                    $value = str_replace('"', "", $value);
                    return trim($value);
                }

            }, $post);

            $post["c_id"] = $_SESSION['__id'];
            $post["m_id"] = $_SESSION['__id'];

            $post["ctime"] = "now()";
            $post["mtime"] = "now()";
            $post["vpz_available"] = 0;


           $result = Yii::$app->db->createCommand()->insert("material", $post)->execute();

           if($result)
           {
             $json = '{"success":"true","error":"false"}';
           }

           else{
            $json = '{"success":"false","error":"true"}';
           }

           echo $json;

        }
        
    }

    public function actionPrufzeichen()
    {
       
        if (Yii::$app->request->isAjax) 
        {
           
            $request = Yii::$app->request;
            $val = $request->post('val');

            $len = strlen($val);

            if($len < 3)
            {
                $sql = "SELECT id,pz FROM material WHERE substring(pz,1,2) = '".$val."' ORDER BY pz ASC";
            }

            else
            {
                $sql = "SELECT id,pz FROM material WHERE pz = '".$val."' ORDER BY pz ASC";
            }

            $used = ArrayHelper::map(Yii::$app->db->createCommand($sql)->queryAll(), 'id', 'pz');


            $free = array();

            if($len < 3)
            {
                foreach(range('A','Z') as $i)
                {
                    $checkString = $val.$i;

                    if(!in_array($checkString, $used))
                    {
                       $free[] =  $checkString;
                    }
                }
            }

            else
            {
                if(empty($used))
                {
                   $free[] = $val;  
                }
            }

            print json_encode(array('used' => $used,'free' => $free));
            exit;
        }
    }
}
