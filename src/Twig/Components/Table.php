<?php

namespace VladX\EasyadminEditorjsBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'Table')]
class Table
{
    public bool $withHeadings = false;
    public array $items = [];
}
