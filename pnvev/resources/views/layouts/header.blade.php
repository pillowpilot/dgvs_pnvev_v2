<header>
    <div class="header-content-centering header-logos">
        <img src="{{ asset('images/logos-cabecera.svg') }}" alt="logos">
    </div>
    <div class="header-content-centering header-title">
        <h1>Tablero del Programa Nacional de Enfermedades Vectoriales</h1>
    </div>
    <nav>
        <ul>
            <li class="{{ Route::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">Tablero Principal</a>
            </li>
            @foreach ($orphanDiseases as $disease)
                <li class="{{ isset($activeDisease) && $activeDisease->id == $disease->id ? 'active' : '' }}">
                    <a href="{{ route('disease.show', ['id' => $disease->id]) }}">{{ $disease->name }}</a>
                </li>
            @endforeach
            @foreach ($diseaseFamilies as $diseaseFamily)
                <li class="{{ isset($activeDisease) && $activeDisease->family == $diseaseFamily->id ? 'active' : '' }}">
                    {{ $diseaseFamily->name }}
                    @if ( isset($activeDisease) && $activeDisease->family == $diseaseFamily->id )
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                        </svg>
                    @endif
                    <ul>
                        @foreach ($diseaseFamily->diseases()->get() as $disease)
                            <li class="{{ isset($activeDisease) && $activeDisease->id == $disease->id ? 'active' : '' }}">
                                <a href="{{ route('disease.show', ['id' => $disease->id]) }}">{{ $disease->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</header>