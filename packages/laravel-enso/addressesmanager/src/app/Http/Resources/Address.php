<?php

namespace LaravelEnso\AddressesManager\app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'country'               => $this->whenLoaded('country', $this->country->name),
            'town'                  => $this->town,
            'number'                => $this->number,
            'address1'              => $this->address1,
            'address2'              => $this->address2,
            'postCode'              => $this->post_code,
            'county'                => $this->county,
            'notes'                 => $this->notes,
            'isDefault'             => $this->is_default,
        ];
    }
}
