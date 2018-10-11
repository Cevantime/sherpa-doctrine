<?php

namespace Sherpa\Doctrine;

use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Sherpa\App\App;
use Sherpa\Declaration\DeclarationInterface;
use function DI\get;

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

        $containerBuilder->addDefinitions([
            'doctrine.config' => function(Container $container) {
                return Setup::createAnnotationMetadataConfiguration([$container->get('projectSrc') . "/Entity"], $container->get('debug'));
            },
            EntityManagerInterface::class => function(Container $container) {
                return EntityManager::create(
                    $container->get('doctrine.connection'), 
                    $container->get('doctrine.config')
                );
            },
            'doctrine.manager' => get(EntityManagerInterface::class),
            'doctrine.connection' => function(Container $container) {
                $originalRequest = $container->get('original_request');
                $serverParams = $originalRequest->getServerParams();
                return ['url' => $serverParams['DATABASE_URL'] ?? ''];
            }
        ]);
    }

}
