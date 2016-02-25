<?php
namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepository
{
    /**
     * @param string $telNo
     * @return User
     */
    public function resolveByTelNo(string $telNo): User;
}