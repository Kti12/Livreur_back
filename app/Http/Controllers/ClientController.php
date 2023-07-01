<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller



{
    public function show(Request $request, $id)
    {
        $client = Client::find($id);
        
        if (!$client) {
            return response()->json(['message' => 'Client pas trouvé'], 404);
        }
        
        return response()->json($client);
    }

    
    public function set_postion(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->latitude = $request->latitude;
        $client->longitude = $request->longitude;
        $client->save();
        return response()->json(['message' => 'Position partagée avec succès'], 200);
    }

    
}


