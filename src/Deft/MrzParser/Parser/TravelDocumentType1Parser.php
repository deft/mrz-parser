<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Document\TravelDocument;
use Deft\MrzParser\Document\TravelDocumentInterface;
use Deft\MrzParser\Document\TravelDocumentType;
use Deft\MrzParser\Exception\ParseException;

/**
 * Parser of "travel document type 1" (td1) documents. Below a reference to the format:
 *
 *   01 - 02: Document code
 *   03 - 05: Issuing state or organization
 *   06 - 14: Document number
 *   15 - 15: Check digit
 *   16 - 30: Optional data (personal number); 30 normally being check digit
 *   31 - 36: Date of birth
 *   37 - 37: Check digit of 31-36
 *   38 - 38: Sex
 *   39 - 44: Date of expiry
 *   45 - 45: Check digit
 *   46 - 48: Nationality
 *   49 - 59: Optional data
 *   60 - 60: Check digit over 01 - 59
 *   61 - 90: Name
 *
 *
 * @package Deft\MrzParser\Parser
 */
class TravelDocumentType1Parser extends AbstractParser
{
    /**
     * Extracts all the information from a MRZ string and returns a populated instance of TravelDocumentInterface
     *
     * @param $string
     * @return TravelDocumentInterface
     * @throws ParseException
     */
    public function parse($string)
    {
        if (!in_array($this->getToken($string, 1), ['I', 'A', 'C'])) {
            throw new ParseException("First character is not 'I', 'A', or 'C'");
        }

        $fields = [
            'type' => TravelDocumentType::ID_CARD,
            'issuingCountry' => $this->getToken($string, 3, 5),
            'documentNumber' => $this->getToken($string, 6, 14),
            'personalNumber' => $this->getToken($string, 16, 29),
            'dateOfBirth' => $this->getDateToken($string, 31),
            'sex' => $this->getToken($string, 38),
            'dateOfExpiry' => $this->getDateToken($string, 39),
            'nationality' => $this->getToken($string, 46, 48)
        ];

        $names = $this->getNames($string, 61, 90);
        $fields['primaryIdentifier'] = $names[0];
        $fields['secondaryIdentifier'] = $names[1];

        return new TravelDocument($fields);
    }
}
