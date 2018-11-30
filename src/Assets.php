<?php
/**
 * Yii2 php swagger module
 *
 * @author    Simon Rodin <master@genx.ru>
 * @license   http://opensource.org/licenses/MIT MIT Public
 * @link      https://github.com/genxoft/yii2-swagger
 *
 */

namespace genxoft\swagger;

use yii\web\AssetBundle;
use yii\web\View;

class Assets extends AssetBundle
{
    public $sourcePath = '@bower/swagger-ui/dist';
    
    public $js = [
        'swagger-ui-bundle.js',
        'swagger-ui-standalone-preset.js',
    ];
    
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    
    public $css = [
        [
            'swagger-ui.css',
            'media' => 'screen, print',
        ],
    ];
}
