<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskFilterType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('title', TextType::class, [
				'required' => false,
				'label' => 'Title',
			])
			->add('status', ChoiceType::class, [
				'required' => false,
				'choices' => [
					'Pending' => 'pending',
					'In Progress' => 'in progress',
					'Completed' => 'completed',
				],
				'placeholder' => 'All Statuses',
				'label' => 'Status',
			])
			->add('priority', ChoiceType::class, [
				'required' => false,
				'choices' => [
					'Low' => 1,
					'Medium' => 2,
					'High' => 3,
				],
				'placeholder' => 'All Priorities',
				'label' => 'Priority',
			]);
	}
}
