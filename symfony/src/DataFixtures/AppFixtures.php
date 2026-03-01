<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Document;
use App\Entity\Flan;
use App\Entity\Spot;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $user1 = $manager->getRepository(User::class)->find(1);
        $user2 = $manager->getRepository(User::class)->find(2);

        $users = [];
        if ($user1) $users[] = $user1;
        if ($user2) $users[] = $user2;

        if (empty($users)) {
            throw new \Exception("ERREUR : Les utilisateurs 1 et 2 n'ont pas été trouvés. As-tu oublié l'option --append ?");
        }

        $frenchCities = [
            ['name' => 'Paris', 'image' => 'paris.jpg'],
            ['name' => 'Lyon', 'image' => 'lyon.jpg'],
            ['name' => 'Marseille', 'image' => 'marseille.jpg'],
            ['name' => 'Bordeaux', 'image' => 'bordeaux.jpg'],
            ['name' => 'Lille', 'image' => 'lille.jpg'],
            ['name' => 'Strasbourg', 'image' => 'strasbourg.jpg'],
            ['name' => 'Toulouse', 'image' => 'toulouse.jpg'],
            ['name' => 'Nantes', 'image' => 'nantes.jpg'],
        ];

        $cities = [];
        foreach ($frenchCities as $cityData) {
            $cityDocument = new Document();
            $cityDocument->setName('Photo de ' . $cityData['name']);
            $cityDocument->setPath($cityData['image']); // Le nom du fichier physique
            $cityDocument->setType('image/jpeg');
            $cityDocument->setSize($faker->numberBetween(100000, 3000000));
            $cityDocument->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($cityDocument);

            $city = new City();
            $city->setName($cityData['name']);
            $city->setSlug($faker->slug(2, false) . '-' . strtolower($cityData['name']));
            $city->setPhoto($cityDocument); // La magie opère ici !

            $manager->persist($city);
            $cities[] = $city;
        }

        $documents = [];
        for ($i = 0; $i < 20; $i++) {
            $document = new Document();
            $document->setName('Image Test ' . $i);
            $document->setPath('dummy.jpg'); // N'oublie pas de mettre dummy.jpg dans public/uploads/documents/
            $document->setType('image/jpeg');
            $document->setSize($faker->numberBetween(100000, 5000000));
            $document->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeThisYear()));

            $manager->persist($document);
            $documents[] = $document;
        }

        $spots = [];
        for ($i = 0; $i < 15; $i++) {
            $spot = new Spot();
            $spot->setName($faker->company());
            $spot->setBio($faker->realText(200));
            $spot->setAddress($faker->streetAddress());
            $spot->setPostalCode(str_replace(' ', '', $faker->postcode()));
            $spot->setWebsite($faker->url());
            $spot->setLatitude((string)$faker->latitude(42, 51));
            $spot->setLongitude((string)$faker->longitude(-4, 8));
            $spot->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeThisYear()));
            $spot->setIsActive(true);
            $spot->setUser($faker->randomElement($users));
            $spot->setCity($faker->randomElement($cities));
            $spot->addDocument($faker->randomElement($documents));

            $manager->persist($spot);
            $spots[] = $spot;
        }

        $categories = ['nouveau', 'coups de coeurs', 'Top 50'];

        for ($i = 0; $i < 30; $i++) {
            $flan = new Flan();
            $flan->setName('Flan ' . $faker->randomElement(['Vanille', 'Pistache', 'Chocolat', 'Praliné', 'Marbré', 'Coco']));
            $flan->setCategory($faker->randomElements($categories, $faker->numberBetween(1, 3)));
            $flan->setBio($faker->realText(250));
            $flan->setStatus('Publié');
            $flan->setPrice($faker->randomFloat(2, 2.5, 8.0));
            $flan->setAvgScore((string)$faker->randomFloat(1, 1, 5));
            $flan->setReviewsCount($faker->numberBetween(0, 150));
            $flan->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeThisYear()));
            $flan->setIsActive(true);

            $flan->setUserId($faker->randomElement($users));
            $flan->setSpot($faker->randomElement($spots));
            $flan->addDocument($faker->randomElement($documents));

            $manager->persist($flan);
        }

        $manager->flush();
    }
}
