<?php

namespace Deft\MrzParser\Document;

class TravelDocument implements TravelDocumentInterface
{
    protected $type;
    protected $documentNumber;
    protected $issuingCountry;
    protected $dateOfExpiry;
    protected $primaryIdentifier;
    protected $secondaryIdentifier;
    protected $nationality;
    protected $dateOfBirth;
    protected $personalNumber;
    protected $sex;

    /**
     * @param $fields
     */
    public function __construct($fields)
    {
        foreach ($fields as $fieldName => $value) {
            $this->{$fieldName} = $value;
        }
    }

    /**
     * The primary type of this document, one of the constants in TravelDocumentType.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The number that identifies this document.
     *
     * @return string
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * The country that issued this travel document as 3-letter country code (ISO 3166-1 alpha-3).
     *
     * @return string
     */
    public function getIssuingCountry()
    {
        return $this->issuingCountry;
    }

    /**
     * The date this document expires.
     *
     * @return \DateTime
     */
    public function getDateOfExpiry()
    {
        return $this->dateOfExpiry;
    }

    /**
     * The primary identifier of the document holder, typically its surname or family name.
     *
     * @return string
     */
    public function getPrimaryIdentifier()
    {
        return $this->primaryIdentifier;
    }

    /**
     * The secondary identifier of the document holder, commonly its given names.
     *
     * @return string
     */
    public function getSecondaryIdentifier()
    {
        return $this->secondaryIdentifier;
    }

    /**
     * The sex of the document holder, one of the constants in Gender.
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * The date of birth of the document holder.
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * The nationality of the document holder as 3-letter country code (ISO 3166-1 alpha-3).
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * The personal number that identifies the document holder in its state.
     *
     * @return strinmg
     */
    public function getPersonalNumber()
    {
        return $this->personalNumber;
    }
}
