<?php

namespace App\Services;
use App\Http\Resources\User\UserResource;
use App\Models\Auction;
use App\Models\Category;


Class AuctionService
{

    public function get()
    {
        return Auction::all();
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

}
