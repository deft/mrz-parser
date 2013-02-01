<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Exception\UnsupportedDocumentException;

class ParserFactory
{
    /**
     * @param $mrzString
     * @return AbstractParser
     * @throws UnsupportedDocumentException
     */
    public function create($mrzString)
    {
        switch (strlen($mrzString)) {
            case 88: return new PassportParser();
            case 90: return new TravelDocumentType1Parser();
            default: throw new UnsupportedDocumentException("String length didn't match that of known document types");
        }
    }
}
