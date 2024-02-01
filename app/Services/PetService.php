<?php
namespace App\Services;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class PetService implements PetServiceInterface
{
    private $apiBaseUrl = 'https://petstore.swagger.io/v2/pet';

    public function getById($petId)
    {
        $client = new Client();
        $response = $client->get("$this->apiBaseUrl/$petId");
        $decodedResponse = json_decode($response->getBody(), true);

        if ($decodedResponse && isset($decodedResponse['id'])) {
            return $decodedResponse;
        } else {
            abort(404);
        }
    }

    public function getAllByStatus($status)
    {
        $client = new Client();
        $response = $client->get("$this->apiBaseUrl/findByStatus", [
            'query' => ['status' => $status],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function addPet(Request $request)
    {
        $validator = $this->validatePet($request);

        if ($validator->fails()) {
            return redirect()->route('pets.create')->withErrors($validator)->withInput();
        }

        $client = new Client();
        $response = $client->post($this->apiBaseUrl, [
            'json' => $request->all(),
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($response->getStatusCode() == 200 && isset($responseData['id']) && isset($responseData['status']) && $responseData['status'] == 'available') {
            return redirect()->route('pets.index')->with('success', 'Pet added successfully.');
        }

        return redirect()->route('pets.create')->with('error', 'Failed to add pet. Invalid API response.');
    }

    public function updatePet(Request $request, $petId)
    {
        $this->validatePet($request);

        $client = new Client();
        $response = $client->request('POST', "$this->apiBaseUrl/$petId", [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => $request->all(),
        ]);

        if ($response->getStatusCode() == 200) {
            return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
        }

        throw new \Exception('Failed to update pet. Something went wrong.');
    }

    public function deletePet($petId)
    {
        $client = new Client();
        $client->delete("$this->apiBaseUrl/$petId");

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }

    private function validatePet(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required|string',
        ]);
    }
}
