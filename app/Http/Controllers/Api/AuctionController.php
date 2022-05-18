<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AuctionRequest;
use App\Services\AuctionService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;


class AuctionController extends Controller
{

    /**
     * @var AuctionService
     */
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    private AuctionService $service;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->service = new AuctionService();
        $this->apiResponse = $apiResponse;
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(AuctionRequest $request)
    {
        $data = $request->validated();
        $data["seller_id"] = auth()->user()->id;
        try {
            $auction = $this->service->create($data);
            return $this->apiResponse->success("AUCTION_CREATED_SUCCESSFULLY!")->setData($auction)->return();
        } catch (\Exception $exception) {
            return $this->apiResponse->error($exception->getMessage())->return();
        }

    }

    public function edit($id, AuctionRequest $request)
    {
        $newData = $request->validated();
        try {
            $newData = $this->service->edit($id, $newData);
            return $this->apiResponse->success("AUCTION_UPDATED_SUCCESSFULLY")->setData($newData)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function delete($id)
    {
        try {
            $this->service->delete($id);
            return $this->apiResponse->success("AUCTION_DELETED_SUCCESSFULLY!")->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function get(Request $request)
    {
        try {
            $limit = $request->query("limit") ?? 15;
            $data = $this->service->paginate($limit);
            return $this->apiResponse->success("DATA_HAS_BEEN_FETCHED", $data)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }
}
