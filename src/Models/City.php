<?php

declare(strict_types=1);

namespace Sitehandy\World\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sitehandy\World\WorldTrait;

/**
 * City Model
 * 
 * Represents a city with its geographical and timezone information.
 */
class City extends Model
{
    use WorldTrait;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'world_cities';

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'local_name', 
        'local_full_name', 
        'local_alias', 
        'local_abbr'
    ];

    /**
     * Get the country that owns the city.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the division that owns the city.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get child geographical entities (cities have no children).
     */
    public function children(): null
    {
        return null;
    }

    /**
     * Get the parent geographical entity (division or country).
     */
    public function parent(): Country|Division|null
    {
        return $this->division_id === null ? $this->country : $this->division;
    }

    /**
     * Get the locales for the city.
     */
    public function locales(): HasMany
    {
        return $this->hasMany(CityLocale::class);
    }

    /**
     * Get timezone abbreviation for a given IANA timezone.
     */
    public static function timezoneAbbrev(string $ianaTimezone): string
    {
        if (empty($ianaTimezone) || !in_array($ianaTimezone, timezone_identifiers_list(), true)) {
            return '';
        }

        $dateTime = new DateTime();
        $dateTime->setTimeZone(new DateTimeZone($ianaTimezone));
        
        return $dateTime->format('T');
    }

    /**
     * Get GMT timezone offset for a given IANA timezone.
     */
    public static function timezoneOffset(string $ianaTimezone): string
    {
        if (empty($ianaTimezone) || !in_array($ianaTimezone, timezone_identifiers_list(), true)) {
            return '';
        }

        $dateTimeZone = new DateTimeZone($ianaTimezone);
        $timeInCity = new DateTime('now', $dateTimeZone);
        $offset = $dateTimeZone->getOffset($timeInCity) / 3600;
        
        return 'GMT' . ($offset < 0 ? $offset : "+{$offset}");
    }

    /**
     * Get city by name.
     */
    public static function getByName(string $name): ?self
    {
        $localized = CityLocale::where('name', $name)->first();
        
        return $localized?->city;
    }

    /**
     * Search cities by name.
     */
    public static function searchByName(string $name): \Illuminate\Database\Eloquent\Collection
    {
        return CityLocale::where('name', 'like', "%{$name}%")
            ->get()
            ->map(fn($item) => $item->city)
            ->filter();
    }
}
