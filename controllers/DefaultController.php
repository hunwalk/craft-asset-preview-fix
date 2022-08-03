<?php

namespace modules\assetpreview\controllers;

use Craft;
use craft\elements\Asset;
use craft\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex($assetId){

        $this->requireCpRequest();
        $this->requireAdmin();

        $asset = Asset::findOne($assetId);
        if ($asset){
            $volume = $asset->getVolume();
            $img = Craft::getAlias($volume->getFs()->path.'/'.$asset->getPath());
            $info = getimagesize($img);
            header('Content-type: ' . $info['mime']);
            readfile($img);
            exit;
        }
        return null;
    }
}