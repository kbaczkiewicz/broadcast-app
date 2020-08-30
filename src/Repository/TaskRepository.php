<?php


namespace Broadcast\Repository;


use Broadcast\Action\Request\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class TaskRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Task::class));
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Task
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?Task
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function findForBoard(string $boardId): array
    {
        $qb = $this->createQueryBuilder('t');

        return $qb
            ->join('Board', 'b')
            ->where('b.id = :boardId')
            ->setParameter('boardId', $boardId)
            ->getQuery()->getResult();
    }
}
