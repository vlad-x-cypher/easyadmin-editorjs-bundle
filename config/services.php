<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\String\Slugger\SluggerInterface;
use Twig\Environment;
use VladX\EasyadminEditorjsBundle\Parser\ParserInterface;
use VladX\EasyadminEditorjsBundle\Parser\Parser;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(ParserInterface::class)
            ->factory([Parser::class, 'createParserInstance'])
            ->args([service(Environment::class), service(SluggerInterface::class)->nullOnInvalid()])
    ;
};
