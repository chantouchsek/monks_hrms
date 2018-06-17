<?php

namespace App\Http\Controllers\Admin;

use App\Models\Village;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villages = Village::with('commune')->paginate(20);
        return view('admin.villages.index', [
            'villages' => $villages
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
     * @param  Village $village
     * @return \Illuminate\Http\Response
     */
    public function show(Village $village)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Village $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Village $village)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Village $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Village $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
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
            if (isset($row['name'], $row['kh_name'], $row['commune_id'], $row['code'])) {
                Village::create([
                    'name' => $row['name'],
                    'commune_id' => $row['commune_id'],
                    'code' => $row['code'],
                    'kh_name' => $row['kh_name']
                ]);
            }
        }

        return redirect()->back();
    }
}
