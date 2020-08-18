<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class appendRequestURL
{

    protected $query = [];

    protected $request;
    protected $url;
    protected $new_parameters;
    protected $remove_parameters;

    /**
     * appendRequestURL constructor.
     * @param $request
     */
    public function __construct($request, $url, $new_parameters = [], $remove_parameters = [])
    {
        $this->url = $url;
        $this->request = $request;
        $this->new_parameters = $new_parameters;
        $this->remove_parameters = $remove_parameters;
    }

    /**
     * @return appendRequestURL
     */
    public function handle()
    {

        $request = $this->removeParameters($this->request);

        if (count($this->new_parameters) === 0 && count($request) === 0) {
            return $this->url;
        } elseif (count($this->new_parameters) > 0 && count($request) > 0) {
            return $this->url
                . (Str::contains($this->url, '?') ? '&' : '?')
                . Arr::query($this->appends(array_merge($request, $this->new_parameters)));
        } elseif (count($this->new_parameters) > 0 && count($request) === 0) {
            return $this->url
                . (Str::contains($this->url, '?') ? '&' : '?')
                . Arr::query($this->appends($this->new_parameters));
        } elseif (count($this->new_parameters) === 0 && count($request) > 0) {
            return $this->url
                . (Str::contains($this->url, '?') ? '&' : '?')
                . Arr::query($this->appends($request));
        }
    }

    /**
     * @param $key
     * @param null $value
     * @return $this|appendRequestURL
     */
    public function appends($key, $value = null)
    {
        if (is_null($key)) {
            return $this->query;
        }

        if (is_array($key)) {
            return $this->appendArray($key)->query;
        }

        return $this->addQuery($key, $value)->query;
    }

    /**
     * @param array $keys
     * @return $this
     */
    protected function appendArray(array $keys)
    {
        foreach ($keys as $key => $value) {
            $this->addQuery($key, $value);
        }

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    protected function addQuery($key, $value)
    {
        $this->query[$key] = $value;

        return $this;
    }

    public function removeParameters(array $array)
    {
        foreach ($this->remove_parameters as $parameter) {
            unset($array[$parameter]);
        }

        return $array;
    }
}
