@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-header">{{ __('Generuoti ataskaitą') }}</div>

                <div class="card-body">
                    <form action="{{route('loadForecastData')}}" method="post">
                        @csrf
                        
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <div class="form-group">
                            <label>Laiko periodas</label>
                            
                            <input type="datetime-local" class="form-control @error('beforeDate') is-invalid @enderror" name="beforeDate" value="{{ old('beforeDate') }}">
                            @error('beforeDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong> Reikia nurodyti laiko periodą </strong>
                                </span>
                            @enderror

                            <br> 

                            <input type="datetime-local" class="form-control @error('afterDate') is-invalid @enderror" name="afterDate" value="{{ old('afterDate') }}">
                            @error('afterDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong> Reikia nurodyti laiko periodą </strong>
                                </span>
                            @enderror
                          
                        </div>

                        <div class="form-group">
                            <label>Vėjo stiprumas</label>
                            
                            <input type="number" class="form-control @error('windSpeed1') is-invalid @enderror" name="windSpeed" value="{{ old('windSpeed') }}">
                            @error('windSpeed1')
                                <span class="invalid-feedback" role="alert">
                                    <strong> Reikia nurodyti norimą vėjo stiprumą </strong>
                                </span>
                            @enderror
                          
                        </div>

                    
                        <button type="submit" class="btn btn-primary"> Generuoti ataskaitą </button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
