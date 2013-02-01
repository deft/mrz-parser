<?php

namespace Deft\MrzParser;

class MrzParser implements MrzParserInterface
{

    /**
     * @var Parser\ParserFactory
     */
    protected $parserFactory;

    public function __construct()
    {
        $this->parserFactory = new Parser\ParserFactory();
    }

    /**
     * Parse a MRZ string, i.e. the lines of a document are concatenated
     *
     * @param $string
     * @return TravelDocumentInterface
     */
    public function parseString($string)
    {
        $parser = $this->parserFactory->create($string);

        return $parser->parse($string);
    }

    /**
     * Parse an array of MRZ lines of one document
     *
     * @param  string[]                $lines
     * @return TravelDocumentInterface
     */
    public function parseLines(array $lines)
    {
        return $this->parseString(implode('', $lines));
    }
}
