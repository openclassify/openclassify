<?php

namespace Visiosoft\GlobalHelperExtension\Response;

class Response
{
    /**
     * Simple Formatted Response Class
     */

    protected bool $success = true;
    protected array $data = [];
    protected string $message = "";
    protected bool $isJson;


    /**
     * @param bool $isJson
     */
    public function __construct(bool $isJson = true)
    {
        $this->isJson = $isJson;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success = true)
    {
        $this->success = $success;
    }


    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }


    /**
     * @return array|object
     */
    public function getResponse()
    {
        $response = ['success' => $this->success];

        if (!empty($this->message)) {
            $response['message'] = $this->message;
        }

        if (!empty($this->data)) {
            $response['data'] = $this->data;
        }

        if ($this->isJson) {
            $response = (object)$response;
        }

        return $response;
    }

}