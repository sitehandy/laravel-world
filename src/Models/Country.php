<?php

declare(strict_types=1);

namespace Sitehandy\World\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sitehandy\World\WorldTrait;

/**
 * Country Model
 * 
 * Represents a country with its geographical and political information.
 */
class Country extends Model
{
    use WorldTrait;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected $table = 'world_countries';

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'has_division' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'local_name',
        'local_full_name',
        'local_alias', 
        'local_abbr', 
        'local_currency_name'
    ];

    /**
     * Get the divisions for the country.
     */
    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class);
    }

    /**
     * Get the cities for the country.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the continent that owns the country.
     */
    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    /**
     * Get the next level geographical entities (divisions or cities).
     */
    public function children(): Collection
    {
        return $this->has_division ? $this->divisions : $this->cities;
    }

    /**
     * Get the parent geographical entity (continent).
     */
    public function parent(): ?Continent
    {
        return $this->continent;
    }

    /**
     * Get the locales for the country.
     */
    public function locales(): HasMany
    {
        return $this->hasMany(CountryLocale::class);
    }

    /**
     * Get localized currency name.
     */
    public function getLocalCurrencyNameAttribute(): string
    {
        if ($this->locale === $this->defaultLocale) {
            return $this->currency_name;
        }
        
        $localized = $this->getLocalized();
        
        return $localized?->currency_name ?? $this->currency_name;
    }
    
    /**
     * Get country by name.
     */
    public static function getByName(string $name): ?self
    {
        $localized = CountryLocale::where('name', $name)->first();
        
        return $localized?->country;
    }

    /**
     * Search countries by name.
     */
    public static function searchByName(string $name): Collection
    {
        return CountryLocale::where('name', 'like', "%{$name}%")
            ->get()
            ->map(fn($item) => $item->country)
            ->filter();
    }
}
