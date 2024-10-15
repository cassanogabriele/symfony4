<?php
namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Utilisation de la librairie "faker"
        $faker = Factory::create('fr_FR');

        // Créer 3 catégories
        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                      ->setDescription($faker->paragraph());

            $manager->persist($category);

            // Créer entre 4 et 6 articles
            for ($j = 1; $j <= mt_rand(4, 6); $j++) {
                $article = new Article();

                $content = '<p>' . implode('</p><p>', $faker->paragraphs(5)) . '</p>';

                $article
                    ->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);

                // Persistez l'article
                $manager->persist($article);

                // Créer entre 4 et 10 commentaires pour chaque article
                for ($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $comment = new Comment();
                    $content = '<p>' . implode('</p><p>', $faker->paragraphs(2)) . '</p';

                    $now = new \DateTimeImmutable();
                    $articleCreatedAt = $article->getCreatedAt();
                    $interval = $now->diff($articleCreatedAt);
                    $minimum = '-' . $interval->days . ' days';
                    $createdAt = $faker->dateTimeBetween($minimum);
                    $createdAt = \DateTimeImmutable::createFromMutable($createdAt);

                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($createdAt)
                            ->setArticle($article);

                    // Persistez le commentaire
                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }

     // Création de 10 articles
        // for ($i = 1; $i <= 10; $i++) {
        //     $article = new Article();
        //     $article
        //         ->setTitle("Titre de l'article n° $i")
        //         ->setContent("<p>Contenu de l'article n° $i</p>")
        //         ->setImage("http://placehold.it/350x150")
        //         ->setCreatedAt(new \DateTime());

        //     // Créez une nouvelle catégorie pour chaque article
        //     $category = new Category();
        //     $category->setTitle("Catégorie $i")
        //         ->setDescription("Description de la catégorie $i");

        //     // Ajoutez l'article à la catégorie
        //     $category->addArticle($article);

        //     // Associez la catégorie à l'article
        //     $article->setCategory($category);

        //     // Persistez la catégorie
        //     $manager->persist($category);

        //     // Persistez l'article
        //     $manager->persist($article);
        // }

        // // Il faut utiliser "flush" pour exécuter réellement la requête SQL qui effectuera les opérations.
        // $manager->flush();
}

