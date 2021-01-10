<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.clients', [
            'clients' => Auth::user()->clients()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.create-client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = Auth::user()->clients()->create($request->validated());

        return redirect()->route('client.edit', $client->id)
            ->with('success', 'Client created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\View\View
     */
    public function edit(Client $client)
    {
        $this->authorize('owner', $client);
        return view('admin.create-client', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $this->authorize('owner', $client);
        $client->update($request->validated());

        return redirect()->route('client.edit', $client->id)
            ->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->authorize('owner', $client);
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }
    /**
     * Display a json clients.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function loadClients(Request $request)
    {
        $client = Auth::user()->clients()->select("id", "name");
        if ($request->has('q')) {
            $search = $request->q;
            $client->where('name', 'LIKE', "%$search%");
        }
        return response()->json($client->limit(20)->get());
    }
}
