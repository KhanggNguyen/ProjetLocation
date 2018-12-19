<?php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN

namespace UM2\PlatformBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class OutilsRepository extends EntityRepository
{

	public function getOutils($page, $nbPerPage)
	{
		$query = $this->createQueryBuilder('o')
			->where('o.active = :etat')
			->setParameter('etat', true)
			->orderBy('o.date', 'DESC')
			->getQuery();

		$query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);

		return new Paginator($query, true);
	}

	public function getOutilsByUser($id,$page, $nbPerPage){
		$query = $this->createQueryBuilder('o')
			->where('o.vendeur = :vendeur')
			->setParameter('vendeur', $id)
			->orderBy('o.date', 'DESC')
			->getQuery();

		$query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);
		return new Paginator($query, true);
	}

	


}

?>