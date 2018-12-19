<?php
//auteur : Huu Khang NGUYEN - Hoai Nam NGUYEN

namespace UM2\PlatformBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ServicesRepository extends EntityRepository
{

	public function findByPage($page, $nbPerPage)
	{
		$query = $this->createQueryBuilder('s')
			->where('s.active = :etat')
			->setParameter('etat', true)
			->orderBy('s.date', 'DESC')
			->getQuery();

		$query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);

		return new Paginator($query, true);
	}

	public function findByVendeur($id,$page, $nbPerPage){
		$query = $this->createQueryBuilder('s')
			->where('s.vendeur = :vendeur')
			->setParameter('vendeur', $id)
			->orderBy('s.date', 'DESC')
			->getQuery();

		$query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);
		return new Paginator($query, true);
	}
}

?>