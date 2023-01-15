<?php

namespace App\Constants;

class HttpStatus {
    public const OK = 200;
    public const CREATED = 201;
    public const NO_CONTENT = 204;

    public const MOVED_PERMANENTLY = 301;
    public const FOUND = 302;
    public const SEE_OTHER = 303;
    public const NOT_MODIFIED = 304;

    public const BAD_REQUEST = 400;
    public const BAD_REQUEST_TOKEN = 419;
    public const UNAUTHORIZED = 401;
    public const PAYMENT_REQUIRED = 402;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const UNPROCESSABLE_ENTITY = 422;
    public const LOCKED = 423;
    public const TOO_MANY_REQUESTS = 429;

    public const INTERNAL_SERVER_ERROR = 500;

    public const DEFAULT_MESSAGE = "Success";
    public const DEFAULT_PAYLOAD = [];
}