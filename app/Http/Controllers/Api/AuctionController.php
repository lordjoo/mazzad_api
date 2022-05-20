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
        $data["user_id"] = auth()->user()->id;
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
            $newData = $this->service->editUserAuction($id, $newData,auth()->user()->id);
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
            $data = $this->service->get($request->query())->cursorPaginate($limit);
            return $this->apiResponse->success("DATA_HAS_BEEN_FETCHED", $data)->return();
        } catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function search(Request $request)
    {
        try {
            $limit = $request->query("limit") ?? 15;
            $search = $request->query("search");
            $data = $this->service->search($search, $limit);
            return $this->apiResponse->success("DATA_HAS_BEEN_FETCHED", $data)->return();
        } catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function getAuctionByCategory($category_id)
    {
        try {
            $categories = $this->service->getAuctionByCategory($category_id);
            return $this->apiResponse->success("FOUND_THE_AUCTIONS", $categories)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function searchForAuction(Request $request)
    {
        $name = $request->query("search");
        // http://url/{parms}?search=samsung
        try {
            $result = $this->service->searchForAuction($name);
            return $this->apiResponse->success("FOUND_THE_AUCTIONS", $result)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

}
