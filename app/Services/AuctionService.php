<?php

namespace App\Services;
use App\Http\Resources\User\UserResource;
use App\Models\Auction;
use App\Models\Category;


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

    public function getAuctionByCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        return $category->auctions()->get();
    }

    public function create(array $data)
    {
        return Auction::create($data);
    }

    public function editUserAuction($id, array $newData,$user_id)
    {
        $result = Auction::findOrFail($id);
        return $auction->update($newData);
    }

    public function delete($auctionId)
    {
        Auction::where('id', $auctionId)->delete();
    }

    public function searchForAuction($name)
    {
        return Auction::where('name', 'LIKE', "%".$name."%")->get();
    }

    public function search($query,$limit = 15)
    {
        return Auction::where("name","LIKE","%$query%")
            ->orWhere("description","LIKE","%$query%")
            ->orWhere("keywords","LIKE","%$query%")
            ->cursorPaginate();
    }


}
