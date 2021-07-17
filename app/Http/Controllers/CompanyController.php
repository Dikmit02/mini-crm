<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;
use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index')->with('companies', Company::all());
        // return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request, Company $company)
    {
        // $storagePath = Storage::disk('public')->put('logos', $request->logo);

    //     $storageName = basename($storagePath);
        $image = $request->image->store('company');

        $validatedData = [
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $image,
            'website' => $request->website
        ];

        $company->create($validatedData);

        return redirect()->route('companies.index')
                ->with('success', 'Company successfully created!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        // return view('companies.show')->with('company', $company);
        return view('companies.show', compact('company'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // return view('companies.edit')->with('company', $company);
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, Company $company)
    {
        // $storagePath = Storage::disk('public')->put('logos', $request->logo);

        //     $storageName = basename($storagePath);

        $image = $request->image->store('company');

        $validatedData = [
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $image,
            'website' => $request->website
        ];

        $company->update($validatedData);

        return redirect()->route('companies.index')
            ->with('success', 'Company successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company successfully deleted!');
    }
}
