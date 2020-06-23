<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ env('APP_NAME') }}
                </div>
                <form class="form" action="{{ route('create_code') }}" method="POST">
                    @csrf
                    <h3>Wygeneruj kody rabatowe</h3>
                    <hr />
                    <label htmlFor="codesNumber">
                        Podaj liczbę kodów:
                    </label>
                    <input name="codesNumber" id="codesNumber" type="number" min="1" step="1" />
                    <label htmlFor="codeLength">
                        Podaj długość kodu:
                    </label>
                    <input name="codeLength" id="codeLength" type="number" min="1" step="1" />

                    <button type="submit">Generuj</button>
                </form>
            </div>
        </div>
    </body>
</html>
