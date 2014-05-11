<?php
namespace  Poirot\Cldr\DataProvider;

use Poirot\Cldr\RepoReader\ReaderInterface;

/**
 * Interface ProviderInterface
 *
 * @package Poirot\Cldr\Provider
 */
interface ProviderInterface
{
    /**
     * Get Name Of Data Section
     *
     * @return string
     */
    public function getDataName();

    /**
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
     * Set Repo Reader For Provider
     *
     * @param ReaderInterface $repoReader
     *
     * @return $this
     */
    public function setRepoReader(ReaderInterface $repoReader);

    /**
     * Get Repo Reader Instance
     *
     * @return ReaderInterface
     */
    public function getRepoReader();

}
