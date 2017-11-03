<?php

namespace AppBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use AppBundle\Form\TagType;

class ArticleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        // $em = $this->getDoctrine()->getManager();
        // $tags = $em->getRepository("AppBundle:Tag")->findAll();
        // $choices = [];
        // foreach ($tags as $tag) {
        //     $choices[$tags->getName()] = $tag;
        // }
        $builder
            ->add("Title", TextType::class, [
                "label" => "Title"
            ])
            ->add("Content", TextareaType::class, [
                "label" => "Content"
            ])
            ->add("Tags", EntityType::class, array(
                "class" => "AppBundle:Tag",
                "choice_label" => "name",
                "multiple" => true,
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            "data_class" => "AppBundle\Entity\Article",
        ]);
    }
}
