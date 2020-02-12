<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class appendRequestURL
{

    protected $query = [];

    protected $request;
    protected $url;
    protected $new_parameters;

    /**
     * appendRequestURL constructor.
     * @param $request
     */
    public function __construct($request, $url, $new_parameters = [])
    {
        $this->url = $url;
        $this->request = $request;
        $this->new_parameters = $new_parameters;
    }

    /**
     * @return appendRequestURL
     */
    public function handle()
    {
        return $this->url
            . (Str::contains($this->url, '?') ? '&' : '?')
            . Arr::query($this->appends(array_merge($this->request, $this->new_parameters)));
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
}
