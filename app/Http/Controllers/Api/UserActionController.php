<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\UserAction;
use App\Services\UserActionService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserActionController extends Controller
{

    /**
     * @var UserActionService
     */
    protected $service;

    /**
     * @var ApiResponse
     */
    private $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->service = new UserActionService();
        $this->apiResponse = $apiResponse;
    }

    public function recordAction(Request $request)
    {
        $request->validate([
            "auction_id" => "required|integer|exists:auctions,id",
            "action" => ["required",Rule::in(array_keys(UserAction::$ACTIONS))],
        ]);
        try {
            $this->service->recordAction($request->auction_id, $request->action);
            return $this->apiResponse->success("ACTION_REGISTERED")->return();
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage())->return();
        }
    }
}
