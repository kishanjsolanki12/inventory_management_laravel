<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Role
        </h2>
        

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (count($errors) > 0)

                    <div class="alert alert-danger">

                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                        <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                        </ul>

                    </div>

                @endif
                <form method="POST" action="{{ route('roles.update', $role->id) }}" class="form" novalidate>

                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12">

                            <div class="form-group">

                                <strong>Role Name:</strong>
                                <input type="text" name="name" id="name" class="text-input focus:shadow-outline @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" autocomplete="off" required/>
                                <!-- {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} -->

                            </div>

                        </div>

                       <!--  <div class="col-xs-12 col-sm-12 col-md-12">

                            <div class="form-group">

                                <strong>Permission:</strong>

                                <br/>

                                @foreach($permission as $value)

                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}

                                    {{ $value->name }}</label>

                                <br/>

                                @endforeach

                            </div>

                        </div> -->


                    <div class="form-row">

                        <div class="label-block md:mb-0 md:w-4/5">
                           
                        </div>

                        <div class="input-block md:w-1/5">
                            <a href="/admin/roles/" class="btn-cancel focus:shadow-outline hover:bg-gray-300" type="button">Cancel</a>
                            <input class="btn-submit focus:shadow-outline hover:bg-blue-600" type="submit" value="Update" />
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-admin-layout>
