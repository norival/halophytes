<?php

namespace App\Service;

/**
 * A class to help querying the crossref API
 */
class CrossrefHelper
{
    public const CROSSREF_BASE_URL  = 'https://api.crossref.org/works/';
    public const DOI_REGEXP         = '/^.*10\.\d{4,9}\/[-._;()\/:A-Z0-9]+$/i';
    public const DOI_REGEXP_REPLACE = '/^.*\/(10\.\d{4,9}\/[-._;()\/:A-Z0-9]+)$/i';

    /**
     * Parse a given url to extract the DOI
     *
     * @param  string $url The url to parse
     * @return string Returns an empty string if no DOI is found in the url
     */
    public function parseUrl(string $url): string
    {

        if (!preg_match(self::DOI_REGEXP, $url)) {
            return '';
        }

        return preg_replace(self::DOI_REGEXP_REPLACE, "$1", $url);
    }

    /**
     * Send a query to Crossref API and return the data
     *
     * @param  string $doi The DOI to look for
     * @return Array The parsed meta data or empty array if the query did not work
     */
    public function query(string $doi): Array
    {
        // TODO throw an exception
        if (!$this->isValid($doi)) {
            return [];
        }

        return \json_decode(file_get_contents(self::CROSSREF_BASE_URL . $doi), true)['message'];
    }

    /**
     * Validate a given DOI
     *
     * @param  string $doi The doi to validate
     * @return bool Wether the DOI is valid or not
     */
    private function isValid(string $doi): bool
    {
        return preg_match(self::DOI_REGEXP, $doi);
    }
}
