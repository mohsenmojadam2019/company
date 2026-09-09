<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CmsController extends Controller
{
    public function index(Request $request, string $resource): View
    {
        $config = $this->resource($resource);
        $model = $config['model'];
        $query = $model::query();

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($builder) use ($config, $search): void {
                foreach ($config['search'] as $index => $column) {
                    $index === 0 ? $builder->where($column, 'like', "%{$search}%") : $builder->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        $items = $query->latest()->paginate(15)->withQueryString();

        return view('admin.cms.index', compact('resource', 'config', 'items'));
    }

    public function create(string $resource): View
    {
        $config = $this->resource($resource);
        $model = $config['model'];
        $item = new $model;

        return view('admin.cms.form', compact('resource', 'config', 'item'));
    }

    public function store(Request $request, string $resource): RedirectResponse
    {
        $config = $this->resource($resource);
        $model = $config['model'];
        $data = $this->validated($request, $config);
        $model::query()->create($this->normalize($request, $config, $data));
        Cache::flush();

        return redirect()->route('admin.cms.index', $resource)->with('success', $config['singular'].' created.');
    }

    public function edit(string $resource, int $id): View
    {
        $config = $this->resource($resource);
        $item = $config['model']::query()->findOrFail($id);

        return view('admin.cms.form', compact('resource', 'config', 'item'));
    }

    public function update(Request $request, string $resource, int $id): RedirectResponse
    {
        $config = $this->resource($resource);
        $item = $config['model']::query()->findOrFail($id);
        $data = $this->validated($request, $config, $item);
        $item->update($this->normalize($request, $config, $data, $item));
        Cache::flush();

        return redirect()->route('admin.cms.index', $resource)->with('success', $config['singular'].' updated.');
    }

    public function destroy(string $resource, int $id): RedirectResponse
    {
        $config = $this->resource($resource);
        $item = $config['model']::query()->findOrFail($id);

        foreach ($config['fields'] as $name => $field) {
            if ($field['type'] === 'image' && $item->{$name}) {
                Storage::disk('public')->delete($item->{$name});
            }
        }

        $item->delete();
        Cache::flush();

        return back()->with('success', $config['singular'].' deleted.');
    }

    private function resource(string $resource): array
    {
        $config = config("cms.resources.{$resource}");
        abort_unless(is_array($config), 404);
        return $config;
    }

    private function validated(Request $request, array $config, ?Model $item = null): array
    {
        $rules = [];
        foreach ($config['fields'] as $name => $field) {
            $rules[$name] = str_replace('{id}', (string) ($item?->getKey() ?? 'NULL'), $field['rules']);
        }
        return $request->validate($rules);
    }

    private function normalize(Request $request, array $config, array $data, ?Model $item = null): array
    {
        foreach ($config['fields'] as $name => $field) {
            if ($field['type'] === 'checkbox') {
                $data[$name] = $request->boolean($name);
            }

            if ($field['type'] === 'image') {
                unset($data[$name]);
                if ($request->hasFile($name)) {
                    if ($item?->{$name}) Storage::disk('public')->delete($item->{$name});
                    $data[$name] = $request->file($name)->store('cms', 'public');
                }
            }
        }

        return $data;
    }
}
