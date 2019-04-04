<?php

namespace App\Http\Controllers;

use App\Filters\SchoolFilter;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use App\Http\Resources\SchoolResource;
use App\School;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class SchoolController
 *
 * @package App\Http\Controllers
 */
class SchoolController extends Controller
{
    /**
     * Return an optionally filtered list of all Schools with Products
     *
     * @param \App\Filters\SchoolFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function showAllSchools(SchoolFilter $filter): AnonymousResourceCollection
    {
        return SchoolResource::collection(School::with('products')->filter($filter)->get());
    }

    /**
     * Return an optionally filtered list of all Schools
     * as a CSV stream without Products
     *
     * @param \App\Filters\SchoolFilter $filter
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportAllSchools(SchoolFilter $filter): StreamedResponse
    {
        $columns = ['id', 'name', 'city', 'state', 'zip', 'circulation'];
        $schools = School::filter($filter)->select($columns)->get();

        return $this->prepareCSVDownload($schools->toArray(), $columns);
    }

    /**
     * Retrieve an existing School by id
     *
     * @param \App\School $school
     * @return \App\Http\Resources\SchoolResource
     */
    public function show(School $school): SchoolResource
    {
        return new SchoolResource($school);
    }

    /**
     * Create a new School from parameters
     *
     * @param \App\Http\Requests\School\CreateSchoolRequest $request
     * @return \App\Http\Resources\SchoolResource
     */
    public function store(CreateSchoolRequest $request): SchoolResource
    {
        return new SchoolResource(School::create($request->all()));
    }

    /**
     * Update an existing School by id and parameters
     *
     * @param \App\School $school
     * @param \App\Http\Requests\School\UpdateSchoolRequest $request
     * @return \App\Http\Resources\SchoolResource
     */
    public function update(School $school, UpdateSchoolRequest $request): SchoolResource
    {
        $school->update($request->all());
        return new SchoolResource($school);
    }

    /**
     * Delete an existing School by id
     *
     * @param \App\School $school
     * @return array
     * @throws \Exception
     */
    public function destroy(School $school): array
    {
        return [
            'deleted' => $school->delete(),
        ];
    }
}
