<?php

declare(strict_types=1);

namespace Sitehandy\World;

use Illuminate\Database\Eloquent\Collection;
use Sitehandy\World\Exceptions\InvalidCodeException;
use Sitehandy\World\Models\City;
use Sitehandy\World\Models\Continent;
use Sitehandy\World\Models\Country;
use Sitehandy\World\Models\Division;

/**
 * World
 * 
 * Main facade class for accessing world geographical data.
 */
class World
{
    /**
     * Get all continents ordered by name.
     */
    public static function continents(): Collection
    {
        return Continent::orderBy('name', 'asc')->get();
    }

    /**
     * Get all countries ordered by name.
     */
    public static function countries(): Collection
    {
        return Country::orderBy('name', 'asc')->get();
    }

    /**
     * Get continent by code.
     */
    public static function getContinentByCode(string $code): ?Continent
    {
        return Continent::getByCode($code);
    }

    /**
     * Get country by code.
     */
    public static function getCountryByCode(string $code): ?Country
    {
        return Country::getByCode($code);
    }

    /**
     * Get geographical entity by code (country, division, or city).
     * 
     * @throws InvalidCodeException
     */
    public static function getByCode(string $code): Country|Division|City|null
    {
        $code = strtolower($code);
        
        if (str_contains($code, '-')) {
            [$country_code, $region_code] = explode('-', $code, 2);
            $country = self::getCountryByCode($country_code);
            
            if (!$country) {
                throw new InvalidCodeException("Country code '{$country_code}' is invalid");
            }
            
            if ($country->has_division) {
                return Division::where([
                    ['country_id', $country->id],
                    ['code', $region_code],
                ])->first();
            }
            
            return City::where([
                ['country_id', $country->id],
                ['code', $region_code],
            ])->first();
        }
        
        return self::getCountryByCode($code);
    }
}
