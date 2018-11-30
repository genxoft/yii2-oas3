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
use yii\caching\Cache;
use yii\web\Response;

class JsonAction extends Action
{
    /**
     * @var string|array|\Symfony\Component\Finder\Finder The directory(s) or filename(s).
     * If you configured the directory must be full path of the directory.
     */
    public $dirs;

    /**
     * @var array The options passed to `Swagger`, Please refer the `Swagger\scan` function for more information.
     */
    public $scanOptions = [];

    /**
     * @var Cache|string|null the cache object or the ID of the cache application component that is used to store
     * Cache the \Swagger\Scan
     */
    public $cache = null;

    /**
     * @var mixed a key identifying the cached value. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     */
    public $cacheKey = 'yii2-swagger-cache';

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->initCors();

        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->getRequest()->get('clear-cache', false))
            $this->clearCache();

        if ($this->cache !== null) {
            $cache = $this->getCache();
            if (($swagger = $cache->get($this->cacheKey)) === false) {
                $swagger = $this->getSwagger();
                $cache->set($this->cacheKey, $swagger);
            }
        } else {
            $swagger = $this->getSwagger();
        }

        return $swagger;
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

    /**
     * @internal
     * @throws \yii\base\ExitException
     * @throws \yii\base\InvalidConfigException
     */
    protected function clearCache()
    {
        $this->getCache()->delete($this->cacheKey);
        Yii::$app->response->content = 'Cache deleted.';
        Yii::$app->end();
    }

    /**
     * @return Cache
     * @throws \yii\base\InvalidConfigException
     */
    protected function getCache()
    {
        return is_string($this->cache) ? Yii::$app->get($this->cache, false) : $this->cache;
    }

    /**
     * Get swagger object
     *
     * @return \OpenApi\Annotations\OpenApi
     */
    protected function getSwagger()
    {
        $openApi = \OpenApi\scan($this->dirs, $this->scanOptions);
        return $openApi;
    }
}
