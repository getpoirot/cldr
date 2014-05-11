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
     * Get list of data for a path with defined attributes
     * <pre>
     *   getListByPath('localeDisplayNames/languages');
     *   // or
     *   getListByPath('dates/calendars/calendar', array('type' => 'persian'));
     * </pre>
     *
     * @param string $path Path to an element list
     * @param array $attributes Array key=>value pair of an element attribute
     *
     * @return mixed
     */
    public function getListByPath($path, array $attributes = array());

    /**
     * Get Content String For Given Path
     *
     * @param string $path Path to an element list
     * @param array $attributes Array key=>value pair of an element attribute
     *
     * @return string
     */
    public function getContentByPath($path, array $attributes = array());
}