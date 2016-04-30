<?php

namespace Soyaf518\XMLBuilder;

/**
 * Interface EntryInterface
 * @package Soyaf518\XMLBuilder
 * @author  江小溅  <soyaf518@gmail.com>
 * @since  v1.0
 */
interface EntryInterface
{
    /**
     * Add entry id
     * @param  string $id
     * @return object $this
     */
    public function id($id);

    /**
     * Add entry title
     * @param  string $title
     * @return object $this
     */
    public function title($title);

    /**
     * Add entry subtitle
     * @param  string $subtitle
     * @return object $this
     */
    public function subtitle($subtitle);

    /**
     * Add entry summary
     * @param  string $summary
     * @return object $this
     */
    public function summary($summary);

    /**
     * Add entry content
     * @param  string $content
     * @return object $this
     */
    public function content($content);

    /**
     * Add entry category
     * @param  string $category
     * @return object $this
     */
    public function category($category);

    /**
     * Add entry source
     * @param  string $source
     * @return object $this
     */
    public function source($source);

    /**
     * Add entry author
     * @param  string $author
     * @return object $this
     */
    public function author($author);

    /**
     * Add entry contributor
     * @param  string $contributor
     * @return object $this
     */
    public function contributor($contributor);

    /**
     * Add entry link
     * @param  string $link
     * @return object $this
     */
    public function link($link);

    /**
     * Add entry updated
     * @param  string $updated
     * @return object $this
     */
    public function updated($updated);

    /**
     * Add entry published
     * @param  string $published
     * @return object $this
     */
    public function published($published);

    /**
     * Add entry rights
     * @param  string $rights
     * @return object $this
     */
    public function rights($rights);

    /**
     * Append entry to the feed
     * @param FeedInterface $feed
     * @return object $this
     */
    public function appendTo(FeedInterface $feed);

    /**
     * Return XML
     * @return object SimpleXMLElement
     */
    public function asXML();
}