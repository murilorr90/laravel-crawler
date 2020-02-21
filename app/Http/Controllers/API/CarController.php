<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CarDetailRequest;
use App\Http\Requests\CarRequest;
use App\Services\CrawlerService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/**
 * Class CarController
 * @package App\Http\Controllers\API
 */
class CarController extends BaseController
{
    /**
     * List cars.
     *
     * @param CarRequest $request
     * @return JsonResponse
     *
     * @group Cars
     * @queryParam marca (string) Brand of the car.
     * @queryParam modelo (string) Model of the car.
     * @queryParam ano_min (integer) Minimum Year.
     * @queryParam ano_max (integer) Maximum Year.
     * @queryParam preco_min (integer) Minimum Price.
     * @queryParam preco_max (integer) Maximum Price.
     * @queryParam km_min (integer) Minimum Odometer.
     * @queryParam km_max (integer) Maximum Odometer.
     * @queryParam page (integer) Page.
     */
    public function index(CarRequest $request)
    {
        $filters = $request->query();

        $crawlerService = new CrawlerService($filters);
        $response = $crawlerService->getCars();

        return $this->sendResponse($response);
    }

    /**
     * Show car details.
     *
     * @param int $id
     * @return JsonResponse
     *
     * @group Cars
     * @urlParam id required (integer) The id of the car.
     */
    public function show(int $id)
    {
        if (!is_int($id)) {
            return $this->sendError('Not a valid input.');
        }

        $crawlerService = new CrawlerService();
        $response = $crawlerService->getCarDetail($id);

        if (empty($response)) {
            return $this->sendError('Id not found.');
        }

        return $this->sendResponse($response);
    }
}
