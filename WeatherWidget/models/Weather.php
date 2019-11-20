<?php
namespace app\widgets\WeatherWidget\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;

/**
 * ContactForm is the model behind the contact form.
 */
class Weather extends Model
{

    const CELCIUS_VAL = '273.15';

    public $key = '99c4ec80cabf954a2cc64075bf993315';

    public function getWeatherReport()
    {
        $celcius = '';
        $currentCity = $this->getCurrentCity();
        try {
            $jsonurl = "http://api.openweathermap.org/data/2.5/weather?q=$currentCity&appid=$this->key";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $jsonurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            $weather = json_decode($output);
            if (! empty($weather)) {

                return $weather;
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Weather not found');
            }
        } catch (Exception $e) {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }

        return false;
    }

    public function getCurrentCity()
    {
        $ip = Yii::$app->getRequest()->getUserIP();
        $fip = '117.241.97.88';
        if (! empty($ip) && (! $ip == '127.0.0.1')) {
            $fip = $ip;
        }
        try {
            $jsonurl = "https://www.iplocate.io/api/lookup/$fip";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $jsonurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($output);

            if (! empty($data)) {

                return ! empty($data->city) ? $data->city : 'Mohali';
            } else {
                \Yii::$app->getSession()->setFlash('error', 'Weather not found');
            }
        } catch (Exception $e) {
            \Yii::$app->getSession()->setFlash('error', $e->getMessage());
        }

        return false;
    }
}
