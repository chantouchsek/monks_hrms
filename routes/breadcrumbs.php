<?php

use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;

try {
    Breadcrumbs::register('home', function (BreadcrumbsGenerator $breadcrumbs) {
        $breadcrumbs->push(trans('labels.admin.titles.home'), route('home'));
    });
} catch (\DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e) {
    //
}

// Countries
try {
    Breadcrumbs::for('admin.countries.index', function ($trail) {
        $trail->parent('home');
        $trail->push('Countries', route('admin.countries.index'));
    });
} catch (\DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e) {
}

// Countries > Add Photo
try {
    Breadcrumbs::for('admin.countries.create', function ($trail) {
        $trail->parent('admin.countries.index');
        $trail->push('Add Country', route('admin.countries.create'));
    });
} catch (\DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e) {
}

// Countries > [Countries Name]
try {
    Breadcrumbs::for('admin.countries.show', function ($trail, $photo) {
        $trail->parent('admin.countries.index');
        $trail->push($photo->title, route('admin.countries.show', $photo->id));
    });
} catch (\DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e) {
}

// Countries > [Countries Name] > Edit Countries
try {
    Breadcrumbs::for('admin.countries.edit', function ($trail, $country) {
        $trail->parent('admin.countries.index', $country);
        $trail->push('Edit Country', route('admin.countries.edit', $country->id));
    });
} catch (\DaveJamesMiller\Breadcrumbs\Exceptions\DuplicateBreadcrumbException $e) {
}