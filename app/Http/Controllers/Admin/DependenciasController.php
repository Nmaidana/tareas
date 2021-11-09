<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dependencia\BulkDestroyDependencia;
use App\Http\Requests\Admin\Dependencia\DestroyDependencia;
use App\Http\Requests\Admin\Dependencia\IndexDependencia;
use App\Http\Requests\Admin\Dependencia\StoreDependencia;
use App\Http\Requests\Admin\Dependencia\UpdateDependencia;
use App\Models\Dependencia;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DependenciasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexDependencia $request
     * @return array|Factory|View
     */
    public function index(IndexDependencia $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Dependencia::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nombre'],

            // set columns to searchIn
            ['id', 'nombre']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.dependencia.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.dependencia.create');

        return view('admin.dependencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDependencia $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreDependencia $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Dependencia
        $dependencium = Dependencia::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/dependencias'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/dependencias');
    }

    /**
     * Display the specified resource.
     *
     * @param Dependencia $dependencium
     * @throws AuthorizationException
     * @return void
     */
    public function show(Dependencia $dependencium)
    {
        $this->authorize('admin.dependencia.show', $dependencium);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Dependencia $dependencium
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Dependencia $dependencium)
    {
        $this->authorize('admin.dependencia.edit', $dependencium);


        return view('admin.dependencia.edit', [
            'dependencium' => $dependencium,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDependencia $request
     * @param Dependencia $dependencium
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateDependencia $request, Dependencia $dependencium)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Dependencia
        $dependencium->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/dependencias'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/dependencias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyDependencia $request
     * @param Dependencia $dependencium
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyDependencia $request, Dependencia $dependencium)
    {
        $dependencium->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyDependencia $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyDependencia $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Dependencia::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
