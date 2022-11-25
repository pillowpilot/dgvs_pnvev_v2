<header>
    <div class="header-content-centering header-logos">
        <img src="{{ asset('images/logos-cabecera-2.png') }}" alt="logos">
    </div>
    <div class="header-content-centering header-title">
        <h1>Tablero del Programa Nacional de Enfermedades Vectoriales</h1>
    </div>
    <nav>
        <ul>
            <li class="{{ Route::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">Tablero Principal</a>
            </li>
            @foreach (\App\DiseaseV2::roots()->get() as $root)
                <li class="{{ Route::is('disease.show') && isset($activeDisease) && ($root->id === $activeDisease->id || $root->children()->find($activeDisease->id)) ? 'active' : '' }}">
                    @if ($root->children()->count() === 0)
                        <a href="{{ route('disease.show', $root->id) }}">{{ $root->name }}</a>
                    @else
                        {{ $root->name }}
                        @if (isset($activeDisease) && $root->children()->find($activeDisease->id))
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                                <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                            </svg>
                        @endif
                        <ul>
                            @foreach ($root->children()->get() as $child)
                                <li class="{{ Route::is('disease.show') && isset($activeDisease) && $child->id == $activeDisease->id ? 'active' : '' }}">
                                    <a href="{{ route('disease.show', $child->id) }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</header>