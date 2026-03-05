<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\String\Slugger\SluggerInterface;
use VladX\EasyadminEditorjsBundle\Twig\Components\Paragraph;
use VladX\EasyadminEditorjsBundle\Twig\Components\Header;
use VladX\EasyadminEditorjsBundle\Parser\Parser;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(Parser::class)
            ->factory([null, 'createParserInstance'])
            ->args([service(SluggerInterface::class)->nullOnInvalid()])

        ->set(Paragraph::class)
            ->tag('twig.component')

        ->set(Header::class)
            ->tag('twig.component')
    ;
};
