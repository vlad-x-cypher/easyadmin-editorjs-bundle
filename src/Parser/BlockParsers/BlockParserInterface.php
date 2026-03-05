<?php

namespace VladX\EasyadminEditorjsBundle\Parser\BlockParsers;

interface BlockParserInterface
{
    /**
     * @param array<string,mixed> $block
     */
    public function parse(array $block): string;
}
