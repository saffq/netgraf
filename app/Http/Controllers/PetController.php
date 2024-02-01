<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetServiceInterface;

class PetController extends Controller

{
    private $petService;

    public function __construct(\App\Services\PetService $petService)
    {
        $this->petService = $petService;
    }


    public function index()
    {
        $pets = $this->petService->getAllByStatus('available');
        return view('pets.index', compact('pets'));
    }

    public function show($petId)
    {
        $pet = $this->petService->getById($petId);
        return view('pets.show', compact('pet'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        return $this->petService->addPet($request);
    }

    public function edit($petId)
    {
        $pet = $this->petService->getById($petId);
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $petId)
    {
        return $this->petService->updatePet($request, $petId);
    }

    public function destroy($petId)
    {
        return $this->petService->deletePet($petId);
    }
}
