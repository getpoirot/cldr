<?php
namespace Poirot\Cldr\RepoBrowser;
use Poirot\Cldr\DataProvider\ProviderInterface;

/**
 * Class LDML
 *
 * @package Poirot\Cldr\RepoBrowser
 */
class LDML implements BrowserInterface
{

    /**
     * Set Data Section Name.
     * exp. core/common/main
     *
     * @param ProviderInterface|string $name Name of data section
     *
     * @return $this
     */
    public function setDataName($name)
    {
        // TODO: Implement setDataName() method.
    }

    /**
     * Set Locale
     *
     * @param string $locale Locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        // TODO: Implement setLocale() method.
    }

    /**
     * Get Repository
     * - returned repository will use on repo reader
     *
     * @see ReaderInterface::setRepo($repo);
     *
     * @return mixed
     */
    public function getRepo()
    {
        // TODO: Implement getRepo() method.
    }
}
