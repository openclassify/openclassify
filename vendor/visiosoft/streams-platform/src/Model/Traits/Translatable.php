<?php namespace Anomaly\Streams\Platform\Model\Traits;

use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Translatable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait Translatable
{

    /**
     * The translatable attributes.
     *
     * @var array
     */
    protected $translatedAttributes = [];

    /**
     * Restrict results where
     * in the provided locale.
     *
     * @param Builder $query
     * @param $locale
     * @return Builder
     */
    public function scopeTranslatedIn(Builder $query, $locale)
    {
        return $query->whereHas(
            'translations',
            function (Builder $q) use ($locale) {
                $q->where($this->getLocaleKey(), '=', $locale);
            }
        );
    }

    /**
     * Restrict results where
     * translated entries only.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeTranslated(Builder $query)
    {
        return $query->has('translations');
    }

    /**
     * Return translated attributes.
     *
     * @return array
     */
    public function getTranslatedAttributes()
    {
        return $this->translatedAttributes;
    }

    /**
     * Return if the attribute is
     * translatable or not.
     *
     * @param $key
     * @return bool
     */
    public function isTranslatedAttribute($key)
    {
        return in_array($key, $this->translatedAttributes);
    }

    /**
     * Return the translatable flag.
     *
     * @return bool
     */
    public function isTranslatable()
    {
        return isset($this->translationModel);
    }

    /**
     * Set the translatable flag.
     *
     * @param $translatable
     * @return $this
     */
    public function setTranslatable($translatable)
    {
        $this->translatable = $translatable;

        return $this;
    }

    /*
     * Alias for getTranslation()
     *
     * @return EloquentModel|null
     */
    public function translate($locale = null, $withFallback = false)
    {
        return $this->getTranslation($locale, $withFallback);
    }

    /*
     * Alias for getTranslation()
     *
     */
    /**
     * @param null $locale
     * @return Translatable
     */
    public function translateOrDefault($locale = null)
    {
        if (!$locale) {
            $locale = $this->getDefaultLocale();
        }

        return $this->getTranslation($locale, true) ?: $this;
    }

    /*
     * Alias for getTranslationOrNew()
     *
     * @return EloquentModel|null
     */
    public function translateOrNew($locale)
    {
        return $this->getTranslationOrNew($locale);
    }

    /**
     * Get related translations.
     *
     * @return EloquentCollection
     */
    public function getTranslations()
    {
        /* @var EloquentModel $translation */
        foreach ($translations = $this->translations as $translation) {
            $translation->setRelation('parent', $this);
        }

        return $translations;
    }

    /**
     * Return the translations relation.
     *
     * @return HasMany
     */
    public function translations()
    {
        if (!$model = $this->getTranslationModelName()) {
            return null;
        }

        return $this->hasMany($model, $this->getRelationKey());
    }

    /**
     * Get a translation.
     *
     * @param  null $locale
     * @param  bool|null $withFallback
     * @return EloquentModel|null
     */
    public function getTranslation($locale = null, $withFallback = true)
    {

        // Default to the current locale.
        $locale = $locale ?: app()->getLocale();

        /**
         * If we have a desired locale and
         * it exists then just use that locale.
         */
        if ($translation = $this->getTranslationByLocaleKey($locale)) {
            return $translation;
        }

        /**
         * If we don't have a locale or it does not exist
         * then go ahead and try using a fallback in using
         * the system's designated DEFAULT (not active) locale.
         */
        if ($withFallback
            && $translation = $this->getTranslationByLocaleKey($this->getDefaultLocale())
        ) {
            return $translation;
        }

        /**
         * If we still don't have a translation then
         * try looking up the FALLBACK translation.
         */
        if ($withFallback
            && $this->getFallbackLocale()
            && $this->getTranslationByLocaleKey($this->getFallbackLocale())
            && $translation = $this->getTranslationByLocaleKey($this->getFallbackLocale())
        ) {
            return $translation;
        }

        return null;
    }

    /**
     * Return if a translation exists or not.
     *
     * @param null $locale
     * @return bool
     */
    public function hasTranslation($locale = null)
    {
        $locale = $locale ?: $this->getFallbackLocale();

        foreach ($this->getTranslations() as $translation) {
            if ($translation->getAttribute($this->getLocaleKey()) == $locale) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the translation model.
     *
     * @return EloquentModel
     */
    public function getTranslationModel()
    {
        return new $this->translationModel;
    }

    /**
     * Get the translation model name.
     *
     * @return string
     */
    public function getTranslationModelName()
    {
        return $this->translationModel ? get_class(app($this->translationModel)) : null;
    }

    /**
     * Return if the model IS the
     * default translation or not.
     *
     * @return bool
     */
    public function isDefaultTranslation()
    {
        return $this->getAttribute('locale') === $this->getDefaultLocale();
    }

    /**
     * Get the translation table name.
     *
     * @return string
     */
    public function getTranslationTableName()
    {
        $model = $this->getTranslationModel();

        return $model->getTableName();
    }

    /**
     * Get the default translation model name.
     *
     * @return string
     */
    public function getTranslationModelNameDefault()
    {
        return get_class($this) . 'Translation';
    }

    /**
     * Save translations to the database.
     *
     * @return bool
     */
    protected function saveTranslations()
    {
        $saved = true;

        $translations = $this->getTranslations();

        foreach ($this->getTranslations() as $translation) {

            /* @var EloquentModel $translation */
            if ($saved) {

                $translation->setAttribute($this->getRelationKey(), $this->getKey());

                $saved = $translation->save();
            }
        }

        if ($translations->isEmpty()) {

            $translation = $this->translateOrNew(config('streams::locales.default'));

            $translation->save();
        }

        $this->finishSave(['version' => false]);

        return $saved;
    }

    /**
     * Get a translation or new instance.
     *
     * @param $locale
     * @return EloquentModel|null
     */
    protected function getTranslationOrNew($locale)
    {
        if (($translation = $this->getTranslation($locale, false)) === null) {
            $translation = $this->getNewTranslation($locale);
        }

        return $translation;
    }

    /**
     * Get a translation by locale key.
     *
     * @param $key
     * @return EloquentModel|null
     */
    protected function getTranslationByLocaleKey($key)
    {
        foreach ($this->getTranslations() as $translation) {

            if ($translation->getAttribute($this->getLocaleKey()) == $key) {
                return $translation;
            }
        }

        return null;
    }

    /**
     * Return if the translation is dirty or not.
     *
     * @param Model $translation
     * @return bool
     */
    protected function isTranslationDirty(Model $translation)
    {
        $dirtyAttributes = $translation->getDirty();
        unset($dirtyAttributes[$this->getLocaleKey()]);

        return count($dirtyAttributes) > 0;
    }

    /**
     * Return if the provided
     * key is a locale ISO.
     *
     * @param $key
     * @return bool
     */
    protected function isKeyALocale($key)
    {
        return config('streams::locales.supported.' . $key) !== null;
    }

    /**
     * Get a new translation model.
     *
     * @param $locale
     * @return EloquentModel
     */
    public function getNewTranslation($locale)
    {
        $modelName = $this->getTranslationModelName();

        /* @var EloquentModel $translation */
        $translation = new $modelName;

        $translation->setRelation('parent', $this);

        $translation->setAttribute($this->getLocaleKey(), $locale);
        $translation->setAttribute($this->getRelationKey(), $this->getKey());

        $this
            ->getTranslations()
            ->add($translation);

        return $translation;
    }

    /**
     * Get the translation foreign key.
     *
     * @return string
     */
    public function getRelationKey()
    {
        return $this->translationForeignKey ?: $this->getForeignKey();
    }

    /**
     * Get the locale key.
     *
     * @return string
     */
    public function getLocaleKey()
    {
        return $this->localeKey ?: 'locale';
    }

    /**
     * Return if the entry is trashed or not.
     *
     * @todo is this really used/needed?
     *
     * @return bool
     */
    public function trashed()
    {
        return parent::trashed();
    }
}
