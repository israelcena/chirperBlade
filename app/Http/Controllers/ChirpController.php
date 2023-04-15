<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChipRequest;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ChirpController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    return view('chirps.index', [
      'chirps' => Chirp::with('User')->latest()->get(),
    ]);
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
  public function store(StoreChipRequest $request): RedirectResponse
  {
    $requestChirp = $request->all();
    $request->user()->chirps()->create($requestChirp);

    return redirect(route('chirps.index'))->with('status-message', 'The Chirp has created');
  }

  /**
   * Display the specified resource.
   */
  public function show(Chirp $chirp)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Chirp $chirp): View
  {
    $this->authorize('update', $chirp);

    return view('chirps.edit', [
      'chirp' => $chirp,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreChipRequest $storeChipRequest, Chirp $chirp): RedirectResponse
  {
    $this->authorize('update', $chirp);
    $chirp->update($storeChipRequest->all());

    return redirect(route('chirps.index'))->with('status-message', 'The Chirp was updated');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Chirp $chirp)
  {
    //
  }
}
