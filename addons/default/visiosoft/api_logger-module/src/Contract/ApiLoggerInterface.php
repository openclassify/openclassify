<?php

namespace Visiosoft\ApiLoggerModule\Contract;

use phpseclib3\Math\PrimeField\Integer;

interface ApiLoggerInterface
{

    public function getRequest(string $url, array $headers, array $params);

    public function postRequest(string $url, array $headers, array $data, array $params = []);

    public function putRequest(string $url, array $headers, array $data, array $params = []);

    public function get(string $namespace, string $keyword, string $url, array $headers, array $params, bool $cache = false);

    public function post(string $namespace, string $keyword, string $url, array $headers, array $data, array $params = [], bool $cache = false);

    public function put(string $namespace, string $keyword, string $url, array $headers, array $data, array $params = [], bool $cache = false);

    public function response(bool $success, array $data, string $message = '', int $statusCode = 200): array;

    public function Error(string $message, int $statusCode, array $data = []): array;

    public function exceptionError($e): string;

    public function retrieveUrl($url, $params): string;
}