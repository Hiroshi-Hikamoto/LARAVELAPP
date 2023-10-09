@extends('layouts.app')

@section('template_title')
    Cargue Contacto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cargue Contacto') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cargue-contactos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
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
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Contacto</th>
										<th>Var1</th>
										<th>Var2</th>
										<th>Var3</th>
										<th>Var4</th>
										<th>Var5</th>
										<th>Var6</th>
										<th>Var7</th>
										<th>Var8</th>
										<th>Var9</th>
										<th>Var10</th>
										<th>Id Usuario</th>
										<th>Id Campaña</th>
										<th>Fec Creacion</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cargueContactos as $cargueContacto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $cargueContacto->contacto }}</td>
											<td>{{ $cargueContacto->var1 }}</td>
											<td>{{ $cargueContacto->var2 }}</td>
											<td>{{ $cargueContacto->var3 }}</td>
											<td>{{ $cargueContacto->var4 }}</td>
											<td>{{ $cargueContacto->var5 }}</td>
											<td>{{ $cargueContacto->var6 }}</td>
											<td>{{ $cargueContacto->var7 }}</td>
											<td>{{ $cargueContacto->var8 }}</td>
											<td>{{ $cargueContacto->var9 }}</td>
											<td>{{ $cargueContacto->var10 }}</td>
											<td>{{ $cargueContacto->id_usuario }}</td>
											<td>{{ $cargueContacto->id_campaña }}</td>
											<td>{{ $cargueContacto->fec_creacion }}</td>
											<td>{{ $cargueContacto->estado }}</td>

                                            <td>
                                                <form action="{{ route('cargue-contactos.destroy',$cargueContacto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cargue-contactos.show',$cargueContacto->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cargue-contactos.edit',$cargueContacto->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $cargueContactos->links() !!}
            </div>
        </div>
    </div>
@endsection
