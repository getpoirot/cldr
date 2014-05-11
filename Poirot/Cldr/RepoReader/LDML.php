<?php
namespace Poirot\Cldr\RepoReader;

/**
 * Class LDML
 *
 * @package Poirot\Cldr\RepoReader
 */
class LDML implements ReaderInterface
{
    /**
     * @var string File path to repo XML
     */
    protected $repo;

    /**
     * Repos XmlElement cache to avoid repeatation
     *
     * @var array(\SimpleXMLElement)
     */
    protected $simpleXMLElement;

    /**
     * Set repository data
     *
     * @param $repo
     *
     * @return $this
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;
    }

    /**
     * Get repository data for using inside a class
     *
     * @return mixed
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * Is valid Repository?
     *
     * @return boolean
     */
    public function isValidRepo()
    {
        $simpleXml = $this->attainSimpleXMLElement();

        return $simpleXml instanceof \SimpleXMLElement;
    }

    /**
     * Load current repo into simpleXMLElement object
     *
     * @return \SimpleXMLElement|false
     */
    protected function attainSimpleXMLElement()
    {
        $return = false;

        $repo = $this->getRepo();

        $repoNormalizeName = $repo;
        if (isset($this->simpleXMLElement[$repoNormalizeName])) {
            // load simpleXmlElement from internal cache to avoid load it again
            return $this->simpleXMLElement[$repoNormalizeName];
        }

        if ($repo && file_exists($repo)) {
            $xml = file_get_contents($repo);
            try {
                set_error_handler(function() {});
                $return = new \SimpleXMLElement($xml);
                $return = ($return instanceof \SimpleXMLElement) ? $return : false;
                restore_error_handler();
            } catch (\Exception $e)
            {
                $return = $return && false;
            }
        }

        if ($return) {
            // save into internal cache to avoid repeatation
            $this->simpleXMLElement[$repoNormalizeName] = $return;
        }

        return $return;
    }

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
    public function getEntityByPath($path, array $attributes = array())
    {
        $result = $this->readXml($path, $attributes);

        echo '<pre>';
        var_dump($result);
        exit;
    }

    /**
     * Read the content from locale
     *
     * @param  string $attribute
     *
     * @return array
     */
    protected function readXml($path, array $attributes = array())
    {
        if (! $this->isValidRepo()) {
            throw new \Exception(
                sprintf(
                    'The Repository "%s" is not valid repository or not found.',
                    $this->getRepo()
                )
            );
        }

        $path = ltrim($path, '/');
        $path = (strpos($path, 'ldml') === false) ? $path = 'ldml/'.$path : $path;
        $path = rtrim('/'.$path, '/');

        $xml = $this->attainSimpleXMLElement();

        // without attribute - read all values
        // with attribute    - read only this value
        $result = $xml->xpath($path);

        $result = $this->parsElement($result);

        return $result;
    }

    /**
     * Parse Element Attribute and Content Into Array
     *
     * @param \SimpleXMLElement $xmlElement SimpleXmlElement
     *
     * @return array
     */
    protected function parsElement($xmlElement)
    {
        $return = array();

        $prevElementName = ''; $i = 0;
        foreach ($xmlElement as $elementName => $r) {

            $key = 'content';
            $content = null;

            if (count($r)) {
                $return[$elementName] = $this->parsElement($r);

                continue;
            }

            $content = ($content) ? $content : (string) $r;

            $elementAttrs = (array)$r->attributes();
            $elementAttrs = ($elementAttrs) ? $elementAttrs['@attributes'] : $elementAttrs;
            if ($content) {
                $elementAttrs[$key] = $content;
            }

            $elementName = ($elementName == $prevElementName) ? $elementName.'_'.++$i : $elementName;
            $return[$elementName] = $elementAttrs;
            $prevElementName = $elementName;
        }

        return $return;
    }
}
