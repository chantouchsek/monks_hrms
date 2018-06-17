<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use Illuminate\Support\Facades\Input;
use League\Csv\Reader;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Input::get('limit')) {
            $this->setPagination(Input::get('limit'));
        }

        $countries = Country::with('provinces')->paginate(20);
        return view('admin.countries.index', [
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $country = new Country($request->all());
        $country->save();
        return redirect()->route('admin.countries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('admin.countries.edit', [
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest $request
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Country $country)
    {
        $country->fill($request->all());
        $country->save();
        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @throws \League\Csv\Exception
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        //$this->authorize('create metas');
        $this->validate($request, [
            'import' => 'required',
        ]);

        $csv = Reader::createFromFileObject($request->file('import')->openFile())
            ->setHeaderOffset(0)
            ->setDelimiter(',');

        foreach ($csv as $row) {
            if (isset($row['name'], $row['kh_name'])) {
                Country::create([
                    'name' => $row['name'],
                    'kh_name' => $row['kh_name'],
                    'description' => $row['description'],
                    'status' => $row['status']
                ]);
            }
        }

        return redirect()->back();
    }
}
