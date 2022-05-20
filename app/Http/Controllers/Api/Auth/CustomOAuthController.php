<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\ApiResponse;
use App\Services\UsersService;use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;

class CustomOAuthController extends AccessTokenController
{

    /**
     * @var UsersService
     */
    private $usersService;
    /**
     * @var ApiResponse
     */
    private $apiResponse;

    public function __construct(AuthorizationServer $server, TokenRepository $tokens, JwtParser $jwt, UsersService $userService,ApiResponse $apiResponse)
    {
        $this->usersService = $userService;
        $this->apiResponse = $apiResponse;
        parent::__construct($server, $tokens, $jwt);
    }

    public function issueToken(ServerRequestInterface $request)
    {
        $token_response = parent::issueToken($request);
        $data = json_decode($token_response->getContent(),true);
        if ($request->getParsedBody()["grant_type"] == "refresh_token") {
            return $this->apiResponse->success("SUCCESSFULLY_REFRESHED_TOKEN")->setData($data)->return();
        }
        $username = $request->getParsedBody()['username'];
        $user = $this->usersService->getByUsername($username);
        $data['user'] = $user;
        return $this->apiResponse->success("SUCCESSFULLY_LOGGED_IN")->setData($data)->return();
    }
}
