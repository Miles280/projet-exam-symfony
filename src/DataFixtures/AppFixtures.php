<?php

namespace App\DataFixtures;

use App\Entity\Power;
use App\Entity\Role;
use App\Entity\User;
use App\Enum\Camp;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        $rolesData = json_decode(file_get_contents(__DIR__ . '/roles.json'), true);

        foreach ($rolesData as $roleData) {
            $role = new Role();
            $role
                ->setName($roleData['name'])
                ->setDescription($roleData['description'])
                ->setCamp(Camp::from($roleData['camp']))
                ->setGoal($roleData['goal'])
                ->setMinPlayer($roleData['minPlayer']);

            $manager->persist($role);

            foreach ($roleData['powers'] as $powerData) {
                $power = new Power();
                $power
                    ->setTitle($powerData['title'])
                    ->setDescription($powerData['description'])
                    ->setPosition($powerData['position'])
                    ->setRole($role);

                $manager->persist($power);
            };
        }

        $regularUser = new User();
        $regularUser
            ->setUsername('Rionas')
            ->setPassword($this->hasher->hashPassword($regularUser, 'mdp'));

        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setUsername('Miles')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'mdp'));

        $manager->persist($adminUser);

        $manager->flush();
    }
}
