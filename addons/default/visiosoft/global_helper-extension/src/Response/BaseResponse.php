<?php

namespace Visiosoft\GlobalHelperExtension\Response;
abstract class BaseResponse
{
    protected bool $success;
    protected ?string $message;
    protected ?array $data;
    private ?string $errorCode;

    public function __construct(bool $success, ?string $message = null, ?array $data = null, ?string $errorCode = null)
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->errorCode = $errorCode;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setErrorCode(string $errorCode): void
    {
        $this->errorCode = $errorCode;
    }
}

