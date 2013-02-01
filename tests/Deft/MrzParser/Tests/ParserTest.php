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

        $this->assertEquals(TravelDocumentType::PASSPORT, $document->getType());
        $this->assertEquals('UTO', $document->getIssuingCountry());
        $this->assertEquals('ERIKSSON', $document->getPrimaryIdentifier());
        $this->assertEquals('ANNA MARIA', $document->getSecondaryIdentifier());
        $this->assertEquals('UTO', $document->getNationality());
        $this->assertInstanceOf('DateTime', $document->getDateOfBirth());
        $this->assertEquals('06-08-1969', $document->getDateOfBirth()->format('d-m-Y'));
        $this->assertEquals('L898902C', $document->getDocumentNumber());
        $this->assertEquals(Sex::FEMALE, $document->getSex());
        $this->assertEquals('ZE184226B', $document->getPersonalNumber());
    }

    public function testParse_idcardArray()
    {
        $mrzString = [
            "I<UTOIU4FC08Q12219340341<<<<<6",
            "9306037M1603165UTO<<<<<<<<<<<3",
            "DOE<<JOHN<<<<<<<<<<<<<<<<<<<<<"
        ];

        $document = $this->parser->parseLines($mrzString);

        $this->assertEquals(TravelDocumentType::ID_CARD, $document->getType());
        $this->assertEquals('UTO', $document->getIssuingCountry());
        $this->assertEquals('DOE', $document->getPrimaryIdentifier());
        $this->assertEquals('JOHN', $document->getSecondaryIdentifier());
        $this->assertEquals('219340341', $document->getPersonalNumber());
    }
}
