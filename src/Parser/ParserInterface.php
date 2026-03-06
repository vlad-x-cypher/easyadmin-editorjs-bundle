<?php

namespace VladX\EasyadminEditorjsBundle\Parser;

use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\BlockParserInterface;

interface ParserInterface
{
    public function registerBlockTypeParser(string $type, BlockParserInterface $parser): self;
    public function parse(?array $editorData = []): string;
}
