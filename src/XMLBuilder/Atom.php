<?php

namespace Soyaf518\XMLBuilder;

use DOMDocument;
use SimpleXMLElement;

/**
 * Class Atom
 * @package Soyaf518\XMLBuilder
 * @author  江小溅  <soyaf518@gmail.com>
 * @since  v1.0
 */
class Atom implements AtomInterface
{
    /**
     * @var array Feed of XML
     */
    protected $feeds = [];

    /**
     * Add feed XML
     * @param FeedInterface $feed
     * @return object $this
     */
    public function addFeed(FeedInterface $feed)
    {
        $this->feeds[] = $feed;
        return $this;
    }

    /**
     * Builder XML
     * @return string
     */
    public function builder()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><feed xmlns="http://www.w3.org/2005/Atom"></feed>', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

        foreach ($this->feeds as $feed) {
            $toDom = dom_import_simplexml($xml);
            $fromDom = dom_import_simplexml($feed->asXML());
            $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        }

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->appendChild($dom->importNode(dom_import_simplexml($xml->feed), true));
        $dom->formatOutput = true;
        return $dom->saveXML();
    }

    /**
     * Builder XML
     * @return string
     */
    public function __toString()
    {
        return $this->builder();
    }
}