<?php

declare(strict_types=1);

namespace Zegnat\Strapdown;

class Map
{
    private $_map = [];

    public function __construct(array $map)
    {
        foreach ($map as $format => $converter) {
            $this->set($format, $converter);
        }
    }

    public function add(string $format, ConverterInterface $converter): self
    {
        $new = clone $this;
        $new->_set($format, $converter);
        return $new;
    }

    public function remove(string $format): self
    {
        $new = clone $this;
        $new->_unset($format);
        return $new;
    }

    public function converter(string $format): ConverterInterface
    {
        return $this->_map[$format];
    }

    private function _set(string $format, ConverterInterface $converter)
    {
        $this->_map[$format] = $converter;
    }

    private function _unset(string $format)
    {
        unset($this->_map[$format]);
    }    
}
