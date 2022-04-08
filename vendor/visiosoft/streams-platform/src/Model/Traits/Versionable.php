<?php namespace Anomaly\Streams\Platform\Model\Traits;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Version\Command\SaveVersion;
use Anomaly\Streams\Platform\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Version\VersionCollection;
use Anomaly\Streams\Platform\Version\VersionModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Versionable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait Versionable
{

    /**
     * Versionable flag.
     *
     * @var bool
     */
    protected $versionable = false;

    /**
     * The versioning-disabled flag.
     *
     * @var bool
     */
    protected $versioningDisabled = false;

    /**
     * The versioned attributes.
     *
     * @var array
     */
    protected $versionedAttributes = [];

    /**
     * The version comparison data.
     *
     * @var array
     */
    protected $versionComparisonData = [];

    /**
     * The non-versioned attributes.
     *
     * @var array
     */
    protected $nonVersionedAttributes = [];

    /**
     * The version differences.
     *
     * @var null|array
     */
    protected $versionDifferences = null;

    /**
     * Return if the model should version or not.
     *
     * @return bool
     */
    public function shouldVersion()
    {
        if (!config('streams::system.versioning_enabled', true)) {
            return false;
        }

        if ($this->versioningDisabled()) {
            return false;
        }

        if ($this->wasRecentlyCreated) {
            return true;
        }

        if ($this->getVersionDifferences()) {
            return true;
        }

        return false;
    }

    /**
     * Push a version if applicable.
     * Push a version anyways if forced.
     *
     * @param bool $force
     * @return VersionInterface|null
     */
    public function version($force = false)
    {
        if (!$latest = $this->getCurrentVersion()) {
            return $this->pushVersion();
        }

        $this->setVersionComparisonData(
            $latest
                ->getModel()
                ->toArrayForComparison()
        );

        $this->fireFieldTypeEvents('versioning', ['entry' => $this]);

        if (!$this->shouldVersion() && $force == false) {
            return null;
        }

        return $this->pushVersion();
    }

    /**
     * Push a new version.
     *
     * @return VersionInterface|EloquentModel
     */
    public function pushVersion()
    {
        return dispatch(new SaveVersion($this));
    }

    /**
     * Get the versionable flag.
     *
     * @return bool
     */
    public function isVersionable()
    {
        return $this->versionable;
    }

    /**
     * Set the versionable flag.
     *
     * @param $versionable
     * @return $this
     */
    public function setVersionable($versionable)
    {
        $this->versionable = $versionable;

        return $this;
    }

    /**
     * Enable versioning.
     *
     * @return $this
     */
    public function enableVersioning()
    {
        $this->versioningDisabled = false;

        return $this;
    }

    /**
     * Disable versioning.
     *
     * @return $this
     */
    public function disableVersioning()
    {
        $this->versioningDisabled = true;

        return $this;
    }

    /**
     * Return if versioning is disabled.
     *
     * @return bool
     */
    public function versioningDisabled()
    {
        return $this->versioningDisabled == true;
    }

    /**
     * Return versioned attributes.
     *
     * @return array
     */
    public function getVersionedAttributes()
    {
        return $this->versionedAttributes;
    }

    /**
     * Return non-versioned attributes.
     *
     * @return array
     */
    public function getNonVersionedAttributes()
    {
        return array_merge(
            $this->nonVersionedAttributes,
            [
                'id',
                'sort_order',
                'created_at',
                'created_by_id',
                'updated_at',
                'updated_by_id',
                'deleted_at',
                'deleted_by_id',
            ]
        );
    }

    /**
     * Return if the attribute is
     * translatable or not.
     *
     * @param $key
     * @return bool
     */
    public function isVersionedAttribute($key)
    {
        return in_array($key, $this->versionedAttributes);
    }

    /**
     * Get the version comparison differences.
     *
     * @return array
     */
    public function getVersionDifferences()
    {
        if ($this->versionDifferences !== null) {
            return $this->versionDifferences;
        }

        if (!$comparison = $this->getVersionComparisonData()) {
            return $this->versionDifferences = $this->toArrayForComparison();
        }

        $data = $this->toArrayForComparison();

        array_walk(
            $data,
            function (&$value) {

                if (is_array($value)) {
                    $value = serialize($value);
                }
            }
        );

        array_walk(
            $comparison,
            function (&$value) {

                if (is_array($value)) {
                    $value = serialize($value);
                }
            }
        );

        $this->versionDifferences = array_diff_assoc(
            $comparison,
            $data
        );

        return $this->versionDifferences;
    }

    /**
     * Return the versioned attribute changes.
     *
     * @return array
     */
    public function versionedAttributeChanges()
    {
        return array_diff_key(
            $this->getVersionDifferences(),
            array_flip($this->getNonVersionedAttributes())
        );
    }


    /**
     * Return the latest version.
     *
     * @return VersionInterface|null
     */
    public function getCurrentVersion()
    {
        return $this
            ->versions()
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    /**
     * Return the previous version.
     *
     * @return VersionInterface
     */
    public function getPreviousVersion()
    {
        return $this
            ->versions()
            ->orderBy('created_at', 'DESC')
            ->limit(1)
            ->offset(1)
            ->first();
    }

    /**
     * Get the related versions.
     *
     * @return VersionCollection
     */
    public function getVersions()
    {
        return $this->getAttribute('versions');
    }

    /**
     * Return the versions relation.
     *
     * @return HasMany
     */
    public function versions()
    {
        return $this->morphMany(VersionModel::class, 'versionable');
    }

    /**
     * Get the version comparison data.
     *
     * @return array
     */
    public function getVersionComparisonData()
    {
        return $this->versionComparisonData;
    }

    /**
     * Set the version comparison data.
     *
     * @param array $data
     * @return $this
     */
    public function setVersionComparisonData(array $data)
    {
        $this->versionComparisonData = $data;

        return $this;
    }

}
