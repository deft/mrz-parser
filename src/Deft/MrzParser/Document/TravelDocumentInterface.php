<?php

namespace Deft\MrzParser\Document;

interface TravelDocumentInterface
{
    /**
     * The primary type of this document, one of the constants in TravelDocumentType.
     *
     * @return string
     */
    public function getType();

    /**
     * The number that identifies this document.
     *
     * @return string
     */
    public function getDocumentNumber();

    /**
     * The country that issued this travel document as 3-letter country code (ISO 3166-1 alpha-3).
     *
     * @return string
     */
    public function getIssuingCountry();

    /**
     * The date this document expires.
     *
     * @return \DateTime
     */
    public function getDateOfExpiry();

    /**
     * The primary identifier of the document holder, typically its surname or family name.
     *
     * @return string
     */
    public function getPrimaryIdentifier();

    /**
     * The secondary identifier of the document holder, commonly its given names.
     *
     * @return string
     */
    public function getSecondaryIdentifier();

    /**
     * The sex of the document holder, one of the constants in Gender.
     *
     * @return string
     */
    public function getSex();

    /**
     * The date of birth of the document holder.
     *
     * @return \DateTime
     */
    public function getDateOfBirth();

    /**
     * The nationality of the document holder as 3-letter country code (ISO 3166-1 alpha-3).
     *
     * @return string
     */
    public function getNationality();

    /**
     * The personal number that identifies the document holder in its state.
     *
     * @return strinmg
     */
    public function getPersonalNumber();
}
