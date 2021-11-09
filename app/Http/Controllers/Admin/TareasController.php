<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tarea\BulkDestroyTarea;
use App\Http\Requests\Admin\Tarea\DestroyTarea;
use App\Http\Requests\Admin\Tarea\IndexTarea;
use App\Http\Requests\Admin\Tarea\StoreTarea;
use App\Http\Requests\Admin\Tarea\UpdateTarea;
use App\Models\Tarea;
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

class TareasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTarea $request
     * @return array|Factory|View
     */
    public function index(IndexTarea $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Tarea::class)->processRequestAndGet(
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

        return view('admin.tarea.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.tarea.create');

        return view('admin.tarea.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTarea $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTarea $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Tarea
        $tarea = Tarea::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/tareas'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/tareas');
    }

    /**
     * Display the specified resource.
     *
     * @param Tarea $tarea
     * @throws AuthorizationException
     * @return void
     */
    public function show(Tarea $tarea)
    {
        $this->authorize('admin.tarea.show', $tarea);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tarea $tarea
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Tarea $tarea)
    {
        $this->authorize('admin.tarea.edit', $tarea);


        return view('admin.tarea.edit', [
            'tarea' => $tarea,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTarea $request
     * @param Tarea $tarea
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTarea $request, Tarea $tarea)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Tarea
        $tarea->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/tareas'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/tareas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTarea $request
     * @param Tarea $tarea
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTarea $request, Tarea $tarea)
    {
        $tarea->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTarea $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTarea $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Tarea::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
