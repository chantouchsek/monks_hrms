<?php

namespace App\Repositories\Contracts;

use App\Models\Country;

/**
 * Interface CountryRepository.
 */
interface CountryRepository extends BaseRepository
{
    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param Country $country
     * @param array $input
     *
     * @return mixed
     */
    public function update(Country $country, array $input);

    /**
     * @param Country $country
     *
     * @return mixed
     */
    public function destroy(Country $country);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);
}
