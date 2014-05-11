<?php
namespace  Poirot\Cldr\DataProvider;
use Poirot\Cldr\RepoReader\ReaderInterface;

/**
 * Class Main
 * inside cldr reop => core/common/main
 *
 * @package Poirot\Cldr\Provider
 */
class Main implements ProviderInterface
{
    /**
     * Get Name Of Data Section
     *
     * @return string
     */
    public function getDataName()
    {
        // TODO: Implement getDataName() method.
    }

    /**
     * @param string $locale Locale
     *
     * @return $this
     */
    public function setLocale($locale)
    {
        // TODO: Implement setLocale() method.
    }

    /**
     * Get Locale
     *
     * @return string
     */
    public function getLocale()
    {
        // TODO: Implement getLocale() method.
    }

    /**
     * Set Repo Reader For Provider
     *
     * @param ReaderInterface $repoReader
     *
     * @return $this
     */
    public function setRepoReader(ReaderInterface $repoReader)
    {
        // TODO: Implement setRepoReader() method.
    }

    /**
     * Get Repo Reader Instance
     *
     * @return ReaderInterface
     */
    public function getRepoReader()
    {
        // TODO: Implement getRepoReader() method.
    }
}
