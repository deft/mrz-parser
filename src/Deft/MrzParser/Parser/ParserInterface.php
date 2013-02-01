<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Exception\ParseException;
use Deft\MrzParser\TravelDocumentInterface;

interface ParserInterface
{
    /**
     * Extracts all the information from a MRZ string and returns a populated instance of TravelDocumentInterface
     *
     * @param $string
     * @return TravelDocumentInterface
     * @throws ParseException
     */
    public function parse($string);
}
