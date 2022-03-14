<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class Fvwht extends Model
{
public static function getBinFiles()
{


$sql = "SELECT * FROM binfiles ORDER BY origname";


$results = array();

$results = Yii::$app->db->createCommand($sql)->queryAll();


$total = count($results);

$json = '{"recordsTotal":"' . $total . '","recordsFiltered":"' . $total . '","data":' . json_encode($results) . '}';
return $json;

}
}