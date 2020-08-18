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
        $count_newParameters = count($this->new_parameters);
        $count_request = count($this->request);

        if ($count_newParameters > 0) {
            return ($count_request > 0) ? $this->createURL(array_merge($request, $this->new_parameters)) : $this->createURL($this->new_parameters);
        } else {
            return ($count_request > 0) ? $this->createURL($request) : $this->url;
        }
    }

    public function createURL($append)
    {
        return $this->url . (Str::contains($this->url, '?') ? '&' : '?') . Arr::query($this->appends($append));
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
