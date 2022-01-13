@component('mail::message')

@component('mail::panel')
Pagal jūsų pageidavimus artimiausiu laikotarpiu prognozuojamas vėjo stiprumas
@endcomponent

@component('mail::table')
| Regionas | Vėjo stiprumas | Laikas |
| :-------------: | :-------------: | :--------: |
| {{ $forecast->name }} | {{ $forecast->windSpeed }} m/s | {{ $forecast->forecastTimeUtc }} |

@endcomponent

Pagarbiai,
{{ config('app.name') }}
@endcomponent