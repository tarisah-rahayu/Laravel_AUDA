<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PesanResource extends JsonResource
{
    public $status;
    public $pesan1;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function __construct($status, $pesan1, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->pesan1 = $pesan1;
    }
    public function toArray($request)
    {
        return [
            'sukses' => $this->status,
            'pesan' => $this->pesan1,
            'data' => $this->resource,
        ];
    }
}
