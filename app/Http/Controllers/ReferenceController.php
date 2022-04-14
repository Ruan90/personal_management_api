<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReferenceRequest;
use App\Http\Requests\UpdateReferenceRequest;
use App\Models\Reference;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reference::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReferenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReferenceRequest $request)
    {
        return Reference::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Reference::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReferenceRequest  $request
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReferenceRequest $request)
    {
        $reference = Reference::find($request->id);
        $reference->source = $request->source;
        $reference->note = $request->note;
        $reference->author_id = $request->author_id;
        return $reference->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Reference::destroy($id);
    }
}
