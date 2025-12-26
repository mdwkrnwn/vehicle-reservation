<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $vehicle = Vehicle::latest()->paginate(10);
        return view('admin.vehicle.index', compact('vehicle'));
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
    public function store(Request $request)
    {
        $request->validate([
            'kode_kendaraan' => 'required|unique:vehicles,kode_kendaraan',
            'merk' => 'required|string|max:100',
            'nomor_polisi' => 'required|unique:vehicles,nomor_polisi',
            'jenis' => 'required|in:angkutan_orang,angkutan_barang',
            'status' => 'required|in:tersedia,dipakai,service',
        ]);

        Vehicle::create($request->all());

        return redirect()
            ->route('admin.vehicle.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'kode_kendaraan' => 'required|unique:vehicles,kode_kendaraan,' . $vehicle->id,
            'merk' => 'required|string|max:100',
            'nomor_polisi' => 'required|unique:vehicles,nomor_polisi,' . $vehicle->id,
            'jenis' => 'required|in:angkutan_orang,angkutan_barang',
            'status' => 'required|in:tersedia,dipakai,service',
        ]);

        $vehicle->update($request->all());

        return redirect()
            ->route('admin.vehicle.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()
            ->route('admin.vehicle.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
    /**
     * Remove the specified resource from storage.
     */
}
