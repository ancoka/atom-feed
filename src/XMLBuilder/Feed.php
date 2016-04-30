<?php

namespace Soyaf518\XMLBuilder;

use SimpleXMLElement;
/**
 * Interface EntryInterface
 * @package Soyaf518\XMLBuilder
 * @author  江小溅  <soyaf518@gmail.com>
 * @since  v1.0
 */
class Feed implements FeedInterface
{
    /**
     * @var string ID of the feed
     */
    protected $id;

    /**
     * @var string Title of the feed
     */
    protected $title;

    /**
     * @var string Subtitle of the feed
     */
    protected $subtitle;

    /**
     * @var string Categories of the feed
     */
    protected $categories = [];

    /**
     * @var string Links of the feed
     */
    protected $links = [];

    /**
     * @var string Author of the feed
     */
    protected $author;

    /**
     * @var string Contributor of the feed
     */
    protected $contributor;

    /**
     * @var string Generator of the feed
     */
    protected $generator;

    /**
     * @var string Icon of the feed
     */
    protected $icon;

    /**
     * @var string Logo of the feed
     */
    protected $logo;

    /**
     * @var string Rights of the feed
     */
    protected $rights;

    /**
     * @var string Updated of the feed
     */
    protected $updated;

    /**
     * @var string Entrys of the feed
     */
    protected $entrys = []; 

    public function id($id)
    {
        $this->id = $id;
        return $this;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function subtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function category($category)
    {
        $this->categories[] = $category;
        return $this;
    }

    public function link($link)
    {
        $this->links[] = $link;
        return $this;
    }

    public function author($author)
    {
        $this->author = $author;
        return $this;
    }

    public function contributor($contributor)
    {
        $this->contributor = $contributor;
        return $this;
    }

    public function generator($generator)
    {
        $this->generator = $generator;
        return $this;
    }

    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function logo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    public function rights($rights)
    {
        $this->rights = $rights;
        return $this;
    }

    public function updated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    public function addEntry(EntryInterface $entry)
    {
        $this->entrys[] = $entry;
        return $this;
    }

    public function appendTo(AtomInterface $atom)
    {
        $atom->addFeed($this);
        return $this;
    }

    public function asXML()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><feed xmlns="http://www.w3.org/2005/Atom"></feed>', LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

        if ($this->title !== null) {
            $xml->addChild('title', $this->title);
        }

        if ($this->subtitle !== null) {
            $xml->addChild('subtitle', $this->subtitle);
        }

        foreach ($this->links as $link) {
            $element = $xml->addChild('link');
            if (!isset($link['href'])) {
                throw new \Exception("The href attribute of link is required.");
            } else {
                $element->addAttribute('href', $link['href']);
            }
            if (isset($link['rel'])) {
                $element->addAttribute('rel', $link['rel']);
            }
            if (isset($link['hreflang'])) {
                $element->addAttribute('hreflang', $link['hreflang']);
            }
            if (isset($link['title'])) {
                $element->addAttribute('title', $link['title']);
            }
            if (isset($link['length'])) {
                $element->addAttribute('length', $link['length']);
            }
        }

        if ($this->id !== null) {
            $xml->addChild('id', $this->id);
        }

        foreach ($this->categories as $category) {
            $element = $xml->addChild('category');

            if (!isset($category['term'])) {
                throw new \Exception("The term attribute of category is required.");
            } else {
                $element->addAttribute('term', $category['term']);
            }

            if (isset($category['scheme'])) {
                $element->addAttribute('scheme', $category['scheme']);
            }

            if (isset($category['label'])) {
                $element->addAttribute('label', $category['label']);
            }
        }

        if (!empty($this->author)) {
            $element = $xml->addChild('author');
            if (!isset($this->author['name'])) {
                throw new \Exception("The name attribute of category is required.");
            } else {
                $element->addChild('name', $this->author['name']);
            }
            if (isset($this->author['email'])) {
                $element->addChild('email', $this->author['email']);
            }
            if (isset($this->author['uri'])) {
                $element->addChild('uri', $this->author['uri']);
            }
        }

        if (!empty($this->contributor)) {
            $element = $xml->addChild('contributor');
            if (!isset($this->contributor['name'])) {
                throw new \Exception("The name attribute of category is required.");
            } else {
                $element->addChild('name', $this->contributor['name']);
            }
            if (isset($this->contributor['email'])) {
                $element->addChild('email', $this->contributor['email']);
            }
            if (isset($this->contributor['uri'])) {
                $element->addChild('uri', $this->contributor['uri']);
            }
        }

        if (!empty($this->generator)) {
            $element = $xml->addChild('generator', $this->generator['name']);
            
            if (isset($this->generator['uri'])) {
                $element->addAttribute('uri', $this->generator['uri']);
            }
            if (isset($this->generator['version'])) {
                $element->addAttribute('version', $this->generator['version']);
            }
        }

        if ($this->icon !== null) {
            $xml->addChild('icon', $this->icon);
        }

        if ($this->logo !== null) {
            $xml->addChild('logo', $this->logo);
        }

        if ($this->updated !== null) {
            $xml->addChild('updated', date(DATE_ATOM, $this->updated));
        }

        if ($this->rights !== null) {
            $xml->addChild('rights', $this->rights);
        }

        foreach ($this->entrys as $entry) {
            $toDom = dom_import_simplexml($xml);
            $fromDom = dom_import_simplexml($entry->asXML());
            $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        }

        return $xml;
    }
}
