<?php namespace Visiosoft\CustomfieldsModule\CustomField;

use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldInterface;
use Anomaly\Streams\Platform\Model\Customfields\CustomfieldsCustomFieldsEntryModel;
use Visiosoft\CustomfieldsModule\Cfvalue\CfvalueModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomFieldModel extends CustomfieldsCustomFieldsEntryModel implements CustomFieldInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function selectableType()
    {
        $customfields = $this->query()
            ->where('type', 'select')
            ->orwhere('type', 'selectdropdown')
            ->orWhere('type', 'checkboxes')
            ->orWhere('type', 'radio')
            ->orWhere('type', 'selecttop')
            ->orWhere('type', 'selectrange')
            ->orWhere('type', 'selectimage')
            ->get();
        return $customfields;
    }

    /**
     * @return HasMany
     */
    public function cfvalues()
    {
        return $this->hasMany(CfvalueModel::class, 'custom_field_id');
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getCustomfieldsJoinCategoryWithCategoryID($id = null)
    {
        return $this->customfieldsJoinCategoryWithCategoryID($id)->get();
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function customfieldsJoinCategoryWithCategoryID($id = null)
    {
        $query = $this->query()->leftJoin('customfields_parent', function ($join) {
            $join->on('customfields_custom_fields.id', '=', 'customfields_parent.cf_id');
        });

        $query = $query->selectRaw("default_customfields_custom_fields.*,
        default_customfields_parent.cat_id as cat_id");

        if ($id != null)
            return $query->where('cat_id', $id);
        else
            return $query->where('cat_id', NULL)->orWhere('cat_id', 0);

    }

    public function checkType($type)
    {
        return $this->type === $type ? true : false;
    }

    public function getType()
    {
        return $this->type;
    }

    public function isSortable()
    {
        return in_array($this->type, ['decimal', 'integer', 'range', 'selectrange']);
    }

    public function hasValues()
    {
        return $this->cfvalues()->count() > 0;
    }

    public function getClassifiedValue($classifiedCF = null)
    {
        $hasValues = $this->hasValues();
        $cFValueRepository = app(CfvalueRepositoryInterface::class);

        if ($hasValues) {
            if (isset($classifiedCF["cf$this->id"])) {
                if (is_array($classifiedCF["cf$this->id"])) {
                    $valuesArray = $classifiedCF["cf$this->id"];
                    $customFieldsMulti = array();

                    foreach ($this->cfvalues as $allCFVal) {
                        $customFieldsMulti[$allCFVal->id] = [
                            'val' => $allCFVal->custom_field_value,
                            'status' => in_array($allCFVal->id, $valuesArray) ? 1 : 0
                        ];
                    }

                    return $customFieldsMulti;
                } else {
                    if ($this->type === 'selectrange') {
                        return $classifiedCF["cf$this->id"];
                    } elseif ($cFValue = $cFValueRepository->find($classifiedCF["cf$this->id"])) {
                        return $cFValue->custom_field_value;
                    }
                }
            } else {
                $customFieldsMulti = array();

                if ($this->type == "checkboxes") {
                    foreach ($this->cfvalues as $allCFVal) {
                        $customFieldsMulti[$allCFVal->id] = ['val' => $allCFVal->custom_field_value, 'status' => 0];
                    }
                } else {
                    $customFieldsMulti = "-";
                }

                return $customFieldsMulti;
            }
        } else {
            return $classifiedCF["cf$this->id"] ?? '-';
        }
    }
}
