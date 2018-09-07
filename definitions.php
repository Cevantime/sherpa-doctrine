<?php

return [
    'doctrine.config' => function(Container $container) use ($app) {
        return Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src/Entity"], $app->isDebug());
    },
    'doctrine.manager' => function(Container $container) {
        return Doctrine\ORM\EntityManager::create(
            $container->get('doctrine.connection'), 
            $container->get('doctrine.config')
        );
    }
];
