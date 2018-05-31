<?php

namespace App\Repositories;

use Exception;
use App\Exceptions\GeneralException;
use App\Models\Country;
use App\Repositories\Contracts\CountryRepository;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Class EloquentCountryRepository.
 */
class EloquentCountryRepository extends EloquentBaseRepository implements CountryRepository
{
    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * EloquentCountryRepository constructor.
     *
     * @param Country $country
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     */
    public function __construct(Country $country, LaravelLocalization $localization)
    {
        parent::__construct($country);
        $this->localization = $localization;
    }

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return $this->query()->whereSlug($slug)->first();
    }

    /**
     * @param array $input
     *
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Country
     */
    public function store(array $input)
    {
        /** @var Country $country */
        $country = $this->make($input);

        if ($this->findBySlug($country->slug)) {
            throw new GeneralException(__('exceptions.backend.countries.already_exist'));
        }

        if (!$country->save()) {
            throw new GeneralException(__('exceptions.backend.countries.create'));
        }

        return $country;
    }

    /**
     * @param Country $country
     * @param array $input
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Country
     */
    public function update(Country $country, array $input)
    {
        if ($country->slug) {
            $existingCountry = $this->findBySlug($country->slug);

            if ($existingCountry->id !== $country->id) {
                throw new GeneralException(__('exceptions.backend.countries.already_exist'));
            }
        }

        if (!$country->update($input)) {
            throw new GeneralException(__('exceptions.backend.countries.update'));
        }

        return $country;
    }

    /**
     * @param Country $country
     *
     * @throws \Exception|\Throwable
     *
     * @return bool|null
     */
    public function destroy(Country $country)
    {
        if (!$country->delete()) {
            throw new GeneralException(__('exceptions.backend.countries.delete'));
        }

        return true;
    }

    /**
     * @param array $ids
     *
     * @throws \Exception|\Throwable
     *
     * @return mixed
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            // This wont call eloquent events, change to destroy if needed
            if ($this->query()->whereIn('id', $ids)->delete()) {
                return true;
            }

            throw new GeneralException(__('exceptions.backend.countries.delete'));
        });

        return true;
    }
}
