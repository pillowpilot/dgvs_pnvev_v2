@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('css_v2/admin.css') }}">
@stop

@section('main')

<article>
    <span class="article-title">Actualizar mapa de departamentos</span>
    <form class="article-content" action="{{ route('admin.maps.storeRegion') }}" method="post" enctype="multipart/form-data">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="name">Departamentos (GeoJSON)</label>
                <input type="file" name="file" id="regions-file-selector" accept=".geojson, .json" >
            </div>
        </main>
        <footer>
            <button class="admin-submit-button" type="submit">Guardar</button>
            <span class="submissionStatus" id="regionsSubmitStatus">
                @if(isset($regionsStatusMessageText))
                {{ $regionsStatusMessageText }}
                @else
                Aqui va un mensaje de error!
                @endif
            </span>
        </footer>
    </form>
</article>

<article>
    <span class="article-title">Actualizar mapa de distritos</span>
    <form class="article-content" action="{{ route('admin.maps.storeDistrict') }}" method="post" enctype="multipart/form-data">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="name">Distritos (GeoJSON)</label>
                <input type="file" name="file" id="districts-file-selector" accept=".geojson, .json" >
            </div>
        </main>
        <footer>
            <button class="admin-submit-button" type="submit">Guardar</button>
            <span class="submissionStatus" id="districtsSubmitStatus">
                @if(isset($districtsStatusMessageText))
                {{ $districtsStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

@stop

@section('scripts')
<script>

const fileTooBigMessage = `El archivo es demasiado grande. El tamaño máximo es de 3MB.`;
const checkFileSize = (event, maxSizeInMB, messageElementId, message) => {
    const file = event.target.files[0];
    const fileSizeInMB = file.size / (1024 * 1024);
    if(fileSizeInMB > maxSizeInMB) {
        document.getElementById(messageElementId).innerHTML = message;
    }
};

document.getElementById('regions-file-selector').addEventListener('change', (event) => {
    checkFileSize(event, 3, 'regionsSubmitStatus', fileTooBigMessage);
});

document.getElementById('districts-file-selector').addEventListener('change', (event) => {
    checkFileSize(event, 3, 'districtsSubmitStatus', fileTooBigMessage);
});
</script>
@stop