<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CarDetailRequest;
use App\Http\Requests\CarRequest;
use App\Services\CrawlerService;
use Illuminate\Http\JsonResponse;

/**
 * Class CarController
 * @package App\Http\Controllers\API
 */
class CarController extends BaseController
{
    /**
     * Display a listing of all items.
     *
     * @param CarRequest $request
     * @return JsonResponse
     */
    public function index(CarRequest $request)
    {
        $filters = $request->query();

        $crawlerService = new CrawlerService($filters);
        $response = $crawlerService->getCars();

        return $this->sendResponse($response);
    }

    /**
     * Display a detail of a item.
     *
     * @param int $id
     * @return JsonResponse
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
