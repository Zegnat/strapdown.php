<?php

namespace Zegnat\Strapdown;

interface ConverterInterface
{
    public function convert(string $string): string;
}
