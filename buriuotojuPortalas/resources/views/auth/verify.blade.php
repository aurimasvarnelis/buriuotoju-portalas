@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Patvirtinkite savo el. pašto adresą') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Nauja patvirtinimo nuoroda buvo išsiųsta į jūsų el paštą.') }}
                        </div>
                    @endif

                    {{ __('Prieš tęsiant, prašome peržiūrėti savo el. paštą dėl patvirtinimo nuorodos.') }}
                    {{ __('Jei negavote pranešimo') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('spauskite čia, jog išsiųstų dar vieną') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
