<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;

class QuoteParser implements BlockParserInterface
{
    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'quote') {
            throw new LogicException('invalid block type');
        }

        return sprintf("<twig:vxeb:Quote text=\"%s\" caption=\"%s\" />", $block['data']['text'], $block['data']['caption']);
    }
}
