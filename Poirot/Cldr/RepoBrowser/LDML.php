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
     * @var string exp. common/main
     */
    protected $dataName;

    /**
     * @var string Locale
     */
    protected $locale;

    /**
     * @var string Dir to repository
     */
    protected $repoDir;

    /**
     * Construct
     *
     * @param ProviderInterface|string $name   Name of data section
     * @param string                   $locale Locale
     */
    public function __construct($name = null, $locale = null)
    {
        if ($name) {
            $this->setDataName($name);
        }

        if ($locale) {
            $this->setLocale($locale);
        }
    }

    /**
     * Set Data Section Name.
     * exp. common/main
     *
     * @param ProviderInterface|string $name Name of data section
     *
     * @return $this
     */
    public function setDataName($name)
    {
        if ($name instanceof ProviderInterface) {
            $name = $name->getDataName();
        }

        $this->dataName = $name;
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
        $this->locale = $locale;
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
        $repoDir = $this->getRepositoryDir();

        $dataName = $this->dataName;
        $dataName = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $dataName);

        $repoDir .= DIRECTORY_SEPARATOR.trim($dataName, DIRECTORY_SEPARATOR);

        $locale   = $this->locale;

        $repoFile = $repoDir.DIRECTORY_SEPARATOR.$locale.'.xml';
        if (! file_exists($repoFile) && $locale != 'root') {
            $locale = substr($locale, 0, -strlen(strrchr($locale, '_')));
            $repoFile = $repoDir.DIRECTORY_SEPARATOR.$locale.'.xml';
            if (! file_exists($repoFile)) {
                $locale = 'root';
            }

            $this->setLocale($locale);

            $repoFile = $this->getRepo();
        }

        return $repoFile;
    }

    /**
     * Set Repository Directory
     *
     * @param string $dir Directory to repository
     *
     * @return $this
     */
    public function setRepositoryDir($dir)
    {
        if (!is_dir($dir)) {
            throw new \Exception(sprintf('Invalid directory "%s".', $dir));
        }

        $this->repoDir = $dir;

        return $this;
    }

    /**
     * Get directory to repository
     *
     * @return string
     */
    public function getRepositoryDir()
    {
        if (!$this->repoDir) {
            $DS = DIRECTORY_SEPARATOR;

            $dir = realpath(__DIR__.$DS.'..'.$DS.'..'.$DS.'..'.$DS.'repoLdml');
            $this->setRepositoryDir($dir);
        }

        return $this->repoDir;
    }
}
