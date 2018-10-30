<?php

namespace Sherpa\Doctrine;

use DI\Container;
use function DI\env;
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
            'doctrine.config' => function (Container $container) {
                return Setup::createAnnotationMetadataConfiguration([$container->get('project.src') . "/Entity"], $container->get('debug'));
            },
            EntityManagerInterface::class => function (Container $container) {
                return EntityManager::create(
                    $container->get('doctrine.connection'),
                    $container->get('doctrine.config')
                );
            },
            'doctrine.entity_folders' => function (Container $container) {
                [$container->get('project.src') . "/Entity"];
            },
            'doctrine.manager' => get(EntityManagerInterface::class),
            'doctrine.connection' => function (Container $container) {
                return ['url' => $container->get('doctrine.connection.url')];
            },
            'doctrine.connection.url' => env('DATABASE_URL')
        ]);
    }

}
