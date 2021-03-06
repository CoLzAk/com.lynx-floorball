<?php

namespace Colzak\EventBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends DocumentRepository
{
    public function getNextGame() {
        return $this->createQueryBuilder('Game')
            ->select('id', 'date', 'opponent', 'place', 'inHome')
            ->where("function() { return this.date >= new Date(); }")
            ->sort('date', 'asc')
            ->getQuery()
            ->getSingleResult();
    }
}