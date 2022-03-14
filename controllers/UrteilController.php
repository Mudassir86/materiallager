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
use yii\imagine\Image;

class UrteilController extends \yii\web\Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $js = Yii::getAlias('@web/js/custom/urteil.js?cb=' . uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render('index');
    }

    public function actionArticleSpecs()
    {
        return $this->render('articleSpecs');
    }

    public function actionLagerOrt()
    {
        return $this->render('lagerOrt');
    }

    public function actionFileUpload()
    {
        return $this->render('fileUpload');
    }

    public function actionZeichnung()
    {
        return $this->render('zeichnung');
    }

    public function actionLiefer()
    {
        return $this->render('liefer');
    }

    public function actionGetPz()
    {
        if (Yii::$app->request->isAjax)
        {
            $request = Yii::$app->request;
            $val = $request->post('q');

            $sql = "SELECT material.*, fullname, forename, name, surname,
                        (SELECT COALESCE(MAX(child_id),0) FROM material_family WHERE material_family.material_id = material.id) as start_label_id     
                        FROM material
                        LEFT OUTER JOIN organization ON material.mat_owner = organization.id 
                        LEFT OUTER JOIN lambdauser ON material.c_id = lambdauser.id WHERE pz ILIKE '%{$val}%'";
            $pzExist = Yii::$app->db->createCommand($sql)->queryAll();


            print json_encode($pzExist);

            exit;

        }
    }

    public function actionSaveMaterialFamily()
    {
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request;
            $post = Yii::$app->request->post("material_family");

            $matId = $post['material_id'];

            $sql = "SELECT mat_owner FROM material WHERE id =" .$matId;

            $isSingleFoto = (isset($_POST['isSingleFoto'])) ? 1 : 0;

            $childID = Yii::$app->request->post("nextChildId");

            $labels = Yii::$app->request->post("labelName",array());

            $files = (isset($_FILES['files'])) ? $_FILES['files'] : array();

            $filesDrawing = (isset($_FILES['filesDrawing'])) ? $_FILES['filesDrawing'] : array();

            $filesDelivery = (isset($_FILES['filesDelivery'])) ? $_FILES['filesDelivery'] : array();

            $filesBin = (isset($_FILES['filesBin'])) ? $_FILES['filesBin'] : array();

            $owner = Yii::$app->db->createCommand($sql)->queryScalar();


            $form_chkbox = $post['form'];

            $post = array_map(function ($value) {
                if (trim($value) === "" && $value != 0) {
                    return NULL;
                } else {
                    $value = str_replace("'", "", $value);
                    $value = str_replace('"', "", $value);
                    return trim($value);
                }

            }, $post);


            $fotos_uploaded = array();
            $drawings_uploaded = array();
            $deliveryNotes_uploaded = array();
            $binFiles_uploaded = array();

            $firstLabel = $labels[0];

            //$folderpath = Yii::getAlias('/usr/local/material_uploads/');
            $folderpath = Yii::getAlias('@app/web/uploads/');

            $isSingleFotoUploaded = array();

            $transaction = Yii::$app->db->beginTransaction();

            $err_msg = "";
            try {

                foreach ($labels as $key => $label)
                {
                    $post['part_label'] = $label;
                    $post['child_id'] = $key+ $childID;
                    $post["c_id"] = $_SESSION['__id'];
                    $post["m_id"] = $_SESSION['__id'];
                    $post["ctime"] = "now()";
                    $post["mtime"] = "now()";
                    $result = Yii::$app->db->createCommand()->insert("material_family", $post)->execute();

                    $part_label_id = Yii::$app->db->getLastInsertID('material_family_id_seq');

                    if($isSingleFoto == 1)
                    {
                        $filesNames = $files["name"][$firstLabel];
                        $filesTemps = $files["tmp_name"][$firstLabel];
                        $filesSize = $files["size"][$firstLabel];
                        $filesError = $files["error"][$firstLabel];

                    }

                    else
                    {
                        $filesNames = $files["name"][$label];
                        $filesTemps = $files["tmp_name"][$label];
                        $filesSize = $files["size"][$label];
                        $filesError = $files["error"][$label];
                    }



                    /// START CODE FOR FILE INSERTION OF MAIN LABELS FILES
                    foreach($filesNames as $keyName => $f_name) {

                        if($filesError[$keyName] == 0)
                        {
                            $counter = $keyName+1;
                            $fileName = preg_replace(
                                '~
                                [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
                                [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
                                [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
                                [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
                                [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
                                ~x',
                                '-', $f_name);


                            $sourcePath = $filesTemps[$keyName];
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                            $filename = $nameWithoutExtension . '_' . $part_label_id."_".$counter. '.' . $ext;

                            $fotosTargetPath = $folderpath."material_fotos/". $filename;

                            $isFileUploaded = ($isSingleFoto == 1 && $key !=0) ? copy($isSingleFotoUploaded[$keyName], $fotosTargetPath) : move_uploaded_file($sourcePath, $fotosTargetPath);
                            // Moving Uploaded file
                            if ($isFileUploaded == 1) {

                                $thumbnail_name = $folderpath."material_fotos/t_". $filename;
                                Image::thumbnail($fotosTargetPath, 100, 100)
                                    ->save($thumbnail_name, ['quality' => 80]);


                                if($isSingleFoto == 1 && $key==0)
                                {
                                    $isSingleFotoUploaded[] = $fotosTargetPath;
                                }

                                $fotos_uploaded[] = $fotosTargetPath;
                                $value = array(
                                    "part_label_id" => $part_label_id, // HAVE TO CREATE THIS COLUMN IN TABlE
                                    "material_id" => $post['material_id'],
                                    "name" => md5($nameWithoutExtension . "now()"),
                                    "origname" => $filename,
                                    "owner" => $owner,
                                    "hkey" => md5($nameWithoutExtension),
                                    "filesize" => $filesSize[$keyName],
                                    "ctime" => "now()",
                                    "mtime" => "now()"
                                );

                                Yii::$app->db->createCommand()->insert("fotos", $value)->execute();
                            }
                        }

                    }
                    /// END CODE FOR FILE INSERTION OF MAIN LABELS FILES

                    /// START CODE FOR FILE INSERTION OF DRAWING FILES FOR EACH LABEL
                    $drawingFiles = (!empty($filesDrawing)) ? $filesDrawing["name"] : array();
                    $drawingFileCounter = 0;
                    foreach($drawingFiles as $keyName => $f_name) {

                        if($filesDrawing["error"][$keyName] == 0)
                        {
                            $drawingFileCounter = $keyName+1;
                            $fileName = preg_replace(
                                '~
                                [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
                                [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
                                [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
                                [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
                                [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
                                ~x',
                                '-', $f_name);


                            $sourcePath = $filesDrawing["tmp_name"][$keyName];
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                            $filename = $nameWithoutExtension . '_' . $part_label_id."_".$drawingFileCounter. '.' . $ext;

                            $drawingsTargetPath = $folderpath."drawings/". $filename;

                            $isFileUploaded = ($key !=0) ? copy($drawings_uploaded[$keyName], $drawingsTargetPath) : move_uploaded_file($sourcePath, $drawingsTargetPath);

                            // Moving Uploaded file
                            if ($isFileUploaded == 1) {

                                $drawings_uploaded[] = $drawingsTargetPath;
                                $value = array(
                                    "part_label_id" => $part_label_id, // HAVE TO CREATE THIS COLUMN IN TABlE
                                    "material_id" => $post['material_id'],
                                    "name" => md5($nameWithoutExtension . "now()"),
                                    "origname" => $filename,
                                    "owner" => $owner,
                                    "hkey" => md5($nameWithoutExtension),
                                    "filesize" => $filesDrawing["size"][$keyName],
                                    "ctime" => "now()",
                                    "mtime" => "now()"
                                );

                                Yii::$app->db->createCommand()->insert("drawings", $value)->execute();
                            }
                        }

                    }

                    /// END CODE FOR FILE INSERTION OF DRAWING FILES FOR EACH LABEL

                    /// START CODE FOR FILE INSERTION OF DELIVERY FILES FOR EACH LABEL
                    ///

                    $filesNameDelivery = (!empty($filesDelivery)) ? $filesDelivery["name"] : array();
                    $drawingFileCounter = 0;
                    foreach($filesNameDelivery as $keyName => $f_name) {

                        if($filesDelivery["error"][$keyName] == 0)
                        {
                            $deliveryFileCounter = $keyName+1;
                            $fileName = preg_replace(
                                '~
                                [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
                                [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
                                [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
                                [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
                                [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
                                ~x',
                                '-', $f_name);


                            $sourcePath = $filesDelivery["tmp_name"][$keyName];
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                            $filename = $nameWithoutExtension . '_' . $part_label_id."_".$deliveryFileCounter. '.' . $ext;



                            $deliveryTargetPath = $folderpath."delivery_notes/". $filename;

                            $isFileUploaded = ($key !=0) ? copy($deliveryNotes_uploaded[$keyName], $deliveryTargetPath) : move_uploaded_file($sourcePath, $deliveryTargetPath);

                            // Moving Uploaded file
                            if ($isFileUploaded == 1) {

                                $deliveryNotes_uploaded[] = $deliveryTargetPath;
                                $value = array(
                                    "part_label_id" => $part_label_id, // HAVE TO CREATE THIS COLUMN IN TABlE
                                    "material_id" => $post['material_id'],
                                    "name" => md5($nameWithoutExtension . "now()"),
                                    "origname" => $filename,
                                    "owner" => $owner,
                                    "hkey" => md5($nameWithoutExtension),
                                    "filesize" => $filesDelivery["size"][$keyName],
                                    "ctime" => "now()",
                                    "mtime" => "now()"
                                );

                                Yii::$app->db->createCommand()->insert("delivery_notes", $value)->execute();
                            }
                        }

                    }
                    /// END CODE FOR FILE INSERTION OF DELIVERY FILES FOR EACH LABEL

                    /// START CODE FOR FILE INSERTION OF BINFILES FOR EACH LABEL
                    $filesNameBin = (!empty($filesBin)) ? $filesBin["name"] : array();
                    $binFileCounter = 0;
                    foreach($filesNameBin as $keyName => $f_name) {

                        if($filesBin["error"][$keyName] == 0)
                        {
                            $binFileCounter = $keyName+1;
                            $fileName = preg_replace(
                                '~
                                [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
                                [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
                                [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
                                [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
                                [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
                                ~x',
                                '-', $f_name);


                            $sourcePath = $filesBin["tmp_name"][$keyName];
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                            $filename = $nameWithoutExtension . '_' . $part_label_id."_".$binFileCounter. '.' . $ext;

                            $binFilesTargetPath = $folderpath."vorprüfzeugnis/". $filename;

                            $isFileUploaded = ($key !=0) ? copy($binFiles_uploaded[$keyName], $binFilesTargetPath) : move_uploaded_file($sourcePath, $binFilesTargetPath);

                            // Moving Uploaded file
                            if ($isFileUploaded == 1) {

                                $binFiles_uploaded[] = $binFilesTargetPath;
                                $value = array(
                                    "material_id" => $post['material_id'],
                                    "name" => md5($nameWithoutExtension . "now()"),
                                    "origname" => $filename,
                                    "owner" => $owner,
                                    "hkey" => md5($nameWithoutExtension),
                                    "filesize" => $filesBin["size"][$keyName],
                                    "ctime" => "now()",
                                    "mtime" => "now()"
                                );

                                Yii::$app->db->createCommand()->insert("binfiles", $value)->execute();
                            }
                        }

                    }
                    /// END CODE FOR FILE INSERTION OF BINFILES FOR EACH LABEL



                }




            } catch (\Exception $e) {
                $transaction->rollBack();

                foreach ($fotos_uploaded as $fotopath)
                {
                    if(file_exists($fotopath))
                    {
                        unlink($fotopath);

                    }
                }

                foreach ($drawings_uploaded as $drawingpath){
                    if(file_exists($drawingpath))
                    {
                        unlink($drawingpath);

                    }
                }
                foreach ($deliveryNotes_uploaded as $deliverypath){
                    if(file_exists($deliverypath))
                    {
                        unlink($deliverypath);

                    }
                }
                foreach ($binFiles_uploaded as $binfilespath){
                    if(file_exists($binfilespath))
                    {
                        unlink($binfilespath);

                    }
                }


                $json = '{"success":"false","error":"true", "message" : "'.$e->getMessage().'"}';

                echo $json;
                exit;

            }
            $transaction->commit();

            $json = '{"success":"true","error":"false","message":""}';

            echo $json;
        }
    }
}
