<header>
    <div class="header-content-centering header-logos">
        <img src="{{ asset('images/logos-cabecera.svg') }}" alt="logos">
    </div>
    <div class="header-content-centering header-title">
        <h1>Tablero del Programa Nacional de Enfermedades Vectoriales</h1>
    </div>
    <nav class="header-content-centering">
        <a href="/">
            <div class="navbar-item {{ $active == 'home' ? 'navbar-active-item': ''}}"><i class="bi-house-fill"></i><span>Tablero Principal</span></div>
        </a>
        <a href="/disease/hantavirus">
            <div class="navbar-item {{ $active == 'hantavirus' ? 'navbar-active-item': ''}}"><i class="bi-graph-up"></i><span>Hantavirus</span></div>
        </a>
        <a href="/disease/malaria">
            <div class="navbar-item {{ $active == 'malaria' ? 'navbar-active-item': ''}}"><i class="bi-graph-up"></i><span>Malaria</span></div>
        </a>
        <a href="/disease/leptopirosis">
            <div class="navbar-item {{ $active == 'leptopirosis' ? 'navbar-active-item': ''}}"><i class="bi-graph-up"></i><span>Leptopirosis</span></div>
        </a>
        <a href="#">
            <div class="navbar-item {{ $activemenu == 'leishmaniasis' ? 'navbar-active-item': ''}} navbar-menu">
                <i class="bi-graph-up"></i><span>Leishmaniasis</span>
                <div class="navbar-options">
                    <a href="/disease/leishmaniasis/mucosa">
                        <div class="navbar-item {{ $active == 'leishmaniasis-mucosa' ? 'navbar-active-item': ''}} navbar-option">
                            <i class="bi-graph-up"></i><span>L. Mucosa</span>
                        </div>
                    </a>
                    <a href="/disease/leishmaniasis/cutanea">
                        <div class="navbar-item {{ $active == 'leishmaniasis-cutanea' ? 'navbar-active-item': ''}} navbar-option">
                            <i class="bi-graph-up"></i><span>L. Cutanea</span>
                        </div>
                    </a>
                    <a href="/disease/leishmaniasis/visceral">
                        <div class="navbar-item {{ $active == 'leishmaniasis-visceral' ? 'navbar-active-item': ''}} navbar-option">
                            <i class="bi-graph-up"></i><span>L. Visceral</span>
                        </div>
                    </a>
                </div>
            </div>
        </a>
        <a href="/disease/chagas">
            <div class="navbar-item {{ $activemenu == 'chagas' ? 'navbar-active-item': ''}} navbar-menu">
                <i class="bi-graph-up"></i><span>Chagas</span>
                <div class="navbar-options">
                    <a href="/disease/chagas/agudo">
                        <div class="navbar-item {{ $active == 'chagas-agudo' ? 'navbar-active-item': ''}} navbar-option">
                            <i class="bi-graph-up"></i><span>C. Agudo</span>
                        </div>
                    </a>
                    <a href="/disease/chagas/cronico">
                        <div class="navbar-item {{ $active == 'chagas-cronico' ? 'navbar-active-item': ''}} navbar-option">
                            <i class="bi-graph-up"></i><span>C. Crónico</span>
                        </div>
                    </a>
                    <a href="/disease/chagas/congenito">
                        <div class="navbar-item {{ $active == 'chagas-congenito' ? 'navbar-active-item': ''}} navbar-option">
                            <i class="bi-graph-up"></i><span>C. Congénito</span>
                        </div>
                    </a>
                </div>
            </div>
        </a>
    </nav>
</header>