<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Exception\UnsupportedDocumentException;

class ParserFactory
{
    /**
     * @param $string
     * @return AbstractP
     * @throws \Deft\MrzParser\Exception\UnsupportedDocumentException
     */
    public function create($string)
    {
        switch (strlen($string)) {
            case 88: return new PassportParser();
            case 90: return new TravelDocumentType1Parser();
            default: throw new UnsupportedDocumentException("String length didn't match that of known document types");
        }
    }
}
