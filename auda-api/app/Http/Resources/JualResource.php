<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JualResource extends JsonResource
{
    public $status;
    public $pesan;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function __construct($status, $pesan, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->pesan = $pesan;
    }
    public function toArray($request)
    {
        return [
            'sukses' => $this->status,
            'pesan' => $this->pesan,
            'data' => $this->resource,
        ];
    }
}
