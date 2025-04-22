<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    // custom properties
    public $status;
    public $message;
    public $resource;
    public $token;

    public function __construct($status, $message, $resource, $token = null)
    {
        parent::__construct($resource);
        $this->status   = $status;
        $this->message  = $message;
        $this->token    = $token;
    }

    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ],
            'token' => $this->token,
        ];
    }
}
