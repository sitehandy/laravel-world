<?php

declare(strict_types=1);

namespace Sitehandy\World;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sitehandy\World\Exceptions\InvalidCodeException;

/**
 * World Trait
 * 
 * Provides localization functionality for world geographical models.
 */
trait WorldTrait
{
    /**
     * Default locale setting.
     */
    protected string $defaultLocale = 'en';

    /**
     * Current locale setting.
     */
    protected string $locale = 'en';

    /**
     * Supported locales.
     */
    protected array $supportedLocales = [
        'en',
        'zh-cn',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setLocale(config('app.locale', 'en'));
    }

    /**
     * Set the current locale.
     */
    public function setLocale(string $locale): static
    {
        $locale = str_replace('_', '-', strtolower($locale));
        
        if (Str::startsWith($locale, 'en')) {
            $locale = 'en';
        }
        
        if (!in_array($locale, $this->supportedLocales, true)) {
            $locale = 'en';
        }
        
        $this->locale = $locale;
        
        return $this;
    }

    /**
     * Get the current locale.
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Get localized instance.
     */
    protected function getLocalized(): ?Model
    {
        return $this->locales()->where('locale', $this->locale)->first();
    }

    /**
     * Get localized name of instance.
     */
    public function getLocalNameAttribute(): string
    {
        if ($this->locale === $this->defaultLocale) {
            return $this->name;
        }
        
        $localized = $this->getLocalized();
        
        return $localized?->name ?? $this->name;
    }

    /**
     * Get localized full name of instance.
     */
    public function getLocalFullNameAttribute(): string
    {
        if ($this->locale === $this->defaultLocale) {
            return $this->full_name;
        }
        
        $localized = $this->getLocalized();
        
        return $localized?->full_name ?? $this->full_name;
    }

    /**
     * Get localized alias.
     */
    public function getLocalAliasAttribute(): string
    {
        if ($this->locale === $this->defaultLocale) {
            return $this->name;
        }
        
        $localized = $this->getLocalized();
        
        return $localized?->alias ?? $this->name;
    }

    /**
     * Get localized abbreviation.
     */
    public function getLocalAbbrAttribute(): string
    {
        if ($this->locale === $this->defaultLocale) {
            return $this->name;
        }
        
        $localized = $this->getLocalized();
        
        return $localized?->abbr ?? $this->name;
    }

    /**
     * Get instance by code (country code, etc.).
     * 
     * @throws InvalidCodeException
     */
    public static function getByCode(string $code): static
    {
        $code = strtolower($code);
        $column = mb_strlen($code) === 3 ? 'code_alpha3' : 'code';
        
        $world = self::where($column, $code)->first();
        
        if (!$world) {
            throw new InvalidCodeException("Code '{$code}' does not exist");
        }
        
        return $world;
    }
}
