Open Api Swagger 3 for Yii2 Framework
================

Requirements
------------
 - PHP 7.1
 - Yii2 Framework

Installation
------------

The preferred way to install this wrapper is through [composer](http://getcomposer.org/download/).

```bash
php composer.phar require genxoft/yii2-oas3 "*"
```

or

```bash
composer require genxoft/oas3 "*"
```

or add to the require section of `composer.json`

```
"genxoft/oas3" : "*"
```

Integration
-----

Add action to web controller (for example SiteController.php):

```php
public function actions()
{
    return [
        'api-docs' => [
            'class' => 'genxoft\swagger\ViewAction',
            'apiJsonUrl' => \yii\helpers\Url::to(['/site/api-json'], true),
        ],
        'api-json' => [
            'class' => 'genxoft\swagger\JsonAction',
            'dirs' => [
                Yii::getAlias('@api/modules/api/controllers'),
                Yii::getAlias('@api/modules/api/models'),
                Yii::getAlias('@api/models'),
            ],
        ],
    ];
}
```

Open Api Swagger 3 example annotation
-------------------------------------

Api server description

```php
/**
 * @OA\Info(
 *   version="1.0",
 *   title="Application API",
 *   description="Server - Mobile app API",
 *   @OA\Contact(
 *     name="John Smith",
 *     email="john@example.com",
 *   ),
 * ),
 * @OA\Server(
 *   url="https://example.com/api",
 *   description="main server",
 * )
 * @OA\Server(
 *   url="https://dev.example.com/api",
 *   description="dev server",
 * )
 */
 
class DefaultController extends Controller
{
...
```

Controller annotation

```php
/**
 * @OA\Get(path="/",
 *   summary="Handshake",
 *   tags={"handshake"},
 *   @OA\Parameter(
 *     name="access-token",
 *     in="header",
 *     required=false,
 *     @OA\Schema(
 *       type="string"
 *     )
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Returns Hello object",
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(ref="#/components/schemas/Hello"),
 *     ),
 *   ),
 * )
 */
public function actionIndex()
{
... 
```

Model annotation

```php
/**
 *@OA\Schema(
 *  schema="Hello",
 *  @OA\Property(
 *     property="message",
 *     type="string",
 *     description="Text message"
 *  ),
 *  @OA\Property(
 *     property="time",
 *     type="integer",
 *     description="Server current Unix time"
 *  ),
 *  @OA\Property(
 *     property="date",
 *     type="string",
 *     format="date-time",
 *     description="Server current date time"
 *  )
 *)
 */
class Hello extends Model
{
...
```

## Donate
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2PURUX2SHUD9E"><img src="https://www.paypalobjects.com/en_US/RU/i/btn/btn_donateCC_LG.gif"></a>

## LICENSE

This curl wrapper is released under the [MIT license](https://github.com/walkor/workerman/blob/master/MIT-LICENSE.txt).