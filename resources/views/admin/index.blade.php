@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">     
            <div class="card">
                <div class="card-header">{{ __('Visi vartotojai') }}</div>
                
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('danger'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('danger') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead  class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Vardas</th>
                                    <th scope="col">El. paštas</th>
                                    <th scope="col">Vartotojo tipas</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == "user")
                                            {{ __('Vartotojas') }}  
                                        @endif

                                        @if($user->role == "moderator")
                                            {{ __('Valdytojas') }}  
                                        @endif

                                        @if($user->role == "admin")
                                         {{ __('Administratorius') }}                                     
                                        @endif  
                                    </td>
                                    <td> 
                                        <a href="{{ route('admin.edit', $user) }}">
                                            <button class="btn btn-success">Redaguoti</button>
                                        </a>
                                    </td>
                                    <td> 
                                        <div>
                                             <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#myModal-{{ $user->id }}">
                                                Ištrinti
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Pašalinti vartotoją vardu: {{ $user->name }}?
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Ar tikrai norite pašalinti šį vartotoją?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="{{ route('admin.delete', $user) }}">
                                                                @method("DELETE")
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">
                                                                    Ištrinti
                                                                </button>
                                                            </form>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                Atgal
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" colspan="6">
                                        <a href="{{ route('admin.create') }}" class="d-flex justify-content-center">
                                            <button class="btn btn-success">Sukurti naują paskyrą</button>
                                        </a>
                                    </th>
                                </tr>

                                
                            </tbody>
                        </table>

                        {{--@foreach ($users as $user)
                        <div class="row">
                            <div class="col-1">
                                <strong>ID: </strong>{{ $user->id }}
                            </div>

                            <div class="col-3">
                                <strong>Vardas: </strong>{{$user->name}}
                            </div>
                            
                            <div class="col-4">
                                <strong>Vartotojo tipas:</strong>
                                {{ $user->role }}
                            </div>

                            
                        
                        </div>
                        @endforeach--}}
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
