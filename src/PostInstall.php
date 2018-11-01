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
        $filename = 'cli-config';
        
        if (!file_exists($configFolder)) {
            mkdir($configFolder);
        }

        $cliConfig = '<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Zend\Diactoros\ServerRequestFactory;

require __DIR__.\'/../init.php\';

/**
 * @var \App\App $app
 */
$app->boot();

return ConsoleRunner::createHelperSet($app->get(\'doctrine.manager\'));
';
        if (!file_exists($layoutFile = $configFolder . '/' . $filename . '.php')) {
            file_put_contents($layoutFile, $cliConfig);
        }

    }

}
