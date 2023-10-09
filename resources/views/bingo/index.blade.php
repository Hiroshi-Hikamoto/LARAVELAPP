@extends('layouts.app')

@section('template_title')
    Bingo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Bingo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('bingos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Programar nuevo bingo') }}
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
                                        
										<th>Nombre</th>
										<th>Fecha</th>
										<th>Estado</th>
										{{-- <th>Id Usuario</th> --}}
										<th>Numero de Tablas</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bingos as $bingo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $bingo->Nombre }}</td>
											<td>{{ $bingo->Fecha }}</td>
											<td>
                                                @switch($bingo->estado)
                                                    @case(3)
                                                        Finalizado
                                                        @break

                                                    @case(2)
                                                        En Juego
                                                        @break

                                                    @default
                                                        Progamado
                                                @endswitch
                                                
                                            </td>
											{{-- <td>{{ $bingo->id_usuario }}</td> --}}
											<td>{{ $bingo->Cant_tablas }}</td>

                                            <td>
                                                <form action="{{ route('bingos.destroy',$bingo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success " href="{{ route('Adminbingo',['id' => $bingo->id]) }}"><i class="fa fa-fw fa-eye"></i> Jugar</a>
                                                    <a class="btn btn-sm btn-primary " href="{{ route('bingos.show',$bingo->id) }}"><i class="fa fa-fw fa-eye"></i> Reporte</a>
                                                    <a class="btn btn-sm btn-warning" href="{{ route('bingos.edit',$bingo->id) }}"><i class="fa fa-fw fa-edit"></i> Re-programar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Cancelar Bingo</button> --}}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $bingos->links() !!}
            </div>
        </div>
    </div>
@endsection
