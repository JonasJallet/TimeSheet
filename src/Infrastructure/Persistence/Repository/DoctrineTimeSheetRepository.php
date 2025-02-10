<?php

namespace App\Infrastructure\Persistence\Repository;

use App\Domain\Entity\TimeSheet;
use App\Domain\Repository\TimeSheet\TimeSheetRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TimeSheet|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeSheet[]    findAll()
 * @method TimeSheet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method TimeSheet|null findOneBy(array $criteria, array $orderBy = null)
 */
class DoctrineTimeSheetRepository extends ServiceEntityRepository implements TimeSheetRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimeSheet::class);
    }

    public function save(TimeSheet $timeSheet, bool $newEntity): void
    {
        if ($newEntity) $this->getEntityManager()->persist($timeSheet);
        $this->getEntityManager()->flush();
    }

    public function delete(TimeSheet $timeSheet): void
    {
        $this->getEntityManager()->remove($timeSheet);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): ?TimeSheet
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function browse(): array
    {
        return $this->findAll();
    }
}
