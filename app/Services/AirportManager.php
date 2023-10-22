<?php

namespace App\Services;

use App\Models\Airport;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AirportManager
{
    public function createAirport(Request $request)
    {
        DB::transaction(function () use ($request) {
            $airport = new Airport($request->all());
            $airport->save();

            if ($request->name_translations && count($request->name_translations) > 0) {
                $this->createTranslations($airport, $request->name_translations);
            }
        });
    }

    public function updateAirport(Airport $airport, Request $request)
    {
        DB::transaction(function () use ($request, $airport) {
            $airport->update($request->all());

            $airport->translations()->delete();

            if ($request->name_translations && count($request->name_translations) > 0) {
                $this->createTranslations($airport, $request->name_translations);
            }
        });
    }

    public function findByCoordinates(float $latitude, float $longitude, string $sort = 'ASC'): Collection
    {
        $boundaries = $this->getSquareCoordinates($latitude, $longitude);

        return Airport::with('translations')
            ->whereBetween('latitude', [$boundaries['minLatitude'], $boundaries['maxLatitude']])
            ->whereBetween('longitude', [$boundaries['minLongitude'], $boundaries['maxLongitude']])
            ->orderBy('latitude', $sort)
            ->orderBy('longitude', $sort)
            ->limit(5)
            ->get();
    }

    public function findByName(string $name): Collection
    {
        $airports = Airport::whereName($name)->get();

        $airportsFromTranslations = Translation::whereText($name)
            ->with('airport')
            ->get()
            ->map(function (Translation $translation) {
                return $translation->airport;
            });

        return $airports->union($airportsFromTranslations)->load('translations');
    }

    public function findDefault(): Collection
    {
        return Airport::with('translations')->limit(5)->get();
    }

    private function createTranslations(Airport $airport, array $translations): void
    {
        foreach ($translations as $translation) {
            Translation::create([
                'airport_id' => $airport->id,
                'language' => substr($translation['language'], 0, 2),
                'text' => $translation['text'],
            ]);
        }
    }

    /**
     * Count boundaries of square area on the map around the input point.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $distance in kilometers
     * @return array
     */
    private function getSquareCoordinates(float $latitude, float $longitude, int $distance = 100)
    {
        // Earth radius in kilometers
        $earthRadius = 6371;

        // Calculate the angular distance
        $angularDistance = $distance / $earthRadius;

        // Calculate the latitude and longitude boundaries
        $minLatitude = $latitude - rad2deg($angularDistance);
        $maxLatitude = $latitude + rad2deg($angularDistance);

        // Correct for the poles
        $minLatitude = max($minLatitude, -90);
        $maxLatitude = min($maxLatitude, 90);

        $deltaLongitude = asin(sin($angularDistance) / cos(deg2rad($latitude)));

        $minLongitude = $longitude - rad2deg($deltaLongitude);
        $maxLongitude = $longitude + rad2deg($deltaLongitude);

        // Correct for the 180th meridian
        if ($minLongitude < -180) {
            $minLongitude += 360;
        }
        if ($maxLongitude > 180) {
            $maxLongitude -= 360;
        }

        return [
            'minLatitude' => $minLatitude,
            'maxLatitude' => $maxLatitude,
            'minLongitude' => $minLongitude,
            'maxLongitude' => $maxLongitude,
        ];
    }
}

