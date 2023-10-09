<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">

                    <span id="card_title">
                        {{ __('Asignar Testigo') }}
                    </span>

                     <div class="float-right">
                        {{-- <a href="{{ route('testigos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                          {{ __('Create New') }}
                        </a> --}}
                      </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead" style="text-align: center">
                            <tr>
                                <th>No</th>
                                
                                <th>Cedula</th>
                                <th>Primer Nombre</th>
                                <th>Segundo Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo apellido</th>
                                <th>Celular</th>
                                {{-- <th>Id Departamento</th>
                                <th>Id Municipio</th>
                                <th>Id Puesto</th> --}}
                                <th>Mesa</th>
                                {{-- <th>Id Campaña</th> --}}
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testigos as $testigo)
                                <tr style="text-align: center">
                                    <td>{{ ++$i }}</td>
                                    
                                    <td><input type="number" value="{{ $testigo->Cedula }}" class="form-control"/></td>
                                    <td><input type="text" value="{{ $testigo->PrimerNombre }}" class="form-control"/></td>
                                    <td><input type="text" value="{{ $testigo->SegundoNombre }}" class="form-control"/></td>
                                    <td><input type="text" value="{{ $testigo->PrimerApellido }}" class="form-control"/></td>
                                    <td><input type="text" value="{{ $testigo->SegundoApellido }}" class="form-control"/></td>
                                    <td><input type="number" value="{{ $testigo->Celular }}" class="form-control"/></td>
                                    {{-- <td>{{ $testigo->id_departamento }}</td>
                                    <td>{{ $testigo->id_municipio }}</td>
                                    <td>{{ $testigo->id_puesto }}</td> --}}
                                    <td>{{ $testigo->mesa }}</td>
                                    {{-- <td>{{ $testigo->id_campaña }}</td> --}}

                                    <td>
                                        <form action="{{ route('getMesaVot',$testigo->id) }}" method="POST">
                                            {{-- <a class="btn btn-sm btn-primary " href="{{ route('testigos.show',$testigo->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a> --}}
                                            <a class="btn btn-sm btn-success" href="{{ route('testigos.edit',$testigo->id) }}"><i class="fa fa-fw fa-edit"></i> Ver</a>
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button> --}}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! $testigos->links() !!}
    </div>
</div>