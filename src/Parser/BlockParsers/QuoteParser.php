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

        $text = str_replace('"', '&quot;', $block['data']['text']);
        $caption = str_replace('"', '&quot;', $block['data']['caption']);
        return sprintf("<twig:vxeb:Quote text=\"%s\" caption=\"%s\" />", $text, $caption);
    }
}
