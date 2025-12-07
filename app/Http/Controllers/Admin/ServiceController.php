<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'تم تعديل الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
