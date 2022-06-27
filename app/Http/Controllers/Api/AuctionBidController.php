<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\AuctionBidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionBidController extends Controller
{
    public $service;
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->service = new AuctionBidService();
        $this->apiResponse = $apiResponse;
    }

    public function placeBid($auction_id, $amount)
    {
        try {
            $data = [
                "price" => $amount,
                "auction_id" => $auction_id,
                "user_id" => Auth::user()->id
            ];
            $result = $this->service->placeBid($data);
            return $this->apiResponse->success("BID_PLACED!", $result)->return();
        } catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function getBids($auction_id)
    {
        try {
            $data = $this->service->getBids($auction_id);
            return $this->apiResponse->success("BIDS_FETCHED_SUCCESSFULLY", $data)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

    public function getMaxBid($auction_id)
    {
        try {
            $data = $this->service->getMaxBid($auction_id);
            return $this->apiResponse->success("MAX_BID_FETCHED_SUCCESSFULLY", $data)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }

}
