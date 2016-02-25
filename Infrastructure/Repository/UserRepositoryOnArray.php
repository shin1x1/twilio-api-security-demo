<?php
namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepositoryOnArray implements UserRepository
{
    /**
     * @param string $telNo
     * @return User
     */
    public function resolveByTelNo(string $telNo): User
    {
        if ($telNo == env('TWILIO_USER_TELNO1', '+819012345678')) {
            return new User(
                $telNo,
                '田中',
                100
            );
        }

        if ($telNo == env('TWILIO_USER_TELNO1', '+818012345678')) {
            return new User(
                $telNo,
                '鈴木',
                50
            );
        }

        throw new ModelNotFoundException();
    }
}