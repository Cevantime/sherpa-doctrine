<?php

namespace Sherpa\Doctrine;

use DI\Container;
use Doctrine\ORM\Tools\Setup;
use Sherpa\App\App;
use Sherpa\Declaration\DeclarationInterface;

/**
 * Description of DoctrineDeclaration
 *
 * @author cevantime
 */
class DoctrineDeclarations implements DeclarationInterface
{

    public function register(App $app)
    {
        $containerBuilder = $app->getContainerBuilder();

        $containerBuilder->addDefinitions(__DIR__.'/definitions.php');
    }

}
