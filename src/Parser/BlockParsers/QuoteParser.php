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
        return sprintf(
            "{%% set caption = %s %%}{%% set quoteText = %s %%}<twig:vxeb:Quote :text='quoteText[0]' :caption='caption[0]' />",
            json_encode([$block['data']['caption']], JSON_UNESCAPED_UNICODE),
            json_encode([$block['data']['text']], JSON_UNESCAPED_UNICODE),
        );
    }
}
