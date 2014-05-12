<?php
namespace  Poirot\Cldr\DataProvider;
use Poirot\Cldr\RepoBrowser\LDMLRepo;
use Poirot\Cldr\RepoReader\LDMLReader;
use Poirot\Cldr\RepoReader\ReaderInterface;

/**
 * Class ProviderAbstract
 *
 * @package Poirot\Cldr\DataProvider
 */
class ProviderAbstract implements ProviderInterface
{
    /**
     * This name is related to CLDR folder structure
     *
     * @var string Name of locale data section
     */
    protected $name = '';

    /**
     * @var ReaderInterface
     */
    protected $repoReader;

    /**
     * Construct
     *
     * @param string $locale Locale
     */
    public function __construct($locale)
    {
        $this->setLocale($locale);
    }

    /**
     * Get Name Of Data Section
     *
     * @return string
     */
    public function getDataName()
    {
        return $this->name;
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
        $this->getRepoReader()->getRepoBrowser()->setLocale($locale);

        return $this;
    }

    /**
     * Get Locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->getRepoReader()->getRepoBrowser()->getLocale();
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
        $repoReader->getRepoBrowser()
            ->setDataName(
                $this->getDataName()
            );

        $locale = $this->getLocale();
        $repoReader->getRepoBrowser()
            ->setLocale($locale);

        $this->repoReader = $repoReader;

        return $this;
    }

    /**
     * Get Repo Reader Instance
     *
     * @return ReaderInterface
     */
    public function getRepoReader()
    {
        if (!$this->repoReader) {
            $repoBrowser = new LDMLRepo($this);

            $this->repoReader = new LDMLReader($repoBrowser);
        }

        return $this->repoReader;
    }
}
