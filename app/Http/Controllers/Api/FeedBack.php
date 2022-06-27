<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\AuctionService;
use App\Services\FeedBackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedBack extends Controller
{
    private $apiResponse;

    private FeedBackService $service;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->service = new FeedBackService();
        $this->apiResponse = $apiResponse;
    }

    public function CreateFeedBack($message)
    {
        $data["message"] = $message;
        $data["user_id"] = Auth::user()->id;
        try {
            $FeedBack = $this->service->createFeedBack($data);
            return $this->apiResponse->success("FEED_BACK_CREATED_SUCCESSFULLY!")->setData($FeedBack)->return();
        }catch (\Exception $exception){
            return $this->apiResponse->error($exception->getMessage())->return();
        }
    }
}
