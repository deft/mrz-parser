<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Exception\ParseException;
use Deft\MrzParser\Document\TravelDocument;
use Deft\MrzParser\Document\TravelDocumentInterface;
use Deft\MrzParser\Document\TravelDocumentType;

/**
 * Parser of Passport MRZ strings. The machine readable zone on a passport has
 * 2 lines, each consisting of 44 characters. Below a reference to the format:
 *   01 - 02: Document code
 *   03 - 05: Issuing state or organisation
 *   06 - 44: Names
 *   45 - 53: Document number
 *   54 - 54: Check digit
 *   55 - 57: Nationality
 *   58 - 63: Date of birth
 *   64 - 64: Check digit
 *   65 - 65: Sex
 *   66 - 71: Date of expiry
 *   72 - 72: Check digit
 *   73 - 86: Personal number
 *   87 - 87: Check digit
 *   88 - 88: Check digit
 *
 * @package Deft\MrzParser
 */
class PassportParser extends AbstractParser
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
        if ($this->getToken($string, 1) != 'P') {
            throw new ParseException("First character is not 'P'");
        }

        $fields = [
            'type' => TravelDocumentType::PASSPORT,
            'issuingCountry' => $this->getToken($string, 3, 5),
            'documentNumber' => $this->getToken($string, 45, 53),
            'nationality' => $this->getToken($string, 55, 57),
            'dateOfBirth' => $this->getDateToken($string, 58),
            'sex' => $this->getToken($string, 65),
            'dateOfExpiry' => $this->getDateToken($string, 66),
            'personalNumber' => $this->getToken($string, 73, 86)
        ];

        $names = $this->getNames($string, 6, 44);
        $fields['primaryIdentifier'] = $names[0];
        $fields['secondaryIdentifier'] = $names[1];

        return new TravelDocument($fields);
    }
}
