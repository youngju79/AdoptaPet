<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function add($id)
    {
        $favorite = new Favorite();
        $favorite->pet_id = $id;
        $favorite->user_id = Auth::user()->id;
        $favorite->save();

        $pet = Pet::find($id);
        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully favorited pet with name '{$pet->name}'");
    }
    public function remove($id)
    {
        $favorite = Favorite::find($id);
        $pet = Pet::find($favorite->pet_id);
        $favorite->delete();

        $successMsg = $pet != null ? "Successfully removed pet with name '{$pet->name}' from favorites" : "Successfully removed pet from favorites";
        return redirect()
            ->route('profile.index')
            ->with('success', $successMsg);
    }
}
