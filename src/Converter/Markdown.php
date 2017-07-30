<?php

declare(strict_types=1);

namespace Zegnat\Strapdown\Converter;

use Zegnat\Strapdown\ConverterInterface;

class Markdown implements ConverterInterface
{
    public function convert(string $string): string
    {
        $parsedown = new \Parsedown();
        return $parsedown->text($string);
    }
}
