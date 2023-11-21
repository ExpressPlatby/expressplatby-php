<?php

namespace ExpressPlatby\ApiOperations;

/**
 * Trait for retrievable singleton resources. Adds a `retrieve()` static method to the
 * class.
 *
 * This trait should only be applied to classes that derive from SingletonApiResource.
 */
trait SingletonRetrieve
{
    /**
     * @param null|array|string $opts the ID of the API resource to retrieve,
     *     or an options array containing an `id` key
     *
     * @throws \ExpressPlatby\Exception\ApiErrorException if the request fails
     *
     * @return static
     */
    public static function retrieve($opts = null)
    {
        $opts = \ExpressPlatby\Util\RequestOptions::parse($opts);
        $instance = new static(null, $opts);
        $instance->refresh();

        return $instance;
    }
}
