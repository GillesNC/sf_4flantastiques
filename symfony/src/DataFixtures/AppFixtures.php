<?php
namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Flan;
use App\Entity\Spot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $slugger = new AsciiSlugger();

        $citiesData = ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Lille'];
        $cities = [];

        foreach ($citiesData as $cityName) {
            $city = new City();
            $city->setName($cityName)
                ->setSlug(strtolower($slugger->slug($cityName)));

            $manager->persist($city);
            $cities[] = $city;
        }

        $spots = [];
        for ($i = 0; $i < 15; $i++) {
            $spot = new Spot();
            $spot->setName($faker->company() . ' Boulangerie')
                ->setBio($faker->realText(200))
                ->setAddress($faker->streetAddress())
                ->setPostalCode(str_replace(' ', '', $faker->postcode()))
                ->setLatitude((string) $faker->latitude(43, 50))
                ->setLongitude((string) $faker->longitude(-1, 7))
                ->setWebsite($faker->url())
                ->setIsActive(true)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now')))
                ->setCity($faker->randomElement($cities));

            $manager->persist($spot);
            $spots[] = $spot;
        }

        $categories = ['Traditionnel', 'Praliné', 'Chocolat', 'Pistache', 'Coco'];
        $statusList = ['draft', 'review', 'published'];

        for ($i = 0; $i < 30; $i++) {
            $flan = new Flan();
            $flan->setName('Flan ' . $faker->randomElement($categories))
                ->setCategory($faker->randomElement($categories))
                ->setBio($faker->realText(250))
                ->setStatus($faker->randomElement($statusList))
                ->setAvgScore((string) $faker->randomFloat(1, 2, 5))
                ->setReviewsCount($faker->numberBetween(0, 50))
                ->setPrice($faker->randomFloat(2, 2, 8))
                ->setIsActive(true)
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months', 'now')));

            $manager->persist($flan);
        }

        $manager->flush();
    }
}
