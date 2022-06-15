<?php

namespace Visiosoft\ApiLoggerModule;

use Visiosoft\ApiLoggerModule\Contract\ApiLoggerInterface;
use Visiosoft\ApiLoggerModule\Log\LogRepository;

class ApiLogger implements ApiLoggerInterface
{
    public LogRepository $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * @param string $url
     * @param array $headers
     * @param array $data
     * @param array $params
     * @return array
     */
    public function getRequest(string $url, array $headers, array $data, array $params = [])
    {
        $url = $this->retrieveUrl($url, $params);
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $headers
        ]);
        $http_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            return $this->error($http_response, $http_code);
        }
        return $this->response(true, json_decode($http_response, true));
    }

    /**
     * @param string $url
     * @param array $headers
     * @param array $data
     * @param array $params
     * @return array
     */
    public function postRequest(string $url, array $headers, array $data, array $params = [])
    {
        $url = $this->retrieveUrl($url, $params);
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $data
        ]);
        $http_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            return $this->error($http_response, $http_code);
        }
        return $this->response(true, json_decode($http_response, true));
    }

    /**
     * @param string $url
     * @param array $headers
     * @param array $data
     * @param array $params
     * @return array
     */
    public function putRequest(string $url, array $headers, array $data, array $params = [])
    {
        $url = $this->retrieveUrl($url, $params);
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $data
        ]);
        $http_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            return $this->error($http_response, $http_code);
        }
        return $this->response(true, json_decode($http_response, true));
    }

    /**
     * @param string $url
     * @param array $headers
     * @param array $params
     * @return array|string
     */
    public function get(string $namespace, string $keyword, string $url, array $headers, array $params, bool $cache = false)
    {
        if ($cache) {
            if ($cacheData = $this->logRepository->where('namespace', $namespace)->where('keyword', $keyword)->first()) {
                return $this->response(true, json_decode($cacheData->response, true));
            }
            $data = $this->getRequest($url, $headers, $params);
            if (!$data['success']) {
                return $data;
            }
            $this->logRepository->create([
                'namespace' => $namespace,
                'keyword' => $keyword,
                'url' => $url,
                'params' => json_encode($params),
                'data' => '',
                'response' => json_encode($data['data'])
            ]);
            return $data;
        }
        return $this->getRequest($url, $headers, $params);
    }

    /**
     * @param string $url
     * @param array $headers
     * @param array $data
     * @param array $params
     * @return array|string
     */
    public function post(string $namespace, string $keyword, string $url, array $headers, array $data, array $params = [], bool $cache = false)
    {
        if ($cache) {
            if ($cacheData = $this->logRepository->where('namespace', $namespace)->where('keyword', $keyword)->first()) {
                return $this->response(true, json_decode($cacheData->response, true));
            }
            $data = $this->postRequest($url, $headers, $data, $params);
            if (!$data['success']) {
                return $data;
            }
            $this->logRepository->create([
                'namespace' => $namespace,
                'keyword' => $keyword,
                'url' => $url,
                'params' => json_encode($params),
                'data' => '',
                'response' => json_encode($data['data'])
            ]);
            return $data;
        }
        return $this->postRequest($url, $headers, $data, $params);
    }

    /**
     * @param string $url
     * @param array $headers
     * @param array $data
     * @param array $params
     * @return array|string
     */
    public function put(string $namespace, string $keyword, string $url, array $headers, array $data, array $params = [], bool $cache = false)
    {
        if ($cache) {
            if ($cacheData = $this->logRepository->where('namespace', $namespace)->where('keyword', $keyword)->first()) {
                return $this->response(true, json_decode($cacheData->response, true));
            }
            $data = $this->putRequest($url, $headers, $data, $params);
            if (!$data['success']) {
                return $data;
            }
            $this->logRepository->create([
                'namespace' => $namespace,
                'keyword' => $keyword,
                'url' => $url,
                'params' => json_encode($params),
                'data' => '',
                'response' => json_encode($data['data'])
            ]);
            return $data;
        }
        return $this->putRequest($url, $headers, $data, $params);
    }


    public function response(bool $success, array $data, string $message = '', int $statusCode = 200): array
    {
        return [
            'success' => $success,
            'data' => $data,
            'message' => $message,
            'status_code' => $statusCode
        ];
    }

    public function Error(string $message, int $statusCode, array $data = []): array
    {
        return [
            'success' => false,
            'data' => $data,
            'message' => $message,
            'status_code' => $statusCode
        ];
    }

    public function exceptionError($e): string
    {
        return $e->getMessage . ' LINE: ' . $e->getLine();
    }

    public function retrieveUrl($url, $params): string
    {
        if (!empty($params)) {
            $url = $url . '?' . http_build_query($params);
        }
        return $url;
    }
}