<?php

namespace app\controllers;

use app\models\Material;
use app\models\Organization;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use app\models\Info;

class FvwhtController extends \yii\web\Controller
{

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    public function actionIndex() {


        $js = Yii::getAlias('@web/js/custom/lieferantTable.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        $js = Yii::getAlias('@web/js/custom/fvwht.js?cb='.uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render('index');
    }

    public function actionCreate()
    {
        return $this->render('create');
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

    public function actionSaveNeueFvwht()
    {

        if (Yii::$app->request->isAjax)
        {
            $request = Yii::$app->request;
            $files = (isset($_FILES['files'])) ? $_FILES['files'] : array();

            $transaction = Yii::$app->db->beginTransaction();

            $err_msg = "";

            try
            {
                //----------Sending data to table material----------//

                $post = $request->post("material");

                $post = array_map(function ($value) {
                    if (trim($value) === "" && $value != 0) {
                        return NULL;
                    } else {
                        $value = str_replace("'", "", $value);
                        $value = str_replace('"', "", $value);
                        return trim($value);
                    }

                }, $post);

                if ($files["name"][0] != ""){
                    $post["vpz_available"] = 1;
                }
                else {
                    $post["vpz_available"] = 0;
                }

                $post["c_id"] = $_SESSION['__id'];
                $post["m_id"] = $_SESSION['__id'];

                $post["ctime"] = "now()";
                $post["mtime"] = "now()";

                Yii::$app->db->createCommand()->insert("material", $post)->execute();

                $matId = Yii::$app->db->getLastInsertID('material_id_seq');
                $ownerId = $post["mat_owner"];

                if(isset($_FILES['files']) && !empty($_FILES['files']))
                {
                    if(isset($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0)
                    {
                        $this->saveFile($matId,$ownerId);
                    }

                }


            } catch (\Exception $e) {
                $transaction->rollBack();

                $json = '{"success":"false","error":"true", "message" : "' . $e->getMessage() . '"}';

                echo $json;
                exit;
            }

            $transaction->commit();

            $json = '{"success":"true","error":"false","message":""}';

            echo $json;

        }
    }

    public function saveFile($matId,$ownerId)
    {
        $post = Yii::$app->request->post("binfiles");
        $count = (isset($_FILES['files'])) ? count($_FILES['files']['name']) : 0;
        $folderpath = Yii::getAlias('/usr/local/material_uploads/');
        //$folderpath = Yii::getAlias('@app/web/uploads/');
        $fileUrl = "";

        for ($i = 0; $i < $count; $i++) {
            $fileName = $_FILES['files']['name'][$i];
            $sourcePath = $_FILES['files']['tmp_name'][$i];

            $fileType = FileHelper::getMimeType($sourcePath, null, false);
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
            $filename = $nameWithoutExtension . '-' . date('YmdHis') . '.' . $ext;
            $targetPath = $folderpath . $filename;
            // Moving Uploaded file
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $fileUrl = $filename;
            }

        }

        $myMime = array(
            "application/pdf" => "1",
            "application/vnd.ms-excel" => "2",
            "application/vnd.ms-word" => "3",
            "application/vnd.ms-powerpoint" => "4",
            "image/jpeg" => "5",
            "image/png" => "6"
        );

        $fType= ArrayHelper:: getValue($myMime, $fileType, 0);

        $time = "now()";
        $hash = md5($fileUrl . $time);

        $post["name"] = "fb_$hash";
        $post["origname"] = $fileName;
        $post["filetype"] = $fType;
        $post["owner"] = $ownerId;
        $post["hkey"] = md5($fileUrl);
        $post["filesize"] = filesize($targetPath);
        $post["ctime"] = $time;
        $post["mtime"] = $time;
        $post["material_id"] = $matId;

        $result = Yii::$app->db->createCommand()->insert("binfiles", $post)->execute();

        if($result)
        {
            $json = '{"success":"true","error":"false"}';
        }

        else{
            $json = '{"success":"false","error":"true"}';
        }

        return $json;
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
