<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Search extends Model
{
    public static function getprufzeichen($search_text)
    {
        $resTemp = explode("~~",$search_text);

        $dataArr = array();

        if($resTemp[0] == '-1')
        {
            $sql = "SELECT material.*, fullname as orgname, forename as name, surname as nachname, assignment_number as auftrag FROM material
                            LEFT OUTER JOIN organization ON material.mat_owner = organization.id
                            LEFT OUTER JOIN assignment ON material.mat_owner = customer_id
                            LEFT OUTER JOIN lambdauser ON material.c_id = lambdauser.id
                            WHERE pz ILIKE '%{$resTemp[1]}%'";

            $dataArr = Yii::$app->db->createCommand($sql)->queryAll();
        }

        else
        {
            $sql = "SELECT material.*, fullname as orgname, forename as name, surname as nachname, assignment_number as auftrag FROM material
                            LEFT OUTER JOIN organization ON material.mat_owner = organization.id
                            LEFT OUTER JOIN assignment ON material.mat_owner = customer_id
                            LEFT OUTER JOIN lambdauser ON material.c_id = lambdauser.id
                            WHERE pz ='{$search_text}'";

            $dataArr = Yii::$app->db->createCommand($sql)->queryOne();

            $sql = "SELECT * FROM material_family WHERE material_id = {$dataArr['id']}";
            $matFamilyRes = Yii::$app->db->createCommand($sql)->queryAll();

            $dataArr['materialFamily'] = $matFamilyRes;

        }

        $resturnArray = array(
            "isTable" => ($resTemp[0] == '-1') ? 1 : 0,
            "data" => $dataArr,

        );
        return $resturnArray;

    }

    public static function geturteile($search_text)
    {
        $resTemp = explode("~~",$search_text);

        if($resTemp[0] == '-1') {

            $sql = "SELECT * FROM material_family WHERE part_label ILIKE '%{$resTemp[1]}%'";

            $data = Yii::$app->db->createCommand($sql)->queryAll();
        }
        else{

            $sql = "SELECT * FROM material_family WHERE part_label='{$search_text}'";

            $data = Yii::$app->db->createCommand($sql)->queryOne();

            $sql = "SELECT material.* , fullname as orgname, forename as name, surname as nachname, assignment_number as auftrag FROM material
                            LEFT OUTER JOIN organization ON material.mat_owner = organization.id
                            LEFT OUTER JOIN assignment ON material.mat_owner = customer_id
                            LEFT OUTER JOIN lambdauser ON material.c_id = lambdauser.id
                            WHERE material.id = {$data['material_id']}";

            $matData = Yii::$app->db->createCommand($sql)->queryAll();

            $data['matInfo'] = $matData;

            $sql = "SELECT origname FROM fotos WHERE part_label_id = {$data['id']}";
            $partImages = Yii::$app->db->createCommand($sql)->queryAll();

            $data['partImages'] = $partImages;

            $sql = "SELECT origname FROM drawings WHERE part_label_id = {$data['id']}";
            $partDrawings = Yii::$app->db->createCommand($sql)->queryAll();

            $data['partDrawings'] = $partDrawings;

        }

        $resturnArray = array(
            "isTable" => ($resTemp[0] == '-1') ? 1 : 0,
            "data" => $data,


        );

        return $resturnArray;

    }

    public static function getwerkstoffe($search_text)
    {
        $resTemp = explode("~~",$search_text);

        if($resTemp[0] == '-1'){

            $sql = "SELECT * FROM material WHERE pz_alt1 ILIKE '%{$resTemp[1]}%'";

            $werkstoffe = Yii::$app->db->createCommand($sql)->queryAll();
        }
        else {

            $sql = "SELECT * FROM material WHERE pz_alt1='{$search_text}'";

            $werkstoffe = Yii::$app->db->createCommand($sql)->queryAll();

        }

        $resturnArray = array(
            "isTable" => ($resTemp[0] == '-1') ? 1 : 0,
            "data" => $werkstoffe,

        );

        return $resturnArray;

    }

    public static function getlagerort($search_text)
    {
        $sql = "SELECT * FROM material_family WHERE storage_location='{$search_text}'";

        $ort = Yii::$app->db->createCommand($sql)->queryAll();

        $resturnArray = array(

            "data" => $ort,
        );

        return $resturnArray;

    }

}