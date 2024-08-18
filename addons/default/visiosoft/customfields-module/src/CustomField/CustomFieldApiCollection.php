<?php namespace Visiosoft\CustomfieldsModule\CustomField;


use Anomaly\Streams\Platform\Entry\EntryModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Command\getFieldsByAd;

class CustomFieldApiCollection extends CustomFieldRepository
{
    use DispatchesJobs;

    public function getFieldsByAd(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['id'], $params));

        $ad = $this->checkAd($params['id']);

        $customfields = $this->dispatch(new getFieldsByAd($ad->id));

        return $customfields;
    }

    public function checkAd($id)
    {
        $ad_repository = app(AdvRepositoryInterface::class);

        if (!$ad = $ad_repository->newQuery()->find($id)) {
            throw new \Exception(trans('visiosoft.module.advs::message.ad_doesnt_exist'), 404);
            die;
        }
        return $ad;
    }

    public function getFieldOptions(array $params)
    {
        $this->dispatch(new CheckRequiredParams(['cf_id'], $params));

        $value_repository = app(CfvalueRepositoryInterface::class);

        return $value_repository->newQuery()->where('custom_field_id', $params['cf_id']);
    }

    public function updateValueByAd(array $params)
    {
        $fields = $this->getFieldsByAd($params);

        $ad_id = $params['id'];

        unset($params['id']);

        $fields = $fields->keyBy('slug');

        $required_fields = $fields->filter(function ($field) {

            return $field->required === true;
        });

        $this->dispatch(new CheckRequiredParams($required_fields->keys()->toArray(), $params));

        $option_fields = $fields->filter(function ($field) {

            return $field->options;
        });

        foreach ($option_fields as $key => $option_field) {
            if (isset($params[$key]) and !in_array($params[$key], array_keys($option_field['options']))) {
                throw new \Exception(trans('visiosoft.module.customfields::message.error_submit_cf_value', ['key' => $key]));
            }
        }

        $cf_json = array();
        foreach ($params as $key => $value) {
            $cf_json["cf".$fields[$key]['id']] = $value;
        }

        $ad = $this->checkAd($ad_id);

        $ad->setAttribute("cf_json", json_encode($cf_json));

        return $ad->save();
    }

    public function getValuesByAd(array $params)
    {
        $fields = $this->getFieldsByAd($params);
        $fields = $fields->keyBy('slug');

        $ad = $this->checkAd($params['id']);

        $cf_values = json_decode($ad->cf_json, true);

        $values = array();

        foreach ($fields as $key => $field) {
            $value = null;

            if ($cf_values and in_array("cf".$field['id'], array_keys($cf_values))) {
                $value = $cf_values["cf".$field['id']];
            }

            $values[$key] = $value;
        }

        // edit values with option
        foreach ($values as $key => $value) {
            if (isset($fields[$key]['options']) and in_array($value, array_keys($fields[$key]['options']))) {
                $values[$key] = $fields[$key]['options'][$value];
            }
        }

        $entry = new EntryModel();

        $entry->offsetSet('ad_id', $ad->id);
        $entry->offsetSet('cf_values', $values);

        return $entry;
    }
}
