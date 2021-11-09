@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.dependencia.actions.edit', ['name' => $dependencium->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <dependencia-form
                :action="'{{ $dependencium->resource_url }}'"
                :data="{{ $dependencium->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.dependencia.actions.edit', ['name' => $dependencium->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.dependencia.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </dependencia-form>

        </div>
    
</div>

@endsection