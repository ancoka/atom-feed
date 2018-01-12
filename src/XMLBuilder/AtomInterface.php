<?php

namespace Ancoka\XMLBuilder;

/**
 * Interface AtomInterface
 * @package Ancoka\XMLBuilder
 * @author ancoka <imancoka@gmail.com>
 * @since v1.0
 */
interface AtomInterface
{
    /**
     * Add feed XML
     * @param FeedInterface $feed
     * @return object $this
     */
    public function addFeed(FeedInterface $feed);

    /**
     * Builder XML
     * @return string
     */
    public function builder();

    /**
     * Builder XML
     * @return string
     */
    public function __toString();
}