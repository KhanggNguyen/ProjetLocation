<?php


namespace UM2\PlatformBundle\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class OutilsRepository extends EntityRepository
{

	public function getOutils($page, $nbPerPage)
	{
		$query = $this->createQueryBuilder('g')
			->orderBy('g.date', 'DESC')
			->getQuery();

		$query->setFirstResult(($page-1) * $nbPerPage)->setMaxResults($nbPerPage);

		return new Paginator($query, true);
	}

}

?>