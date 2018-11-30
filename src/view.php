<?php

use genxoft\swagger\Assets;

Assets::register($this);
/** @var string $apiJsonUrl */
/** @var array $oauthConfig */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div id="swagger-ui"></div>
<script>
    window.onload = function() {
        // Begin Swagger UI call region
        const ui = SwaggerUIBundle({
            url: '<?= $apiJsonUrl; ?>',
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        });
        // End Swagger UI call region

        window.ui = ui
    }
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
