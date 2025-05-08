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
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
  
    public function load(ObjectManager $manager): void
    {   
        $rolesData = [
            [
                'name' => 'Reine des sorcières',
                'description' => 'La seule et unique Reine des sorcières.',
                'camp' => Camp::Sorciere,
                'goal' => 'Tuer tout le village.',
                'minPlayer' => 6,
                'powers' => [
                    [
                        'title' => 'I am the Queen !',
                        'description' => 'La Reine des sorcières choisit quelle Sorcière se déplace pour commettre le meurtre/rituel, et c’est également elle qui choisit s’il vaut mieux utiliser le meurtre ou le rituel.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'The Queen can’t die',
                        'description' => 'La Reine des sorcières est un être si puissant une fois le soleil couché qu’elle ne peut mourir que s’il fait jour.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Chatte noire',
                'description' => 'Porteuse de malchance, en un seul regard elle sera capable de vous affaiblir.',
                'camp' => Camp::Sorciere,
                'goal' => 'Tuer tout le village.',
                'minPlayer' => 8,
                'powers' => [
                    [
                        'title' => 'Mauvais présage',
                        'description' => 'La Chatte Noire cible un joueur et lui retire au hasard une charge de l’un de ses pouvoirs. Cette charge est restaurée à la mort de la Chatte Noire.',
                        'position' => 1,
                    ],
                ],
            ],
            [
                'name' => 'Gardienne des secrets',
                'description' => 'Une vieille femme aux savoirs immenses, mais qui les utilise à mauvais escient.',
                'camp' => Camp::Sorciere,
                'goal' => 'Tuer tout le village.',
                'minPlayer' => 8,
                'powers' => [
                    [
                        'title' => 'Chantage',
                        'description' => 'Chaque nuit, elle peut décider de faire chanter un joueur. La cible choisit entre révéler son rôle ou ne pas parler au prochain débat.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Chantage mortel',
                        'description' => 'Chantage spécial : si le joueur ne révèle pas son rôle, il meurt.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Braconnier',
                'description' => 'Un villageois qui garde son fidèle fusil à portée de main jusqu’à son dernier souffle.',
                'camp' => Camp::Villageois,
                'goal' => 'Sauver le village',
                'minPlayer' => 6,
                'powers' => [
                    [
                        'title' => 'Le dernier souffle',
                        'description' => 'Juste avant sa mort, il tue une personne de son choix.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Simple coïncidence',
                        'description' => 'Devine qui va mourir dans la nuit. En cas de succès, découvre son agresseur.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Diseuse de bonnes aventures',
                'description' => 'Une vieille femme qui cherche à guider le village vers la vérité.',
                'camp' => Camp::Villageois,
                'goal' => 'Sauver le village',
                'minPlayer' => 6,
                'powers' => [
                    [
                        'title' => 'Prédiction incertaine',
                        'description' => 'Chaque nuit, devine le rôle d’un joueur. Reçoit une liste de trois rôles dont l’un est le bon.',
                        'position' => 1,
                    ],
                ],
            ],
            [
                'name' => 'Occultiste',
                'description' => 'Un adorateur des arts mystiques qui protège le village.',
                'camp' => Camp::Villageois,
                'goal' => 'Sauver le village',
                'minPlayer' => 6,
                'powers' => [
                    [
                        'title' => 'Inversion des flux',
                        'description' => 'Inverse le flux de camp d’un joueur pour une nuit.',
                        'position' => 1,
                    ],
                ],
            ],
            [
                'name' => 'Baba la poule magique',
                'description' => 'Une poule antique dont nul ne connaît l’origine.',
                'camp' => Camp::Villageois,
                'goal' => 'Sauver le village',
                'minPlayer' => 8,
                'powers' => [
                    [
                        'title' => 'Célèbre bénédiction',
                        'description' => 'Bénit un joueur. Il devient invulnérable mais ne peut pas voter le jour suivant.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Célèbre malédiction',
                        'description' => 'Maudit un joueur. Il est bloqué mais obtient un vote double caché.',
                        'position' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Pendu',
                'description' => 'La mort ne veut pas de lui… alors il la partage.',
                'camp' => Camp::Independant,
                'goal' => 'Gagner si tout le monde est mort.',
                'minPlayer' => 9,
                'powers' => [
                    [
                        'title' => 'Volonté macabre',
                        'description' => 'Marque des joueurs. S’il meurt, tous les marqués meurent aussi.',
                        'position' => 1,
                    ],
                    [
                        'title' => 'Un blanc dans mon coeur',
                        'description' => 'Ajoute une marque à un joueur ayant voté blanc.',
                        'position' => 2,
                    ],
                    [
                        'title' => 'La paix n\'est pas une solution',
                        'description' => 'À chaque égalité, gagne un Token. Peut échanger des votes avec ces Tokens.',
                        'position' => 3,
                    ],
                    [
                        'title' => 'Choisir sa fin',
                        'description' => 'Le Pendu est immortel pour une nuit.',
                        'position' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Ombre sans visage',
                'description' => 'La personnification des cauchemars.',
                'camp' => Camp::Independant,
                'goal' => 'Gagner en étant le dernier joueur en vie.',
                'minPlayer' => 9,
                'powers' => [
                    [
                        'title' => 'Trouble mortel',
                        'description' => 'Choisit une cible. Si l’Ombre est visée cette nuit-là, la cible meurt.',
                        'position' => 1,                    
                    ],
                    [
                        'title' => 'Nuit éternelle',
                        'description' => 'Si tous les ennemis sont morts, tous les villageois doivent agir ou mourir.',
                        'position' => 2,
                    ],
                ],
            ],
        ];
        
        foreach ($rolesData as $roleData) {
            $role = new Role();
            $role
                ->setName($roleData['name'])
                ->setDescription($roleData['description'])
                ->setCamp($roleData['camp'])
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
