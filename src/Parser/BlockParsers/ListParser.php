<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;

class ListParser implements BlockParserInterface
{
    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'list') {
            throw new LogicException('invalid block type');
        }

        return sprintf(
            "<twig:vxeb:List type=\"%s\" :items='%s' />",
            $block['data']['style'],
            json_encode($block['data']['items'])
        );
    }
}
