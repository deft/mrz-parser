<?php

namespace Deft\MrzParser;

interface MrzParserInterface
{
    /**
     * Parse a MRZ string, i.e. the lines of a document are concatenated
     *
     * @param $string
     * @return TravelDocumentInterface
     */
    public function parseString($string);

    /**
     * Parse an array of 2 (td1) or 3 (td2) MRZ lines of one document
     *
     * @param  string[]                $lines
     * @return TravelDocumentInterface
     */
    public function parseLines(array $lines);
}
