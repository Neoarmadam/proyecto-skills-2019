<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Begin a transaction
        $manager->getConnection()->beginTransaction();

        try {
            $user = new User();
            $user->setUsername("Mario");
            $hashedPassword = $this->userPasswordHasher->hashPassword($user, "mario");
            $user->setPassword($hashedPassword);
            $user->setRoles(array('ROLE_ADMIN'));
            $manager->persist($user);
            $manager->flush();

            // Commit the transaction
            $manager->getConnection()->commit();
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurred
            $manager->getConnection()->rollBack();
            throw $e;
        }
    }
}
