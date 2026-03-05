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

        $text = str_replace('"', '&quot;', $block['data']['text']);
        return sprintf("<twig:vxeb:Paragraph text='%s' />", $text);
    }
}
