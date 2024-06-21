<?php

namespace App\Http\Controllers;

use App\Models\CompanyScale;
use App\Models\Customer;
use App\Models\IndustriType;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['industriType', 'companyScale'])->get();
        return response()->json($customers);
    }

    public function create()
    {
        return response()->json([
            'industri_types' => IndustriType::all(),
            'company_scales' => CompanyScale::all(),
        ]);
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customer::with(['industriType', 'companyScale', 'detailCustomers.title', 'detailCustomers.occupation'])->findOrFail($id);
        return response()->json($customer);
    }

    public function edit($id)
    {
        $customer = Customer::with(['industriType', 'companyScale'])->findOrFail($id);
        return response()->json([
            'customer' => $customer,
            'industri_types' => IndustriType::all(),
            'company_scales' => CompanyScale::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(null, 204);
    }
}
