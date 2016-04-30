<?php

namespace Soyaf518\XMLBuilder;

/**
 * Interface ChannelInterface
 * @package Sumiu\XMLWriter
 * @author  江小溅  <soyaf518@gmail.com>
 * @since  v1.0
 */
interface FeedInterface
{
    /**
     * Add feed id
     * @param  string $id
     * @return object $this
     */
    public function id($id);

    /**
     * Add feed title
     * @param  string $title
     * @return object $this
     */
    public function title($title);

    /**
     * Add feed subtitle
     * @param  string $subtitle
     * @return object $this
     */
    public function subtitle($subtitle);

    /**
     * Add feed link
     * @param  string $link
     * @return object $this
     */
    public function link($title);

    /**
     * Add feed author
     * @param  string $author
     * @return object $this
     */
    public function author($author);

    /**
     * Add feed contributor
     * @param  string $contributor
     * @return object $this
     */
    public function contributor($contributor);

    /**
     * Add feed category
     * @param  string $category
     * @return object $this
     */
    public function category($category);

    /**
     * Add feed generator
     * @param  string $generator
     * @return object $this
     */
    public function generator($generator);

    /**
     * Add feed icon
     * @param  string $icon
     * @return object $this
     */
    public function icon($icon);

    /**
     * Add feed logo
     * @param  string $logo
     * @return object $this
     */
    public function logo($logo);

    /**
     * Add feed rights
     * @param  string $rights
     * @return object $this
     */
    public function rights($rights);

    /**
     * Add feed updated
     * @param  string $updated
     * @return object $this
     */
    public function updated($updated);

    /**
     * Add entry object
     * @param EntryInterface $entry
     * @return object $this
     */
    public function addEntry(EntryInterface $entry);

    /**
     * Append to atom XML
     * @param AtomInterface $atom
     * @return object $this
     */
    public function appendTo(AtomInterface $atom);

    /**
     * Return XML
     * @return object SimpleXMLElement
     */
    public function asXML();
}