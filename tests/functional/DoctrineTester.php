<?php
/**
 * Created by PhpStorm.
 * User: cevantime
 * Date: 01/11/18
 * Time: 17:32
 */

class DoctrineTester
{
    public static function getEntityManager()
    {
        $app = new \Sherpa\App\App();

        $app->addDeclaration(\Sherpa\Doctrine\DoctrineDeclarations::class);
        $app->boot();

        return $app->get(\Doctrine\ORM\EntityManagerInterface::class);
    }
}