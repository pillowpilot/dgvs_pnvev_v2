@extends('layouts.admin', ['user' => $user])

@section('stylesheets')
<style>
/* Main */
body>main {
    /* grid-area: main; */
    display: grid;
    grid-template-areas:
        "left regions right"
        "left districts right";
    grid-template-columns: 1fr 10fr 1fr;
    gap: 3rem;
    padding: 1rem 0;
}

body>main>article {
    display: grid;
    grid-template-areas:
        "title"
        "form";
    grid-template-rows: 2.5rem 1fr;
    gap: 1rem;
    max-height: 12rem;
}

body>main>article>span {
    font-size: 2rem;
    font-weight: 600;
    border-bottom: 1px solid #ccc;
}

body>main>article>form {
    display: grid;
    grid-template-areas:
        "main"
        "footer";
    grid-template-rows: 1fr 4rem;
    gap: 1rem;
    align-items: center;
}

body>main>article>form .inputs {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 0.5rem;
    align-items: center;
}

body>main>article>form>main>label {
    margin-right: 1rem;
}

body>main form button[type="submit"] {
    padding: 0.5rem 1.5rem;
    background-color: #2071cc;
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
}
</style>
@stop

@section('main')

<article style="grid-area: regions;">
    <span>Actualizar mapa de departamentos</span>
    <form action="{{ route('admin.maps.storeRegion') }}" method="post" enctype="multipart/form-data">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="name">Departamentos (GeoJSON)</label>
                <input type="file" name="file" id="regions-file-selector" accept=".geojson, .json" >
            </div>
        </main>
        <footer>
            <button type="submit">Guardar</button>
            <span class="submissionStatus" id="regionsSubmitStatus">
                @if(isset($regionsStatusMessageText))
                {{ $regionsStatusMessageText }}
                @endif
            </span>
        </footer>
    </form>
</article>

<article style="grid-area: districts;">
    <span>Actualizar mapa de distritos</span>
    <form action="{{ route('admin.maps.storeDistrict') }}" method="post" enctype="multipart/form-data">
        <main>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="inputs">
                <label for="name">Distritos (GeoJSON)</label>
                <input type="file" name="file" id="districts-file-selector" accept=".geojson, .json" >
            </div>
        </main>
        <footer>
            <button type="submit">Guardar</button>
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