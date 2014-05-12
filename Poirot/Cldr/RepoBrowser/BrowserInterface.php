<?php
namespace Poirot\Cldr\RepoBrowser;
use Poirot\Cldr\DataProvider\ProviderInterface;

/**
 * Interface BrowserInterface
 *
 * @package Poirot\Cldr\RepoBrowser
 */
interface BrowserInterface
{
    /**
     * Set Data Section Name.
     * exp. core/common/main
     *
     * @param ProviderInterface|string $name Name of data section
     *
     * @return $this
     */
    public function setDataName($name);

    /**
     * Get Locale Data Section Name
     *
     * @return string
     */
    public function getDataName();

    /**
     * Set Locale
     *
     * @param string $locale Locale
     *
     * @return $this
     */
    public function setLocale($locale);

    /**
     * Get Locale
     *
     * @return string
     */
    public function getLocale();

    /**
     * Get Repository
     * - returned repository will use on repo reader
     *
     * @see ReaderInterface::setRepo($repo);
     *
     * @return mixed
     */
    public function getRepo();
}