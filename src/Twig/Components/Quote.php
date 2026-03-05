<?php

namespace VladX\EasyadminEditorjsBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'Quote')]
class Quote
{
    public string $text = "";
    public string $caption = "";
}
