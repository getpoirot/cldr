<?php
namespace Poirot\Cldr\RepoReader;
use Poirot\Cldr\RepoBrowser\BrowserInterface;

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
     * Construct
     *
     * @param BrowserInterface $repo Repo Browser
     */
    public function __construct(BrowserInterface $repo = null)
    {
        if ($repo) {
            $this->setRepoBrowser($repo);
        }
    }

    /**
     * Set repository data
     *
     * @param BrowserInterface $repo Repository
     *
     * @return $this
     */
    public function setRepoBrowser(BrowserInterface $repo)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * Get repository data for using inside a class
     *
     * @return BrowserInterface
     */
    public function getRepoBrowser()
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

        $repo = $this->getRepoBrowser()->getRepo();

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

        return $result;
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

        $xpathAttr = ''; $i = 0;
        foreach($attributes as $key => $val) {
            // make xpath attribute query [@type=persian and @attr=value]
            $xpathAttr = ($i == 0) ? '['.$xpathAttr : $xpathAttr;
            $xpathAttr .= ($i > 0) ? ' and ' : '';
            $xpathAttr .= '@'.$key.'="'.$val.'"';
            $xpathAttr = ($i == count($attributes)-1) ? $xpathAttr.']' : $xpathAttr;

            $i++;
        }

        $path = ($xpathAttr) ? $path.$xpathAttr : $path;

        $xml = $this->attainSimpleXMLElement();

        // without attribute - read all values
        // with attribute    - read only this value
        set_error_handler(
            function ($error, $message = '', $file = '', $line = 0) {
                throw new \Exception(
                    $message,
                    $error
                );
            }
        );
        $result = $xml->xpath($path);
        restore_error_handler();

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
        foreach ($xmlElement as $r)
        {
            $elementName = $r->getName();
            $newElementName = ($elementName === $prevElementName) ? $elementName.'_'.++$i : $elementName;

            $prevElementName = $elementName;

            $content = null;
            if (count($r)) {
                $content = $this->parsElement($r);
            }
            $content = ($content) ? $content : (string) $r;

            $key = 'value';
            $elementAttrs = (array)$r->attributes();
            $elementAttrs = ($elementAttrs) ? $elementAttrs['@attributes'] : $elementAttrs;
            if ($content) {
                $elementAttrs[$key] = $content;
            }

            $return[$newElementName] = $elementAttrs;
        }

        return $return;
    }
}
