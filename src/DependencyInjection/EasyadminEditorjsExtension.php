<?php

namespace VladX\EasyadminEditorjsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EasyadminEditorjsExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader(
            $container,
            new FileLocator(\dirname(__DIR__) . '/../config')
        );
        $loader->load('services.php');
    }

    public function prepend(ContainerBuilder $builder): void
    {
        $builder->prependExtensionConfig('twig_component', [
            'defaults' => [
                'VladX\\EasyadminEditorjsBundle\\Twig\\Components\\' => [
                    'template_directory' => '@EasyadminEditorjs/components/',
                    'name_prefix' => 'vxeb',
                ],
            ],
        ]);

        /** @var string $projectDir */
        $projectDir = $builder->getParameter('kernel.project_dir');

        $bundleTemplatesOverrideDir = $projectDir.'/templates/bundles/EasyadminEditorjsBundle/';
        $bundleTemplatesPath = \dirname(__DIR__).'/../templates/';
        $builder->prependExtensionConfig('twig', [
            'paths' => is_dir($bundleTemplatesOverrideDir)
                ? [
                    'templates/bundles/EasyadminEditorjsBundle/' => 'vxeb',
                    $bundleTemplatesPath => 'vxeb',
                ]
                : [
                    $bundleTemplatesPath => 'vxeb',
                ],
        ]);
    }
}
