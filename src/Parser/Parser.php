<?php

namespace VladX\EasyadminEditorjsBundle\Parser;

use Symfony\Component\String\Slugger\SluggerInterface;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\BlockParserInterface;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\HeaderParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\ListParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\ParagraphParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\QuoteParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\TableParser;

class Parser
{
    /**
     * @var array<string,BlockParserInterface> $blockParsers
     */
    private array $blockParsers = [];

    public function __construct(
        private ?SluggerInterface $slugger = null
    ) {
    }

    public function registerBlockTypeParser(string $type, BlockParserInterface $parser): self
    {
        $this->blockParsers[$type] = $parser;
        return $this;
    }

    public function parse(?array $editorData = []): string
    {
        if (!$editorData || empty($editorData['blocks'])) {
            return '';
        }

        $out = "";
        foreach ($editorData['blocks'] as $block) {
            if (!empty($this->blockParsers[$block['type']])) {
                $out .= $this->blockParsers[$block['type']]->parse($block);
            }
        }

        return $out;
    }

    public static function createParserInstance(
        SluggerInterface $slugger = null
    ): Parser {
        $parser = new Parser($slugger);
        return $parser
            ->registerBlockTypeParser('paragraph', new ParagraphParser())
            ->registerBlockTypeParser('header', new HeaderParser($parser->getSlugger()))
            ->registerBlockTypeParser('list', new ListParser())
            ->registerBlockTypeParser('quote', new QuoteParser())
            ->registerBlockTypeParser('table', new TableParser())
        ;
    }

    public function getSlugger(): ?SluggerInterface
    {
        return $this->slugger;
    }
}
