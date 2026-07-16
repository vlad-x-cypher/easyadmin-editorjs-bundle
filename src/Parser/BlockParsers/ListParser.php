<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;

class ListParser implements BlockParserInterface
{
    /**
     * @param array<string, array{type: string, data: array{items: string[], style: string}}> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'list') {
            throw new LogicException('invalid block type');
        }

        return sprintf(
            "{%% set listItems = %s %%}<twig:vxeb:List type=\"%s\" :items='listItems' />",
            json_encode($block['data']['items'], JSON_UNESCAPED_UNICODE),
            $block['data']['style'],
        );
    }
}
