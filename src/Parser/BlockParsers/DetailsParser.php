<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

use Symfony\Component\Routing\Exception\LogicException;
use VladX\EasyadminEditorjsBundle\Parser\ParserInterface;

class DetailsParser implements BlockParserInterface
{
    public function __construct(private readonly ParserInterface $parentParser)
    {
    }

    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string
    {
        if ($block['type'] != 'details') {
            throw new LogicException('invalid block type');
        }

        $summary = json_encode([$block['data']['summary']], JSON_UNESCAPED_UNICODE);
        return sprintf("{%% set blockSummary = %s %%}<twig:vxeb:Details :summary='blockSummary[0]'>%s</twig:vxeb:Details>", $summary, $this->getParentParser()->parse($block['data']['data']));
    }

    public function getParentParser(): ParserInterface
    {
        return $this->parentParser;
    }
}
