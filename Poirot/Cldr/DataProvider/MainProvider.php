<?php
namespace  Poirot\Cldr\DataProvider;

/**
 * Class MainProvider
 * inside cldr reop => common/main
 *
 * @package Poirot\Cldr\Provider
 */
class MainProvider extends ProviderAbstract
{
    /**
     * This name is related to CLDR folder structure
     *
     * @var string Name of locale data section
     */
    protected $name = 'common/main';

    /**
     * Get Language xx
     *
     * @return string|null
     */
    public function getLanguage()
    {
        $data = $this->getRepoReader()->getEntityByPath('identity/language');

        return isset($data['language']['type']) ? $data['language']['type'] : null;
    }

    /**
     * Get Territory en_xx
     *
     * @return string|null
     */
    public function getTerritory()
    {
        $data = $this->getRepoReader()->getEntityByPath('identity/territory');

        return isset($data['territory']['type']) ? $data['territory']['type'] : null;
    }

    /**
     * Get languages with locale => name
     *
     * @return array
     */
    public function getLanguagesList()
    {
        $data = $this->getRepoReader()->getEntityByPath('localeDisplayNames/languages');
        $data = isset($data['languages']['value']) ? $data['languages']['value'] : array();

        $languages = array();
        foreach($data as $lang) {
            $languages[$lang['type']] = $lang['value'];
        }

        return $languages;
    }

    /**
     * Get Language name by locale
     *
     * @param string $locale Locale exp."fa"
     *
     * @return string|null
     */
    public function getLangNameByLocale($locale)
    {
        $data = $this->getRepoReader()->getEntityByPath(
            'localeDisplayNames/languages/language',
            array('type' => $locale)
        );

        return isset($data['language']['value']) ? $data['language']['value'] : null;
    }

    /**
     * Get scripts with code => name
     *
     * @return array
     */
    public function getScriptsList()
    {
        $data = $this->getRepoReader()->getEntityByPath('localeDisplayNames/scripts');
        $data = isset($data['scripts']['value']) ? $data['scripts']['value'] : array();

        $scripts = array();
        foreach($data as $scrt) {
            $scripts[$scrt['type']] = $scrt['value'];
        }

        return $scripts;
    }

    /**
     * Get Script name by code
     *
     * @param string $type Type exp."Arab"
     *
     * @return string|null
     */
    public function getScriptNameByType($type)
    {
        $data = $this->getRepoReader()->getEntityByPath(
            'localeDisplayNames/scripts/script',
            array('type' => $type)
        );

        return isset($data['script']['value']) ? $data['script']['value'] : null;
    }

    /**
     * Get scripts with territory => name
     *
     * @return array
     */
    public function getTerritoriesList()
    {
        $data = $this->getRepoReader()->getEntityByPath('localeDisplayNames/territories');
        $data = isset($data['territories']['value']) ? $data['territories']['value'] : array();

        $territories = array();
        foreach($data as $trtr) {
            $territories[$trtr['type']] = $trtr['value'];
        }

        return $territories;
    }

    /**
     * Get Territory name by code
     *
     * @param string $territory Territory exp."IR" | "001"
     *
     * @return string|null
     */
    public function getTerritoryName($territory)
    {
        $territory = strtoupper($territory);

        $data = $this->getRepoReader()->getEntityByPath(
            'localeDisplayNames/territories/territory',
            array('type' => $territory)
        );

        return isset($data['territory']['value']) ? $data['territory']['value'] : null;
    }

    /**
     * Get variants with code => name
     *
     * @return array
     */
    public function getVariantsList()
    {
        $data = $this->getRepoReader()->getEntityByPath('localeDisplayNames/variants');
        $data = isset($data['variants']['value']) ? $data['variants']['value'] : array();

        $variants = array();
        foreach($data as $var) {
            $variants[$var['type']] = $var['value'];
        }

        return $variants;
    }

    /**
     * Get Variant name by code
     *
     * @param string $variant Variant exp."SCOTLAND"
     *
     * @return string|null
     */
    public function getVariantName($variant)
    {
        $variant = strtoupper($variant);

        $data = $this->getRepoReader()->getEntityByPath(
            'localeDisplayNames/variants/variant',
            array('type' => $variant)
        );

        return isset($data['variant']['value']) ? $data['variant']['value'] : null;
    }

    /**
     * Get measurement system names, code => name
     *
     * @return array
     */
    public function getMeasurementSystemNames()
    {
        $data = $this->getRepoReader()->getEntityByPath('localeDisplayNames/measurementSystemNames');
        $data = isset($data['measurementSystemNames']['value']) ? $data['measurementSystemNames']['value'] : array();

        $measures = array();
        foreach($data as $msr) {
            $measures[$msr['type']] = $msr['value'];
        }

        return $measures;
    }

    /**
     * Get measurement name by code
     *
     * @param string $measure Measurement exp."metric"
     *
     * @return string|null
     */
    public function getMeasurementName($measure)
    {
        $data = $this->getRepoReader()->getEntityByPath(
            'localeDisplayNames/measurementSystemNames/measurementSystemName',
            array('type' => $measure)
        );

        return isset($data['measurementSystemName']['value']) ? $data['measurementSystemName']['value'] : null;
    }

    /**
     * Get Character Order
     *
     * @return string|null
     */
    public function getCharacterOrder()
    {
        $data = $this->getRepoReader()->getEntityByPath('layout/orientation/characterOrder');

        return isset($data['characterOrder']['value']) ? $data['characterOrder']['value'] : null;
    }
}
