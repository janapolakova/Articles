<?php

namespace JPCoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ArticleForm
 *
 * @author Jana Polakova <jana.polakova@icloud.com>
 * @package JP\CoreBundle\Form
 */
class ArticleForm extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('title', 'text', [
            'label' => 'Title',
            'constraints' => [new NotBlank(), new Length(['max' => 150])],
            'required' => true,
        ]);

        $builder->add('content', 'textarea', [
            'label' => 'Content',
            'required' => false,
        ]);

        $builder->add('author', 'text', [
            'label' => 'Author',
            'constraints' => [new NotBlank(), new Length(['max' => 150])],
            'required' => true,
        ]);
    }

    /**
     * Configure options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(['data_class' => 'JPCoreBundle\Entity\Article']);
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(){
        return 'jpcorebundle_article';
    }
}