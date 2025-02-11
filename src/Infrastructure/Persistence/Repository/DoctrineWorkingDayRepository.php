<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Entity\WorkingDay;
use App\Domain\Repository\WorkingDay\WorkingDayRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkingDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkingDay[]    findAll()
 * @method WorkingDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method WorkingDay|null findOneBy(array $criteria, array $orderBy = null)
 */
class DoctrineWorkingDayRepository extends ServiceEntityRepository implements WorkingDayRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkingDay::class);
    }

    public function save(WorkingDay $workingDay, bool $newEntity): void
    {
        if ($newEntity) $this->getEntityManager()->persist($workingDay);
        $this->getEntityManager()->flush();
    }

    public function delete(WorkingDay $workingDay): void
    {
        $this->getEntityManager()->remove($workingDay);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): ?WorkingDay
    {
        return $this->findOneBy(['id' => $id]);
    }
}
