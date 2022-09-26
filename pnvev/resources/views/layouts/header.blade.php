<header>
    <div class="header-content-centering header-logos">
        <img src="{{ asset('images/logos-cabecera.svg') }}" alt="logos">
    </div>
    <div class="header-content-centering header-title">
        <h1>Tablero del Programa Nacional de Enfermedades Vectoriales</h1>
    </div>
    <nav>
        <ul>
            <li class="{{ $activeId == 0 ? 'active' : '' }}">
                <a href="{{ route('home') }}">Tablero Principal</a>
            </li>
            @foreach ($orphanDiseases as $disease)
                <li class="{{ $activeId == $disease->id ? 'active' : '' }}">
                    <a href="{{ route('disease.show', ['id' => $disease->id]) }}">{{ $disease->name }}</a>
                </li>
            @endforeach
            @foreach ($diseaseFamilies as $diseaseFamily)
                <li class="{{ $activeId == 0 ? 'active' : '' }}">{{ $diseaseFamily->name }}
                    <ul>
                        @foreach ($diseaseFamily->diseases()->get() as $disease)
                            <li class="{{ $activeId == $disease->id ? 'active' : '' }}">
                                <a href="{{ route('disease.show', ['id' => $disease->id]) }}">{{ $disease->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</header>