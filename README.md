# mrz-parser

Library to parse machine readable zones (MRZ) of passports and travel documents

## Usage

Usage is straightforward:

```php
<?php

$mrz = "P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<L898902C<3UTO6908061F9406236ZE184226B<<<<<14";

// Parse string
$parser = new Deft\MrzParser\MrzParser();
$travelDocument = $parser->parseString($mrz);

// Use getters to access the parsed information
print $travelDocument->getDocumentNumber(); // Will print 'L898902C'

// Parse array of lines
$mrz = [
    "P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<",
    "L898902C<3UTO6908061F9406236ZE184226B<<<<<14"
];
$travelDocument = $parser->parseLines($mrz);
```