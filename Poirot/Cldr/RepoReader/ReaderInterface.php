<?php
namespace Poirot\Cldr\RepoReader;
use Poirot\Cldr\RepoBrowser\BrowserInterface;

/**
 * Interface ReaderInterface
 *
 * @package Poirot\Cldr\RepoReader
 */
interface ReaderInterface
{
    /**
     * Construct
     *
     * @param BrowserInterface $repo Repo Browser
     */
    public function __construct(BrowserInterface $repo);

    /**
     * Set repository data
     *
     * @param BrowserInterface $repo Repository
     *
     * @return $this
     */
    public function setRepoBrowser(BrowserInterface $repo);

    /**
     * Get repository data for using inside a class
     *
     * @return mixed
     */
    public function getRepoBrowser();

    /**
     * Is valid Repository?
     *
     * @return boolean
     */
    public function isValidRepo();

    /**
     * Get data entity for a path with defined attributes
     * <pre>
     *   getEntityByPath('localeDisplayNames/languages');
     *   // or
     *   getEntityByPath('dates/calendars/calendar', array('type' => 'persian'));
     * </pre>
     *
     * @param string $path Path to an element list
     * @param array $attributes Array key=>value pair of an element attribute
     *
     * @return mixed
     */
    public function getEntityByPath($path, array $attributes = array());
}