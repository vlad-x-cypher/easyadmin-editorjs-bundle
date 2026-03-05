<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;

class TableParser implements BlockParserInterface
{
    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'table') {
            throw new LogicException('invalid block type');
        }

        return sprintf("<twig:vxeb:Table :withHeadings=\"%s\" :items='%s' />", $block['data']['withHeadings'], json_encode($block['data']['content']));
    }
}
