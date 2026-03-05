<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;
use Symfony\Component\String\Slugger\SluggerInterface;

class HeaderParser implements BlockParserInterface
{
    public function __construct(private ?SluggerInterface $slugger = null)
    {
    }
    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'header') {
            throw new LogicException('invalid block type');
        }
        $id = $block['id'];

        if ($this->slugger) {
            $id = $this->slugger->slug($block['data']['text']);
        }

        $text = str_replace('"', '&quot;', $block['data']['text']);

        return sprintf("<twig:vxeb:Header level=\"%d\" id=\"%s\" text=\"%s\" />", $block['data']['level'], $id, $text);
    }
}
