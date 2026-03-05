<?php

namespace VladX\EasyadminEditorjsBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'Header')]
class Header
{
    public string $text = "";
    public int $level = 2;
}
