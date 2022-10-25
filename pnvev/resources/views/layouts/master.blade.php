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
    @include('layouts.header')

    @section('main')
    @show
    
    <footer>
        <section>
            <h3>Consultas</h3>
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
            Avda. Silvio Pettirossi y Constitución
            </p>
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                </svg>    
            Lunes a Viernes, de 7:00 a 15:00 hs.
            </p>
            <p>
                <a href="mailto:pnetv.divet@gmail.com">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                    </svg>
                    pnetv.divet@gmail.com
                </a> 
            </p>
        </section>
        <section>
            <h3>Mas información</h3>
            <p>
                <a href="https://dgvs.mspbs.gov.py/files/calendario/Semana_Epidemiol%C3%B3gica_2022.pdf">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>
                    Calendario Epidemiológico 2022
                </a> 
            </p>
            <p>
                <a href="https://dgvs.mspbs.gov.py/files/guiaNacional/Guia_de_Vigilancia_2022_act_28_julio.pdf">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                    <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
                    Guía Nacional de Vigilancia y Control de Eventos de Notificación Obligatoria
                </a> 
            </p>
        </section>
        <section>
            <h3>Interés</h3>
            <div class="footer-intereses">
                <a href="https://dgvs.mspbs.gov.py/">
                    <img src="{{ asset('images/logo-dgvs-white.svg') }}" alt="Link to DGVS">
                </a>
                <a href="https://www.mspbs.gov.py/index.php">
                    <img src="{{ asset('images/logo-mspbs-white.svg') }}" alt="Link to MSPBS">
                </a>
            </div>
        </section>
    </footer>

    @section('scripts')
    @show

</body>

</html>
