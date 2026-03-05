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

        $items = json_encode($block['data']['content']);
        return sprintf("{%% set tableItems = %s %%}<twig:vxeb:Table :withHeadings=\"%s\" :items=\"tableItems\" />", $items, $block['data']['withHeadings'] ? 'true' : 'false');
    }
}
