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

    /**
     * Get localized translation of date fields
     *
     * @param string $code Field codes like: era, year, month, hour
     *
     * @return string|null
     */
    public function getDateFieldsName($code)
    {
        $code = strtolower($code);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/fields/field',
            array('type' => $code)
        );

        return isset($data['field']['value'])
            ? isset($data['field']['value']['displayName'])
                ? $data['field']['value']['displayName']['value']
                : null
            : null;
    }


    /**
     * Get dates relative phrase with next, prev, current steps.
     * exp. ('sun', 1) => یکشنبهٔ آینده
     *
     * @param string $fieldType Can be: year, month, week, sun .. sat
     * @param int    $time      0 current, -1 prev, 1 next
     *
     * @return string|null
     */
    public function getDateRelativeTimeStepsName($fieldType, $time)
    {
        $fieldType = strtolower($fieldType);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/fields/field[@type="'.$fieldType.'"]/relative',
            array('type' => $time)
        );

        return isset($data['relative']['value']) ? $data['relative']['value'] : null;
    }

    /**
     * Get Dates Future Past count phrase
     *
     * ('day', -21) => {0} روز پیش
     * ('day', 2)   => {0} روز بعد
     * ('day', 0)   => امروز
     *
     * @param string $fieldType Can be: year, month, week, day, hour, minute, second
     * @param int    $count     0 current, -x(negative) for past, positive for future
     *
     * @return string|null
     */
    public function getDateFuturePastTimesNameByCount($fieldType, $count)
    {
        $fieldType = strtolower($fieldType);

        if ($count == 0) {
            return $this->getDateRelativeTimeStepsName($fieldType, 0);
        } elseif ($count < 0) {
            $type = 'past';
        } else {
            $type = 'future';
        }

        $count = ($count >= -1 && $count <= 1) ? 'one' : 'other';

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/fields/field[@type="'.$fieldType.'"]/relativeTime[@type="'.$type.'"]/relativeTimePattern',
            array('count' => $count)
        );

        return isset($data['relativeTimePattern']['value']) ? $data['relativeTimePattern']['value'] : null;
    }

    /**
     * Get timezones list
     * exp. ["Asia/Yerevan"] => "ایروان"
     *
     * @return array
     */
    public function getTimeZoneNamesList()
    {
        $data = $this->getRepoReader()->getEntityByPath('dates/timeZoneNames/zone');

        $zones = array();
        foreach($data as $zn) {
            if (isset($zn['value']) && isset($zn['value']['exemplarCity'])) {
                $zones[$zn['type']] = $zn['value']['exemplarCity']['value'];
            }
        }

        return $zones;
    }

    /**
     * Get name of timezone by code
     *
     * @param string $code Timezone name
     *
     * @return string|null
     */
    public function getTimeZoneNameByCode($code)
    {
        $data = $this->getRepoReader()->getEntityByPath(
            'dates/timeZoneNames/zone',
            array('type' => $code)
        );

        return isset($data['zone']['value'])
            ? isset($data['zone']['value']['exemplarCity'])
                ? $data['zone']['value']['exemplarCity']['value']
                : null
            : null;
    }

    /**
     * Get Calendar Era Name
     * exp:
     * ('gregorian')    => قبل از میلاد
     * ('gregorian', 1) => میلادی
     *
     * @param string $calendar Calendar type, gregorian|islamic|persian
     * @param int    $type
     *
     * @return string|null
     */
    public function getCalendarEraName($calendar, $type = 0)
    {
        $calendar = strtolower($calendar);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/calendars/calendar[@type="'.$calendar.'"]/eras/eraNames/era'
        );

        $return = null;
        foreach($data as $er) {
            $return = (isset($return)) ? $return : $er['value'];

            $return = ($er['type'] == $type) ? $er['value'] : $return;
        }

        return $return;
    }

    /**
     * Get Calendar Era Abbr Name
     * exp:
     * ('gregorian')    => ق.م.
     * ('gregorian', 1) => م.
     *
     * @param string $calendar Calendar type, gregorian|islamic|persian
     * @param int    $type
     *
     * @return string|null
     */
    public function getCalendarEraAbbrName($calendar, $type = 0)
    {
        $calendar = strtolower($calendar);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/calendars/calendar[@type="'.$calendar.'"]/eras/eraAbbr/era'
        );

        $return = null;
        foreach($data as $er) {
            $return = (isset($return)) ? $return : $er['value'];

            $return = ($er['type'] == $type) ? $er['value'] : $return;
        }

        return $return;
    }

    /**
     * Get Calendar Era Narrow Name
     * exp:
     * ('gregorian')    => ق
     * ('gregorian', 1) => م
     *
     * @param string $calendar Calendar type, gregorian|islamic|persian
     * @param int    $type
     *
     * @return string|null
     */
    public function getCalendarEraNarrowName($calendar, $type = 0)
    {
        $calendar = strtolower($calendar);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/calendars/calendar[@type="'.$calendar.'"]/eras/eraNarrow/era'
        );

        $return = null;
        foreach($data as $er) {
            $return = (isset($return)) ? $return : $er['value'];

            $return = ($er['type'] == $type) ? $er['value'] : $return;
        }

        return $return;
    }


    /**
     * Get Month Localized for specific calendar
     * exp.
     * [1]=> "ژانویه"
     * [2]=> "فوریه"
     *
     * @param string $calendar Calendar type, gregorian|islamic|persian
     *
     * @return array
     */
    public function getCalendarMonthsList($calendar)
    {
        $calendar = strtolower($calendar);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/calendars/calendar[@type="'.$calendar.'"]/months/monthContext[@type="stand-alone"]/monthWidth[@type="wide"]/month'
        );

        $months = array();
        foreach($data as $mn) {
            $months[$mn['type']] = $mn['value'];
        }

        return $months;
    }

    /**
     * Get Month name for specific calendar
     *
     * @param string $calendar Calendar type, gregorian|islamic|persian
     * @param int $num Which Month?
     *
     * @return string
     */
    public function getCalendarMonthName($calendar, $num)
    {
        $calendar = strtolower($calendar);

        $data = $this->getRepoReader()->getEntityByPath(
            'dates/calendars/calendar[@type="'.$calendar.'"]/months/monthContext[@type="stand-alone"]/monthWidth[@type="wide"]/month',
            array('type' => $num)
        );

        return isset($data['month']['value']) ? $data['month']['value'] : null;
    }
}
