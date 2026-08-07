<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;

class ParagraphParser implements BlockParserInterface
{
    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'paragraph') {
            throw new LogicException('invalid block type');
        }

        return sprintf(
            "{%% set paragraph = %s %%}<twig:vxeb:Paragraph :text='paragraph[0]' />",
            json_encode([$block['data']['text']], JSON_UNESCAPED_UNICODE),
        );
    }
}
