<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDescriptionRequest;
use App\Http\Requests\UpdateDescriptionRequest;
use Illuminate\Http\Request;
use App\Models\Description;
use App\Models\DescriptionCategory;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Description::where('commit', true)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDescriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDescriptionRequest $request)
    {

        $description = [
            'description' => $request->description,
            'note' => $request->note,
            'position' => $request->position,
            'commit' => false,
            'reference_id' => $request->reference_id,
            'author_id' => $request->author_id
        ];
        return Description::create($description);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Description::find($id);
    }

    /**
     * mostra todas as descriptions não comitadas.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUncommited()
    {
        return Description::where('commit', false)->paginate();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDescriptionRequest  $request
     * @param  \App\Models\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDescriptionRequest $request)
    {
        $description = Description::find($request->id);
        $description->description = $request->description;
        $description->note = $request->note;
        $description->position = $request->position;
        $description->commit = true;
        $description->reference_id = $request->reference_id;
        $description->author_id = $request->author_id;
        return $description->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Description  $description
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Description::destroy($id);
    }

    public function storeCategory(Request $request)
    {
        return DescriptionCategory::create(
            [ 'description_id' => $request->description_id, 'category_id' => $request->category_id ]
        );
    }

    public function searchCategory($id)
    {
        return Description::find($id)->categories()->orderBy('name')->get();
    }
}
