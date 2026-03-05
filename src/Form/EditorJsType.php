<?php

namespace VladX\EasyadminEditorjsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class EditorJsType extends AbstractType implements DataTransformerInterface
{
    public function getParent(): string
    {
        return TextareaType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addViewTransformer($this);
    }

    public function reverseTransform(mixed $value): array
    {
        if ($value === null) {
            return [];
        }

        return json_decode($value, true);
    }

    public function transform(mixed $value): mixed
    {
        if (!\is_string($value)) {
            return json_encode($value);
        }

        if ('' === $value) {
            return null;
        }
    }


    public function getBlockPrefix(): string
    {
        return 'vlad_x_easyadmin_editorjs';
    }
}
