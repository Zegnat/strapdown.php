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
            $fragment = $dom->createDocumentFragment();;
            if ($fragment->appendXML($text) === false) {
                // The converter output could not be imported as XML.
                // It may be HTML that does validate as well-formed XML.
                $importDom = new \DOMDocument();
                $id = 'importhtmlfragment';
                $importDom->loadHTML('<div id="' . $id . '">' . $text . '</div>');
                $importFragment = $importDom->getElementById($id);
                foreach ($importFragment->childNodes as $node) {
                    $node = $fragment->ownerDocument->importNode($node, true);
                    $fragment->appendChild($node);
                }
            }
            $element->parentNode->replaceChild($fragment, $element);
        }
        $return = $dom->saveHTML();
        if (extension_loaded('tidy')) {
            $tidy = new \Tidy();
            $tidy->parseString(
                $return,
                [
                    'indent' => 2, // 2 = 'auto'
                    'wrap' => 0, // 0 = no wrapping
                ]
            );
            $tidy->cleanRepair();
            $return = strval($tidy);
        }
        return $return;
    }
}
