<?php

namespace Deft\MrzParser\Tests;

use Deft\MrzParser\MrzParser;
use Deft\MrzParser\MrzParserInterface;
use Deft\MrzParser\Document\Sex;
use Deft\MrzParser\Document\TravelDocumentType;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MrzParserInterface
     */
    protected $parser;

    public function setUp()
    {
        $this->parser = new MrzParser();
    }

    public function testParse_passportString()
    {
        $mrzString = "P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<L898902C<3UTO6908061F9406236ZE184226B<<<<<14";

        $document = $this->parser->parseString($mrzString);
        $fields = [
            'type' => TravelDocumentType::PASSPORT,
            'number' => 'L898902C',
            'issuingCountry' => 'UTO',
            'dateOfExpiry' => '23-06-1994',
            'primaryIdentifier' => 'ERIKSSON',
            'secondaryIdentifier' => 'ANNA MARIA',
            'sex' => Sex::FEMALE,
            'dateOfBirth' => '06-08-1969',
            'nationality' => 'UTO',
            'personalNumber' => 'ZE184226B'
        ];
        $this->assertValidDocument($document, $fields);
    }

    public function testParse_idcardArray()
    {
        $mrzString = [
            "I<UTOIU4FC08Q12219340341<<<<<6",
            "9306037M1603165UTO<<<<<<<<<<<3",
            "DOE<<JOHN<<<<<<<<<<<<<<<<<<<<<"
        ];

        $document = $this->parser->parseLines($mrzString);
        $fields = [
            'type' => TravelDocumentType::ID_CARD,
            'number' => 'IU4FC08Q1',
            'issuingCountry' => 'UTO',
            'dateOfExpiry' => '16-03-2016',
            'primaryIdentifier' => 'DOE',
            'secondaryIdentifier' => 'JOHN',
            'sex' => Sex::MALE,
            'dateOfBirth' => '03-06-1993',
            'nationality' => 'UTO',
            'personalNumber' => '219340341'
        ];
        $this->assertValidDocument($document, $fields);
    }

    protected function assertValidDocument($document, $fields)
    {
        $this->assertEquals($fields['type'], $document->getType(), "Incorrect document type");
        $this->assertEquals($fields['number'], $document->getDocumentNumber(), "Incorrect document number");
        $this->assertEquals($fields['issuingCountry'], $document->getIssuingCountry(), "Incorrect issuing country");
        $this->assertInstanceOf('DateTime', $document->getDateOfExpiry(), "Date of expiry is not a DateTime");
        $this->assertEquals($fields['dateOfExpiry'], $document->getDateOfExpiry()->format('d-m-Y'), "Invalid date of expiry");
        $this->assertEquals($fields['primaryIdentifier'], $document->getPrimaryIdentifier(), "Invalid primary identifier");
        $this->assertEquals($fields['secondaryIdentifier'], $document->getSecondaryIdentifier(), "Invalid secondary identifier");
        $this->assertEquals($fields['sex'], $document->getSex(), "Invalid sex");
        $this->assertInstanceOf('DateTime', $document->getDateOfBirth(), "Date of birth is not a DateTime");
        $this->assertEquals($fields['dateOfBirth'], $document->getDateOfBirth()->format('d-m-Y'), "Invalid date of birth");
        $this->assertEquals($fields['nationality'], $document->getNationality(), "Invalid nationality");
        $this->assertEquals($fields['personalNumber'], $document->getPersonalNumber(), "Invalid personal number");
    }
}
