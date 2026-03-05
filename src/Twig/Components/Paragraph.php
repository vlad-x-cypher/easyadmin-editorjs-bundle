<?php

namespace VladX\EasyadminEditorjsBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'Paragraph')]
class Paragraph
{
    public string $text = "";
}
