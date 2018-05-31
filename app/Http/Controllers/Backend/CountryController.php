<?php

namespace App\Http\Controllers\Backend;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Utils\RequestSearchQuery;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\Contracts\CountryRepository;

class CountryController extends BackendController
{
    /**
     * @var CountryRepository
     */
    protected $countries;

    /**
     * Create a new controller instance.
     *
     * @param CountryRepository $countries
     */
    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function search(Request $request)
    {
        $query = $this->countries->query();

        $requestSearchQuery = new RequestSearchQuery($request, $query, [
            'name',
            'kh_name',
            'description',
        ]);

        if ($request->get('exportData')) {
            return $requestSearchQuery->export([
                'route',
                'name',
                'kh_name',
                'description',
                'created_at',
                'updated_at',
            ],
                [
                    __('validation.attributes.route'),
                    __('validation.attributes.metable_type'),
                    __('validation.attributes.title'),
                    __('validation.attributes.description'),
                    __('labels.created_at'),
                    __('labels.updated_at'),
                ],
                'countries');
        }

        return $requestSearchQuery->result([
            'countries.id',
            'route',
            'name',
            'kh_name',
            'description',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * @param Country $country
     *
     * @return Country
     */
    public function show(Country $country)
    {
        return $country;
    }

    /**
     * @param StoreCountryRequest $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreCountryRequest $request)
    {
        $this->authorize('create countries');

        $this->countries->store($request->input());

        return $this->redirectResponse($request, __('alerts.backend.countries.created'));
    }

    /**
     * @param Country $country
     * @param UpdateCountryRequest $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Country $country, UpdateCountryRequest $request)
    {
        $this->authorize('edit metas');

        $this->countries->update($country, $request->input());

        return $this->redirectResponse($request, __('alerts.backend.countries.updated'));
    }

    /**
     * @param Country $country
     * @param Request $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Country $country, Request $request)
    {
        $this->authorize('delete countries');

        $this->countries->destroy($country);

        return $this->redirectResponse($request, __('alerts.backend.countries.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');

        switch ($action) {
            case 'destroy':
                $this->authorize('delete countries');

                $this->countries->batchDestroy($ids);

                return $this->redirectResponse($request, __('alerts.backend.countries.bulk_destroyed'));
                break;
        }

        return $this->redirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }
}
