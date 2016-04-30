<?php

namespace Soyaf518\XMLBuilder;

/**
 * Interface AtomInterface
 * @package Soyaf518\XMLBuilder
 * @author  江小溅  <soyaf518@gmail.com>
 * @since  v1.0
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