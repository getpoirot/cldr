<?php
namespace Poirot\Cldr\RepoReader;

/**
 * Interface ReaderInterface
 *
 * @package Poirot\Cldr\RepoReader
 */
interface ReaderInterface
{
    /**
     * Set repository data
     *
     * @param $repo
     *
     * @return $this
     */
    public function setRepo($repo);

    /**
     * Get repository data for using inside a class
     *
     * @return mixed
     */
    public function getRepo();

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