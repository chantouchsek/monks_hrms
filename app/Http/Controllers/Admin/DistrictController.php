<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::with('province')->paginate(20);
        return view('admin.districts.index', [
            'districts' => $districts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  District $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  District $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  District $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  District $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
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
            if (isset($row['name'], $row['kh_name'], $row['province_id'], $row['code'])) {
                District::create([
                    'name' => $row['name'],
                    'province_id' => $row['province_id'],
                    'code' => $row['code'],
                    'kh_name' => $row['kh_name']
                ]);
            }
        }

        return redirect()->back();
    }
}
