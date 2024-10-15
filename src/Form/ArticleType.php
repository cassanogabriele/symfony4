<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ArticleType extends AbstractType
{
//    /* public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('title')
//             // Il faut préciser ce champ

//             /*
//             On va utiliser classe "EntitType" des formulaires de Symfony, qui permet de créer 
//             des select, radio button, etc, permettant de présenter des objets qui sont dans la base 
//             de données.
//             */
//             ->add('category', EntityType::class, [
//                 // Il faut donner un tableau d'option, dire de quel entité on parle, "class"
//                 'class' => Category::class, 
//                 // Ce que le champ doit présenter 
//                 'choice_label' => 'title'
//             ])
//             ->add('content')
//             ->add('image')
//         ;
//     }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                //                 // Il faut donner un tableau d'option, dire de quel entité on parle, "class"
                'class' => Category::class, 
                    // Ce que le champ doit présenter 
                    'choice_label' => 'title'
                ])
            ->add('content')
            ->add('image')
            ->add('id', HiddenType::class, [
                'mapped' => false, // Ne pas mapper ce champ à l'entité Article
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
