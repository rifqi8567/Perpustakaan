<?php

namespace App\Http\Controllers;

use App\Models\createbuku;
use App\Http\Requests\StorecreatebukuRequest;
use App\Http\Requests\UpdatecreatebukuRequest;

class CreatebukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecreatebukuRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(createbuku $createbuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(createbuku $createbuku)
    {
        return view('books.editindex');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecreatebukuRequest $request, createbuku $createbuku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(createbuku $createbuku)
    {
        //
    }
}
