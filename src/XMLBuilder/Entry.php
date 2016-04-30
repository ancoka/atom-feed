<?php

namespace Soyaf518\XMLBuilder;

use SimpleXMLElement;

/**
 * Interface EntryInterface
 * @package Soyaf518\XMLBuilder
 * @author  江小溅  <soyaf518@gmail.com>
 * @since  v1.0
 */
class Entry implements EntryInterface
{
    /**
     * @var string ID of the entry
     */
    protected $id;

    /**
     * @var string Title of the entry
     */
    protected $title;

    /**
     * @var string Subtitle of the entry
     */
    protected $subtitle;

    /**
     * @var string Summary of the entry
     */
    protected $summary;

    /**
     * @var string Content of the entry
     */
    protected $content;

    /**
     * @var array Categories of the entry
     */
    protected $categories = [];

    /**
     * @var array Source of the entry
     */
    protected $source;

    /**
     * @var array Author of the entry
     */
    protected $author;

    /**
     * @var array Contributor of the entry
     */
    protected $contributor;

    /**
     * @var array Links of the entry
     */
    protected $links = [];

    /**
     * @var integer Updated of the entry
     */
    protected $updated;

    /**
     * @var integer Published of the entry
     */
    protected $published;

    /**
     * @var string Rights of the entry
     */
    protected $rights;

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

    public function summary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    public function category($category)
    {
        $this->categories[] = $category;
        return $this;
    }

    public function source($source)
    {
        $this->source = $source;
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

    public function link($link)
    {
        $this->links[] = $link;
        return $this;
    }

    public function updated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    public function published($published)
    {
        $this->published = $published;
        return $this;
    }

    public function rights($rights)
    {
        $this->rights = $rights;
        return $this;
    }

    public function appendTo(FeedInterface $feed)
    {
        $feed->addEntry($this);
        return $this;
    }

    public function asXML()
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><entry></entry>',LIBXML_NOERROR | LIBXML_ERR_NONE | LIBXML_ERR_FATAL);

        if ($this->title !== null) {
            $xml->addChild('title', $this->title);
        }

        if ($this->subtitle) {
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

        if ($this->summary !== null) {
            $xml->addChild('summary', $this->summary);
        }

        if ($this->content !== null) {
            $element = $xml->addChild('content', null);
            $element->addAttribute('type', 'html');
            $element = dom_import_simplexml($element);
            $elementOwner = $element->ownerDocument;
            $element->appendChild($elementOwner->createCDATASection($this->content));
        }

        if (!empty($this->source)) {
            $element = $xml->addChild('source');
            foreach ($this->source as $key => $value) {
                $element->addChild($key, $value);
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

        if ($this->updated !== null) {
            $xml->addChild('updated', date(DATE_ATOM, $this->updated));
        }

        if ($this->published !== null) {
            $xml->addChild('published', date(DATE_ATOM, $this->published));
        }

        if ($this->rights !== null) {
            $xml->addChild('rights', $this->rights);
        }

        return $xml;
    }

}
