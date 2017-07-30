<?php

declare(strict_types=1);

namespace Zegnat\Strapdown;

class Strapdown
{
    private $_map = null;

    public function __construct(Map $map)
    {
        $this->_map = $map;
    }

    public function strapString(string $string)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($string);
        $xpath = new \DOMXpath($dom);
        $elements = $xpath->query('//xmp[@data-language and not(ancestor::xmp)]');
        foreach ($elements as $element) {
            $language = $element->getAttribute('data-language');
            $text = '';
            foreach ($element->childNodes as $child) {
                $text .= $dom->saveXML($child);
            }
            $text = $this->_map->converter($language)->convert($text);
            $fragment = $dom->createDocumentFragment();
            $fragment->appendXML($text);
            $element->parentNode->replaceChild($fragment, $element);
        }
        return $dom->saveHTML();
    }
}
