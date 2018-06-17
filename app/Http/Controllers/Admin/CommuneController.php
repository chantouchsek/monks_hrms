<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes = Commune::with('district')->paginate(20);
        return view('admin.communes.index', [
            'communes' => $communes
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
     * @param  Commune $commune
     * @return \Illuminate\Http\Response
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Commune $commune
     * @return \Illuminate\Http\Response
     */
    public function edit(Commune $commune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Commune $commune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commune $commune)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Commune $commune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commune $commune)
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
            if (isset($row['name'], $row['kh_name'], $row['district_id'], $row['code'])) {
                Commune::create([
                    'name' => $row['name'],
                    'district_id' => $row['district_id'],
                    'code' => $row['code'],
                    'kh_name' => $row['kh_name']
                ]);
            }
        }

        return redirect()->back();
    }
}
