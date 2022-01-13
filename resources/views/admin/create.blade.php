@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">     
            <div class="card">
                <div class="card-header">{{ __('Sukurti naują vartotoją') }}
                    <a href="{{ route('admin.index') }}" class="btn btn-primary float-right">Grįžti</a>            
                </div>
                 
                    <div class="card-body">
                        <form action="{{ route('admin.createUpdate') }}" method="POST">
                            @csrf

                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Vardas') }}</label>
    
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ __('Reikia nurodyti vardą') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('El. pašto adresas') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('Reikia nurodyti el. pašto adresą') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Slaptažodis') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('Reikia nurodyti slaptažodį') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Vartotojo tipas') }}</label>
    
                                <div class="col-md-6">
                                
                                    <select id="role" type="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role">
                                        <option value="" selected="true" disabled="disabled">Pasirinkite vartotoją</option>
                                        <option value="user">Vartotojas</option>
                                        <option value="moderator">Valdytojas</option>
                                        <option value="admin">Administratorius</option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __('Reikia nurodyti vartotojo tipą') }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>


                            
                            <button class="btn btn-primary" type="submit">{{ __('Išsaugoti pakeitimus') }}</button>
                        </form>

                        
                    </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
