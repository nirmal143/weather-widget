<?php
namespace app\widgets\WeatherWidget;

use Yii;
use app\widgets\WeatherWidget\assets\AppAsset;

class WeatherWidget extends \yii\bootstrap\Widget
{

    public function init()
    {
        parent::run();
        AppAsset::register($this->view);
    }

    /**
     *
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('weather/index');
    }
}
