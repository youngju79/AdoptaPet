<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;
use App\Models\PetAge;
use App\Models\PetGender;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['gender', 'age'])->get();
        return view('pet.home-index', [
            'pets' => $pets
        ]);
    }
    public function show($id)
    {
        $pet = Pet::find($id);
        return view('pet.show', [
            'pet' => $pet
        ]);
    }
    public function add()
    {
        $ages = PetAge::orderBy('name')->get();
        $genders = PetGender::orderBy('name')->get();
        return view('pet.add', [
            'ages' => $ages,
            'genders' => $genders
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'breed' => 'required',
            'color' => 'required',
            'age' => 'required|exists:pet_ages,id',
            'gender' => 'required|exists:pet_genders,id',
            'url' => 'required|max:255'
        ]);

        $pet = new Pet();
        $pet->name = $request->input('name');
        $pet->breed = $request->input('breed');
        $pet->color = $request->input('color');
        $pet->age_id = $request->input('age');
        $pet->gender_id = $request->input('gender');
        $pet->user_id = Auth::user()->id;
        $pet->image_url = $request->input('url');
        $pet->save();
        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully listed pet with name '{$request->input('name')}'");
    }
    public function edit($id)
    {
        $pet = Pet::find($id);
        $ages = PetAge::orderBy('name')->get();
        $genders = PetGender::orderBy('name')->get();
        return view('pet.edit', [
            'ages' => $ages,
            'genders' => $genders,
            'pet' => $pet
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'breed' => 'required',
            'color' => 'required',
            'age' => 'required|exists:pet_ages,id',
            'gender' => 'required|exists:pet_genders,id',
            'url' => 'required|max:255'
        ]);

        $pet = Pet::find($id);
        $pet->name = $request->input('name');
        $pet->breed = $request->input('breed');
        $pet->color = $request->input('color');
        $pet->age_id = $request->input('age');
        $pet->gender_id = $request->input('gender');
        $pet->user_id = Auth::user()->id;
        $pet->image_url = $request->input('url');
        $pet->save();
        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully updated pet with name '{$request->input('name')}'");
    }
    public function remove($id)
    {
        $pet = Pet::find($id);
        $pet->delete();
        return redirect()
            ->route('profile.index')
            ->with('success', "Successfully removed pet with name '{$pet->name}'");
    }

}
