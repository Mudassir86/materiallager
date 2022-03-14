<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Info extends Model
{
    public static function getMaterialLieferant()
    {

       
        $sql = "SELECT * FROM organization ORDER BY fullname";


       $results = array();

       $results = Yii::$app->db->createCommand($sql)->queryAll();

        
        $total = count($results);

            $json = '{"recordsTotal":"' . $total . '","recordsFiltered":"' . $total . '","data":' . json_encode($results) . '}';
            return $json;

    }
}

