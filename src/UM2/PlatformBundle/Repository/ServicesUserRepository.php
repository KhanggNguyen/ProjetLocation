<?php
//auteur : Khang NGUYEN - Licence 3 

namespace UM2\PlatformBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ServicesUserRepository extends EntityRepository
{
	public function findByOutil($id){
		$query = $this->createQueryBuilder('o')
			->orderBy('o.date', 'DESC')
			->getQuery()->getResult();

		return $query;
	}

}