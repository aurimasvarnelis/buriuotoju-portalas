@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">{{ __('Atnaujinti prognozių duomenis') }}</div>

                <div class="card-body">
                    <form action="{{ route('reportSubmit') }}" method="post">
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
                            <label>Iš kurio internetinio puslapio atnaujinti prognozių duomenis</label>
                            <select class="form-control" id="website" name="website">
                                <option value="" selected="true" disabled="disabled">Pasirinkite internetinį puslapį</option>
                                <option value="meteo">Meteo.lt</option>
                                <option value="gismeteo">Gismeteo.lt</option>
                            </select>
                          
                        </div>
                    
                        <button type="submit" class="btn btn-primary" >Atnaujinti prognozių duomenis</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
