<?php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN

namespace UM2\PlatformBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class OutilsUserRepository extends EntityRepository
{
	public function findByOutil($id){
		$query = $this->createQueryBuilder('o')
			->orderBy('o.date', 'DESC')
			->getQuery()->getResult();

		return $query;
	}


}