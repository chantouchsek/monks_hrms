<?php

namespace App\Http\Controllers\Admin;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::with('country')->paginate(20);
        return view('admin.provinces.index', [
            'provinces' => $provinces
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
     * @param  Province $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Province $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Province $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Province $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
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
            if (isset($row['name'], $row['kh_name'], $row['country_id'], $row['code'])) {
                Province::create([
                    'name' => $row['name'],
                    'country_id' => $row['country_id'],
                    'code' => $row['code'],
                    'kh_name' => $row['kh_name']
                ]);
            }
        }

        return redirect()->back();
    }
}
