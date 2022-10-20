<?php

namespace modules\assetpreview;

use Craft;
use craft\elements\Asset;
use craft\events\DefineAssetThumbUrlEvent;
use craft\events\DefineAssetUrlEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\services\Assets;
use craft\web\UrlManager;
use yii\base\Event;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->controllerNamespace = 'modules\\assetpreview\\controllers';

        Event::on(UrlManager::class,UrlManager::EVENT_REGISTER_CP_URL_RULES, function (RegisterUrlRulesEvent $event){
            $event->rules['asset-preview/default/index'] = 'asset-preview/default/index';
        });

        Event::on(Asset::class, Asset::EVENT_DEFINE_URL, function (DefineAssetUrlEvent $event){
            $volume = $event->asset->getVolume();
            if (!$volume->getFs()->hasUrls){
                $event->url = '/useful/access/asset?uid='.$event->asset->uid.'&sendFile=0';
            }
        });

        Event::on(Assets::class, Assets::EVENT_DEFINE_THUMB_URL, function (DefineAssetThumbUrlEvent $event){
            $volume = $event->asset->getVolume();
            if (!$volume->getFs()->hasUrls){
                $event->url = '/useful/access/asset-thumb?uid='.$event->asset->uid.'&sendFile=0';
            }
        });

        parent::init();

    }
}