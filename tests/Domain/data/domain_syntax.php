<?php declare(strict_types = 1);

return [
    'minLength' => 3,
    'maxLength' => 20,
    'idnSupport' => true,
    'allowedCharacters' => 'abcdefghijklmnopqrstuvwxyz',
    'languageCodes' => include __DIR__ . '/language_codes.php',
];
