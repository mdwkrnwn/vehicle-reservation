<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of drivers.
     */
    public function index()
    {
        $driver = Driver::latest()->paginate(10);
        return view('admin.driver.index', compact('driver'));
    }

    /**
     * Store a newly created driver.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Driver::create($request->all());

        return redirect()
            ->route('admin.driver.index')
            ->with('success', 'Driver berhasil ditambahkan.');
    }

    /**
     * Update the specified driver.
     */
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $driver->update($request->all());

        return redirect()
            ->route('admin.driver.index')
            ->with('success', 'Driver berhasil diperbarui.');
    }

    /**
     * Remove the specified driver.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()
            ->route('admin.driver.index')
            ->with('success', 'Driver berhasil dihapus.');
    }
}
