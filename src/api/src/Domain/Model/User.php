<?php
/*
 * This file has been automatically generated by TDBM.
 * You can edit this file as it will not be overwritten.
 */

declare(strict_types=1);

namespace App\Domain\Model;

use App\Domain\Assert\Assert;
use App\Domain\Enum\RoleEnum;
use App\Domain\Model\Generated\BaseUser;
use TheCodingMachine\GraphQLite\Annotations\Type;
use function Safe\password_hash;
use const PASSWORD_DEFAULT;

/**
 * The User class maps the 'users' table in database.
 *
 * @Type
 */
class User extends BaseUser
{
    public function setFirstName(string $firstName) : void
    {
        Assert::that($firstName)
            ->notBlank()
            ->maxLength(255);

        parent::setFirstName($firstName);
    }

    public function setLastName(string $lastName) : void
    {
        Assert::that($lastName)
            ->notBlank()
            ->maxLength(255);

        parent::setLastName($lastName);
    }

    public function setEmail(string $email) : void
    {
        Assert::that($email)
            ->notBlank()
            ->maxLength(255)
            ->email();

        parent::setEmail($email);
    }

    public function setPassword(?string $password) : void
    {
        if ($password === null) {
            parent::setPassword($password);

            return;
        }

        Assert::that($password)
            ->notBlank()
            ->minLength(8);

        parent::setPassword(password_hash($password, PASSWORD_DEFAULT));
    }

    public function setRole(string $role) : void
    {
        Assert::that($role)
            ->choice(RoleEnum::values());

        parent::setRole($role);
    }
}
