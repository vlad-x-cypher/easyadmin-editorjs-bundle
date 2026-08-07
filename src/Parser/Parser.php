<?php

namespace VladX\EasyadminEditorjsBundle\Parser;

use Symfony\Component\String\Slugger\SluggerInterface;
use Twig\Environment;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\BlockParserInterface;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\DetailsParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\HeaderParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\ListParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\ParagraphParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\QuoteParser;
use VladX\EasyadminEditorjsBundle\Parser\BlockParsers\TableParser;
use League\HTMLToMarkdown\HtmlConverter;
use League\HTMLToMarkdown\Converter\TableConverter;

class Parser implements ParserInterface
{
    /**
     * @var array<string,BlockParserInterface> $blockParsers
     */
    private array $blockParsers = [];

    public function __construct(
        private Environment $twigEnv,
        private ?SluggerInterface $slugger = null,
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
        Environment $twigEnv,
        SluggerInterface $slugger = null,
    ): Parser {
        $parser = new Parser($twigEnv, $slugger);
        return $parser
            ->registerBlockTypeParser('paragraph', new ParagraphParser())
            ->registerBlockTypeParser('header', new HeaderParser($parser->getSlugger()))
            ->registerBlockTypeParser('list', new ListParser())
            ->registerBlockTypeParser('quote', new QuoteParser())
            ->registerBlockTypeParser('table', new TableParser())
            ->registerBlockTypeParser('table', new TableParser())
            ->registerBlockTypeParser('details', new DetailsParser($parser))
        ;
    }

    public function getSlugger(): ?SluggerInterface
    {
        return $this->slugger;
    }

    public function toMd(?array $editorData = []): string
    {
        $converter = new HtmlConverter([
            'header_style' => 'atx',
        ]);
        $converter->getEnvironment()->addConverter(new TableConverter());
        return $converter->convert($this->twigEnv->render($this->twigEnv->createTemplate($this->parse($editorData))));
    }
}
