<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    @section('stylesheets')
    @show
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <title>PNVEV</title>
</head>

<body>
    @include('layouts.header', ['active' => $active, 'activemenu' => isset($activemenu)? $activemenu : ''])

    @section('main')
    @show
    
    <footer>
        <section>
            <h3>Mas información</h3>
        </section>
        <section>
            <h3>Interés</h3>
            <div class="footer-intereses">
                <a href="#">
                    <img src="{{ asset('images/logo-dgvs-white.svg') }}" alt="Link to DGVS">
                </a>
                <a href="#">
                    <img src="{{ asset('images/logo-mspbs-white.svg') }}" alt="Link to MSPBS">
                </a>
            </div>
        </section>
    </footer>

    <script src="{{ asset('js/jquery/jquery-3.6.1.js') }}"></script>
    <script src="{{ asset('js/jquery/select2/select2.full.js') }}"></script>

    @section('scripts')
    @show

</body>

</html>
