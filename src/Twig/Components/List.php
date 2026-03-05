<?php

namespace VladX\EasyadminEditorjsBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'List')]
class List
{
    public string $type = "unordered";
    public array $items = [];
}
