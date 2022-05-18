<?php

namespace App\Services;
use App\Http\Resources\User\UserResource;
use App\Models\Auction;


Class AuctionService
{

    public function get($query = [])
    {
        $searchable = [
            'name',
            'start_date',
            'end_date',
            "type"
        ];
        $auctions = Auction::query();
        foreach ($searchable as $key) {
            if (isset($query[$key]) && $query[$key] != '') {
                $auctions = $auctions->where($key,$query[$key]);
            }
        }
        return $auctions;
    }

    public function paginate($limit = 15)
    {
        return Auction::cursorPaginate($limit);
    }

    public function create(array $data)
    {
        return Auction::create($data);
    }

    public function editUserAuction($id, array $newData,$user_id)
    {
        $auction = Auction::where('id',$id)->where('user_id',$user_id)->first();
        if(!$auction) {
            throw new \Exception('Auction not found');
        }
        return $auction->update($newData);
    }

    public function delete($auctionId)
    {
        Auction::where('id', $auctionId)->delete();
    }

    public function getById($id)
    {
        return Auction::findOrFail($id);
    }

    public function search($query,$limit = 15)
    {
        return Auction::where("name","LIKE","%$query%")
            ->orWhere("description","LIKE","%$query%")
            ->orWhere("keywords","LIKE","%$query%")
            ->cursorPaginate();
    }


}
