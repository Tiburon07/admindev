<?php
declare(strict_types=1);

namespace app\classes;

use JsonSerializable;

class Payload implements JsonSerializable {
    private $statusCode;
    private $data;
    private $error;

    public function __construct( int $statusCode = 200, $data = null, ?Error $error = null) {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->error = $error;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode) {
        $this->statusCode = $statusCode;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data){
        $data = (array) $data;
        if(count($data) == 1 && array_key_exists(0,$data))
            $data = $data[0];
        $this->data = $data;
    }

    public function setError(Error $error){
        $this->error = $error;
    }

    public function getError(): Error {
        return $this->error;
    }

    public function jsonSerialize()
    {
        $payload = [
            'statusCode' => $this->statusCode,
        ];

        if ($this->data !== null) {
            $payload['data'] = $this->data;
        } elseif ($this->error !== null) {
            $payload['error'] = $this->error;
        }

        return $payload;
    }
}
