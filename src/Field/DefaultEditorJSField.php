<?php

namespace VladX\EasyadminEditorjsBundle\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Contracts\Translation\TranslatableInterface;

final class DefaultEditorJSField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, TranslatableInterface|string|bool|null $label = null): EditorJSField
    {
        return EditorJSField::new($propertyName, $label)
            ->addJsFiles(
                'https://cdn.jsdelivr.net/npm/@editorjs/header@2.8.8',
                'https://cdn.jsdelivr.net/npm/@editorjs/paragraph@2.11.7',
                'https://cdn.jsdelivr.net/npm/@editorjs/table@2.4.5',
                'https://cdn.jsdelivr.net/npm/@editorjs/inline-code@1.5.2',
                'https://cdn.jsdelivr.net/npm/@editorjs/list@2.0.9',
                'https://cdn.jsdelivr.net/npm/@editorjs/quote@2.7.6',
            )
            ->addTool('paragraph', ['class' => 'Paragraph'])
            ->addTool('inlineCode', ['class' => 'InlineCode'])
            ->addTool('table', [
                'class' => 'Table',
                'inlineToolbar' => true,
            ])
            ->addTool('quote', [
                'class' => 'Quote',
                'inlineToolbar' => true,
                'shortcut' => 'CMD+SHIFT+O',
                'config' => [
                    'quotePlaceholder' => 'Enter a quote',
                    'captionPlaceholder' => 'Quote\'s author',
                ],
            ])
            ->addTool('list', [
                'class' => 'EditorjsList',
                'inlineToolbar' => true,
                'config' => [
                    'defaultStyle' => 'unordered'
                  ]
            ])
            ->addTool('header', ['class' => 'Header']);
    }
}
