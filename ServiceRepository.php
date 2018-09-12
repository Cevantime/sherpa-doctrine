<?php


namespace Sherpa\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Description of InjectableRepository
 *
 * @author cevantime
 */
class ServiceRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, string $class)
    {
        parent::__construct($em, $em->getClassMetadata($class));
    }
}
