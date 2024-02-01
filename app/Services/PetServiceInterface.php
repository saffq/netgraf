<?php
namespace App\Services;

use Illuminate\Http\Request;

interface PetServiceInterface
{
    public function getById($petId);
    public function getAllByStatus($status);
    public function addPet(Request $request);
    public function updatePet(Request $request, $petId);
    public function deletePet($petId);
}
