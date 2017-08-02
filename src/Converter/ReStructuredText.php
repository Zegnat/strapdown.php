<?php

declare(strict_types=1);

namespace Zegnat\Strapdown\Converter;

use Zegnat\Strapdown\ConverterInterface;

class ReStructuredText implements ConverterInterface
{
    public function convert(string $string): string
    {
        $rst = new \Gregwar\RST\Parser();
        return strval($rst->parse($string));
    }
}
