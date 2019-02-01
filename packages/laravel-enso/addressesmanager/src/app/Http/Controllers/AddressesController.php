<?php

namespace LaravelEnso\AddressesManager\app\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelEnso\AddressesManager\app\Contracts\ValidatesAddressRequest;
use LaravelEnso\AddressesManager\app\Forms\Builders\AddressForm;
use LaravelEnso\AddressesManager\app\Http\Resources\Address as Resource;
use LaravelEnso\AddressesManager\app\Models\Address;

class AddressesController extends Controller
{
    public function index(ValidatesAddressRequest $request)
    {
        return Resource::collection(
                Address::for($request->validated())
                    ->ordered()
                    ->get()
            );
    }

    public function create(AddressForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidatesAddressRequest $request)
    {
        Address::create($request->all());

        return [
            'message' => __('The address was successfully created'),
        ];
    }

    public function edit(Address $address, AddressForm $form)
    {
        return ['form' => $form->edit($address)];
    }

    public function update(ValidatesAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return [
            'message' => __('The address have been successfully updated'),
        ];
    }

    public function setDefault(Address $address)
    {
        $address->setDefault();
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return ['message' => __('The address was deleted')];
    }
}
