<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Services\AirportManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AirportController extends Controller
{
    private const VALIDATION_RULES = [
        'name' => 'required|min:3|max:60',
        'iata_code' => 'required|min:3|max:3',
        'latitude' => 'required|numeric|between:-90,90',
        'longitude' => 'required|numeric|between:-180,180',
        'description' => 'required||min:100|max:500',
        'terms_and_conditions' => 'min:100|max:500',
    ];

    /**
     * @param Request $request
     * @param AirportManager $manager
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request, AirportManager $manager)
    {
        if ($name = $request->get('name')) {
            return response()->json(['airports' => $manager->findByName($name)]);
        }

        if ($latitude = $request->get('latitude') && $longitude = $request->get('longitude')) {
            $sort = $request->get('sort');
            return response()->json(
                ['airports' => $manager->findByCoordinates($latitude, $longitude, $sort??'ASC')]
            );
        }

        return response()->json(['airports' => $manager->findDefault()]);
    }

    /**
     * @param int $airportId
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(int $airportId)
    {
        if (!$airport = Airport::with('translations')->find($airportId)) {
            return response()->json(
                ['errors' => Response::$statusTexts[Response::HTTP_NOT_FOUND]],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json($airport);
    }

    /**
     * @param Request $request
     * @param AirportManager $manager
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function create(Request $request, AirportManager $manager)
    {
        $validator = Validator::make($request->all(), self::VALIDATION_RULES);
        if ($validator->errors()->count()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $manager->createAirport($request);

        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * @param int $airportId
     * @param Request $request
     * @param AirportManager $manager
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function edit(int $airportId, Request $request, AirportManager $manager)
    {
        $validator = Validator::make($request->all(), self::VALIDATION_RULES);
        if ($validator->errors()->count()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        if (!$airport = Airport::find($airportId)) {
            return response()->json(
                ['errors' => Response::$statusTexts[Response::HTTP_NOT_FOUND]],
                Response::HTTP_NOT_FOUND
            );
        }

        $manager->updateAirport($airport, $request);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }

    /**
     * @param int $airportId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function delete(int $airportId)
    {
        if (!$airport = Airport::find($airportId)) {
            return response()->json(
                ['errors' => Response::$statusTexts[Response::HTTP_NOT_FOUND]],
                Response::HTTP_NOT_FOUND
            );
        }

        $airport->delete();
        $airport->translations()->delete();

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
