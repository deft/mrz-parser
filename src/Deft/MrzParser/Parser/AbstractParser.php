<?php

namespace Deft\MrzParser\Parser;

use Deft\MrzParser\Exception\ParseException;

abstract class AbstractParser implements ParserInterface
{
    /**
     * @param $string
     * @param $start
     * @param $finish
     * @return string
     */
    protected function getToken($string, $start, $finish = null)
    {
        if (null === $finish) $finish = $start;
        $uncleanedToken = substr($string, ($start-1), ($finish - $start)+1);

        return trim(str_replace('<', ' ', $uncleanedToken));
    }

    protected function getDateToken($string, $start)
    {
        $dateToken = $this->getToken($string, $start, $start + 5);

        $centennialBorder = new \DateTime("+15 year");
        $dateToken = (substr($dateToken, 0, 2) > $centennialBorder->format('y') ? '19' : 20) . $dateToken;

        return \DateTime::createFromFormat('Ymd', $dateToken);
    }

    protected function getNames($string, $start, $finish)
    {
        $token = substr($string, ($start-1), ($finish - $start)+1);
        $nameParts = explode('<<', $token);
        if (count($nameParts) < 2) throw new ParseException("Names could not be parsed.");
        return array_slice(
            array_map(function ($str) { return $this->clean($str); }, $nameParts),
            0,
            2
        );
    }

    protected function clean($string)
    {
        return trim(str_replace('<', ' ', $string));
    }
}
