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
     * @param array<string,array{type: string, data: array{text: string, level: int}}> $block
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


        return sprintf(
            "{%% set header = %s %%}<twig:vxeb:Header level=\"%d\" id=\"%s\" :text='header[0]'/>",
            json_encode([$block['data']['text']], JSON_UNESCAPED_UNICODE),
            $block['data']['level'],
            $id,
        );
    }
}
