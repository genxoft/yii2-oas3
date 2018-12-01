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

use Yii;
use yii\base\Action;
use yii\web\Response;
use Symfony\Component\Finder\Finder;

class JsonAction extends Action
{
    /**
     * @var string|array|Finder directory(s) or filename(s) with open api annotations.
     */
    public $dirs;

    /**
     * @var array The options passed to `OpenApi`, Please refer the `\OpenApi\scan` function for more information.
     */
    public $scanOptions = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->initCors();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return \OpenApi\scan($this->dirs, $this->scanOptions);
    }

    /**
     * Init cors.
     */
    protected function initCors()
    {
        $headers = Yii::$app->getResponse()->getHeaders();

        $headers->set('Access-Control-Allow-Headers', 'Content-Type');
        $headers->set('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT');
        $headers->set('Access-Control-Allow-Origin', '*');
        $headers->set('Allow', 'OPTIONS,HEAD,GET');
    }
}
