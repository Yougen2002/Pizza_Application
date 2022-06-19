<?php

namespace App\Http\Controllers;

use App\Models\typeofpizza;
use App\Http\Requests\StoretypeofpizzaRequest;
use App\Http\Requests\UpdatetypeofpizzaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class TypeofpizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('typeofpizza.index', [
            'typeofpizzas' => typeofpizza::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretypeofpizzaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretypeofpizzaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\typeofpizza  $typeofpizza
     * @return \Illuminate\Http\Response
     */
    public function show(typeofpizza $typeofpizza)
    {
        return view('typeofpizza.show', [
            'typeofpizzas' => $typeofpizza,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\typeofpizza  $typeofpizza
     * @return \Illuminate\Http\Response
     */
    public function edit(typeofpizza $typeofpizza)
    {
        return view('typeofpizza.edit', [
            'typeofpizzas' => $typeofpizza,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetypeofpizzaRequest  $request
     * @param  \App\Models\typeofpizza  $typeofpizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, typeofpizza $typeofpizza)
    {


        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
        ]);

        $typeofpizza->update($validated);

        //check if an image exist
        if ($request->has('image')) {

            //check if the image is uploaded already and remove it
            if ($typeofpizza->image) {
                //delete the old image
                Storage::disk('public')->delete($typeofpizza->image);
            }



            // saving the file and get the path
            $path = $request->file('image')->store('image/' . $typeofpizza->id, 'public');
            // update the image field
            $typeofpizza->update([
                'image' => $path
            ]);
        }
        // set the success message to the session
        session()->flash('success', 'Types of pizza was updated successfully');

        // redirect to user page
        return redirect()->route('typeofpizzas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\typeofpizza  $typeofpizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(typeofpizza $typeofpizza)
    {
        //
    }
}
