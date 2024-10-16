<?php

namespace App\Repository;

use App\Entity\Contacto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contacto>
 */
class ContactoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contacto::class);
    }
	
	public function existsToday($email)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.fecha_envio >= :startOfDay')
            ->andWhere('c.fecha_envio <= :endOfDay')
            ->andWhere('c.correo = :email')
            ->setParameter('startOfDay', new \DateTime('today'))
            ->setParameter('endOfDay', new \DateTime('tomorrow'))
            ->setParameter('email', $email);
		
        return count($qb->getQuery()->getResult()) > 0;	
    }
}
