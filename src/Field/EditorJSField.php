<?php

namespace VladX\EasyadminEditorjsBundle\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use Symfony\Contracts\Translation\TranslatableInterface;
use VladX\EasyadminEditorjsBundle\Form\EditorJsType;

final class EditorJSField implements FieldInterface
{
    use FieldTrait;

    public const TOOLS_CONFIG_NAME = 'editorjsTools';

    public static function new(string $propertyName, TranslatableInterface|string|bool|null $label = null): self
    {
        return (new self())
            ->setLabel($label)
            ->addJsFiles(
                'https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.31.4',
                '/bundles/easyadmineditorjs/easyadmin-editorjs-field.js',
            )
            ->addCssFiles(
                '/bundles/easyadmineditorjs/easyadmin-editorjs-styles.css',
            )
            ->addFormTheme('@EasyadminEditorjs/form_theme/form-theme.html.twig')
            ->setFormType(EditorJsType::class)
            ->setRequired(false)
            ->setCustomOption(self::TOOLS_CONFIG_NAME, [])
            ->setProperty($propertyName);
    }

    public function registeredTools(): array
    {
        return $this->dto->getCustomOption(self::TOOLS_CONFIG_NAME) ?? [];
    }

    /**
     * @param array<int,mixed> $toolConfig
     */
    public function addTool(string $name, array $toolConfig): self
    {
        $toolsConfig = $this->registeredTools();

        $toolsConfig[$name] = $toolConfig;

        $this->setCustomOption(self::TOOLS_CONFIG_NAME, $toolsConfig);
        return $this;
    }

    public function removeTool(string $name): self
    {
        if (!empty($this->registeredTools()[$name])) {
            unset($this->registeredTools()[$name]);
        }

        return $this;
    }

}
