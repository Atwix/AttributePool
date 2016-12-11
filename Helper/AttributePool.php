<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) 2016 Atwix (https://www.atwix.com/)
 * @package Atwix_AttributePool
 */

namespace Atwix\AttributePool\Helper;

/**
 * Class AttributePool
 */
class AttributePool implements AttributePoolInterface
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * AttributePool constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Retrieve attributes from this pool
     *
     * @return array
     */
    public function getAttributes()
    {
        return array_values($this->attributes);
    }
}