<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; // Use Textarea for longer descriptions
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true, // Required field
            ])
            ->add('description', TextareaType::class, [
                'required' => true, // Required field
            ])
            ->add('dueDate', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => false, // Optional field
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => [
                    'Low' => 1,
                    'Medium' => 2,
                    'High' => 3,
                ],
                'data' => 1, // Default priority
                'required' => false, // Optional field
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Pending' => 'pending',
                    'In Progress' => 'in progress',
                    'Completed' => 'completed',
                ],
                'data' => 'pending', // Default status
                'required' => true, // Required field
            ])
            ->add('assignedTo', TextType::class, [
                'required' => true, // Required field
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class, // Map to Task entity
        ]);
    }
}
