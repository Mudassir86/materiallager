<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class EntnehmenController extends \yii\web\Controller
{
     public function actionIndex()
     {
        $js = Yii::getAlias('@web/js/custom/matEntnehmen.js?cb=' . uniqid());
        $this->getView()->registerJsFile($js);

        return $this->render('index');
     }

    /********** Fetch prüfzeichen from the material table **********/
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

    /********** Fetch partlabels from the material_family table **********/
    public function actionMatSelect()
    {

        if (Yii::$app->request->isAjax)
        {

            $request = Yii::$app->request;
            $val = $request->post('val');
            $form = $request->post('form');

            $sql = "SELECT id,part_label FROM material_family WHERE  material_id = '$val' AND form = '$form'";

            $matdata = ArrayHelper::map(Yii::$app->db->createCommand($sql)->queryAll(), 'id','part_label');

            return json_encode($matdata);
            exit;
        }
    }

    /********** Open Auftrag modal **********/
    public function actionNeueIndustrieauftragForm()
    {
        if (Yii::$app->request->isAjax)
        {
            return $this->renderPartial('createIndustrieauftrag');
        }

    }

    /********** Fetch auftragnummer(assignment number) from the asignment table **********/
    public function actionGetAuftragnummer()
    {

        if (Yii::$app->request->isAjax)
        {

            $request = Yii::$app->request;

            $sql = "SELECT id,assignment_number FROM assignment";

            $assignNr = Yii::$app->db->createCommand($sql)->queryAll();

            return json_encode($assignNr);
            exit;
        }
    }

    /********** Fetch auftraggeber(organization) from the organization table **********/
    public function actionGetAuftraggeber()
    {

        if (Yii::$app->request->isAjax)
        {

            $request = Yii::$app->request;

            $sql = "SELECT id,fullname FROM organization";

            $auftraggeber = Yii::$app->db->createCommand($sql)->queryAll();

            return json_encode($auftraggeber);
            exit;
        }
    }

    /********** Save new auftrag(assignment) in Assignment table **********/
    public function actionSaveNeueIndustrieauftrag()
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


            $result = Yii::$app->db->createCommand()->insert("assignment", $post)->execute();

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

    /********** Open auftraggeber(organization) modal **********/
    public function actionNeueAuftraggeberForm()
    {
        if (Yii::$app->request->isAjax)
        {
            return $this->renderPartial('createOrg');
        }

    }

    /********** Save auftraggeber(organization) in Organization table **********/
    public function actionSaveNeueAuftraggeber()
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

    /********** Entnehmen Menu **********/
    public function actionGetEntnehmenTab3Html()
    {
        $menu_index = $_POST["menu_index"];

        if($menu_index == 1)
        {
            return $this->renderPartial('werstatt');
        }


    }

    /********** Save Data **********/
    Public function actionSaveEntnehmen()
    {
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request;
            $post = Yii::$app->request->post("material_family");

            $partlabels = Yii::$app->request->post("partlabelNames",array());

            $matId = $post['material_id'];

            $sql = "SELECT mat_owner FROM material WHERE id =" .$matId;

            $childSql = "SELECT COALESCE(MAX(child_id),0) FROM material_family WHERE material_id =" .$matId;

            $childId = Yii::$app->db->createCommand($childSql)->queryScalar();

            $owner = Yii::$app->db->createCommand($sql)->queryScalar();

            $entnehemenFotos = (isset($_FILES['entnehemenFotos'])) ? $_FILES['entnehemenFotos'] : array();

            $entFilesDrawing = (isset($_FILES['entFilesDrawing'])) ? $_FILES['entFilesDrawing'] : array();

            //$folderpath = Yii::getAlias('/usr/local/material_uploads/');

            $folderpath = Yii::getAlias('@app/web/uploads/');

            $transaction = Yii::$app->db->beginTransaction();

            $isDrawingUploaded = array();
            $isFotoUploaded = array();

            $err_msg = "";
            try {

                foreach ($partlabels as $key => $partname) {

                    $indexKey = $key + 1;

                    $data = array(
                        "material_id" => $post['material_id'],
                        "assignment_id" => $post['assignment_id'],
                        "form" => $post['form'],
                        "child_id" => $childId+$indexKey,
                        "part_label" => $partname,
                        "parent_id" => $post[$partname]['parent_id'],
                        "length_mm" => $post[$partname]['length_mm'],
                        "width_mm" => $post[$partname]['width_mm'],
                        "height_mm" => $post[$partname]['height_mm'],
                        "total_mass_kg" => $post[$partname]['total_mass_kg']
                    );

                    $result = Yii::$app->db->createCommand()->insert("material_family", $data)->execute();

                    $part_label_id = Yii::$app->db->getLastInsertID('material_family_id_seq');

                    /// START OF CODE FOR DRAWING FILES INSERTION FOR EACH LABEL

                    $entDrawingFiles = (!empty($entFilesDrawing)) ? $entFilesDrawing["name"] : array();
                    $drawingFileCounter = 0;
                    foreach($entDrawingFiles as $keyName => $f_name) {

                        if($entFilesDrawing["error"][$keyName] == 0)
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

                            $sourcePath = $entFilesDrawing["tmp_name"][$keyName];
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                            $filename = $nameWithoutExtension . '_' . $part_label_id."_".$drawingFileCounter. '.' . $ext;

                            $drawingsTargetPath = $folderpath."drawings/". $filename;

                            $isFileUploaded = ($key !=0) ? copy($isDrawingUploaded[$keyName], $drawingsTargetPath) : move_uploaded_file($sourcePath, $drawingsTargetPath);

                            // Moving Uploaded file
                            if ($isFileUploaded == 1) {

                                $isDrawingUploaded[] = $drawingsTargetPath;
                                $drawingData = array(
                                    "part_label_id" => $part_label_id, // HAVE TO CREATE THIS COLUMN IN TABlE
                                    "material_id" => $post['material_id'],
                                    "name" => md5($nameWithoutExtension . "now()"),
                                    "origname" => $filename,
                                    "owner" => $owner,
                                    "hkey" => md5($nameWithoutExtension),
                                    "filesize" => $entFilesDrawing["size"][$keyName],
                                    "ctime" => "now()",
                                    "mtime" => "now()"
                                );

                                Yii::$app->db->createCommand()->insert("drawings", $drawingData)->execute();
                            }
                        }

                    }

                    /// END OF CODE FOR DRAWING FILES INSERTION FOR EACH LABEL

                    /// START CODE FOR FILE INSERTION OF BINFILES FOR EACH LABEL
                    $fotosName = (!empty($entnehemenFotos)) ? $entnehemenFotos["name"] : array();
                    $fotoCounter = 0;
                    foreach($fotosName as $keyName => $f_name) {

                        if($entnehemenFotos["error"][$keyName] == 0)
                        {
                            $fotoCounter = $keyName+1;
                            $fileName = preg_replace(
                                '~
                                [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
                                [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
                                [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
                                [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
                                [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
                                ~x',
                                '-', $f_name);

                            $sourcePath = $entnehemenFotos["tmp_name"][$keyName];
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
                            $filename = $nameWithoutExtension . '_' . $part_label_id."_".$fotoCounter. '.' . $ext;

                            $fotosTargetPath = $folderpath."material_fotos/". $filename;

                            $isFileUploaded = ($key !=0) ? copy($isFotoUploaded[$keyName], $fotosTargetPath) :  move_uploaded_file($sourcePath, $fotosTargetPath);

                            // Moving Uploaded file
                            if ($isFileUploaded == 1) {

                                $thumbnail_name = $folderpath."material_fotos/t_". $filename;
                                Image::thumbnail($fotosTargetPath, 100, 100)
                                   ->save($thumbnail_name, ['quality' => 80]);

                                $isFotoUploaded[] = $fotosTargetPath;
                                $value = array(
                                    "part_label_id" => $part_label_id,
                                    "material_id" => $post['material_id'],
                                    "name" => md5($nameWithoutExtension . "now()"),
                                    "origname" => $filename,
                                    "owner" => $owner,
                                    "hkey" => md5($nameWithoutExtension),
                                    "filesize" => $entnehemenFotos["size"][$keyName],
                                    "ctime" => "now()",
                                    "mtime" => "now()"
                                );

                                Yii::$app->db->createCommand()->insert("fotos", $value)->execute();
                            }
                        }

                    }
                    /// END CODE FOR FILE INSERTION OF BINFILES FOR EACH LABEL


                }

            }catch (\Exception $e) {
                $transaction->rollBack();

                foreach ($isDrawingUploaded as $drawing)
                {
                    if(file_exists($drawing))
                    {
                        unlink($drawing);

                    }
                }

                foreach ($isFotoUploaded as $foto)
                {
                    if(file_exists($foto))
                    {
                        unlink($foto);

                    }
                }

                $json = '{"success":"false","error":"true", "message" : "' . $e->getMessage() . '"}';

                echo $json;
                exit;
            }

            $transaction->commit();

            $json = '{"success":"true","error":"false","message":""}';

            echo $json;

        }
    }


}
