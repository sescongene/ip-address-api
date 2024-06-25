<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIPAddressRequest;
use App\Http\Requests\UpdateIPAddressRequest;
use App\Http\Resources\IPAddressResource;
use App\Models\IPAddress;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class IPAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ip_addresses = QueryBuilder::for(IPAddress::class)
            ->allowedFilters('ip_address')
            ->paginate();

        return IPAddressResource::collection($ip_addresses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIPAddressRequest $request)
    {
        $ip_address = IPAddress::create(
            $request->validated()
        );
        return IPAddressResource::make($ip_address);
    }

    /**
     * Display the specified resource.
     */
    public function show(IPAddress $ip_address)
    {

        return IPAddressResource::make($ip_address);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IPAddress $iPAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIPAddressRequest $request, IPAddress $ip_address)
    {
        $ip_address->update($request->validated());
        return IPAddressResource::make($ip_address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IPAddress $iPAddress)
    {
        //
    }
}
