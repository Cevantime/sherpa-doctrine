<?php

namespace Sherpa\Doctrine;

/**
 * Description of PostInstall
 *
 * @author cevantime
 */
class PostInstall
{

    public static function execute()
    {
        $configFolder = 'config';
        
        if (!file_exists($configFolder)) {
            mkdir($configFolder);
        }
        $layout = "<?php
/* @var \$this League\Plates\Template\Template */
?>
<html>
    <head>
        <title>Test Plates</title>
    </head>
    <body>
        <?php echo \$this->section('body'); ?>
    </body>
</html>";
        $template = "<?php
/* @var \$this League\Plates\Template\Template */
\$this->layout('layout');
?>
<?php \$this->start('body'); ?>
    Hello Plates !!
<?php \$this->stop();";
        if (!file_exists($layoutFile = $configFolder . '/' . $layoutFileName . '.php')) {
            file_put_contents($layoutFile, $layout);
        }
        if (!file_exists($templateFile = $configFolder . '/' . $templateFileName . '.php')) {
            file_put_contents($templateFile, $template);
        }
    }

}
