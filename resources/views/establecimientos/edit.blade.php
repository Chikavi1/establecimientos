@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css" integrity="sha256-iDg4SF4hvBdxAAFXfdNrl3nbKuyVBU3tug+sFi1nth8=" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
  <h1 class="text-center mt-4">Editar establecimiento</h1>
		<div class="mt-5 row justify-content-center">
	    <form action="{{ route('establecimiento.update', $establecimiento->id) }}" 
            method="POST" 
            class="col-md-9 col-xs-12 card card-body"
            enctype="multipart/form-data" 
            >
        @csrf
        @method('PUT')
	    	<fieldset class="border p-4">
          <legend class="text-primary">Nombre y Categoria e Imagen Principal</legend>
            <div class="form-group">
              <label for="nombre">Nombre Establecimiento</label>
                <input 
                  type="text" 
                  id="nombre" 
                  class="form-control @error('nombre')  is-invalid  @enderror" 
                  placeholder="nombre Establecimiento" 
                  name="nombre" 
                  value="{{ $establecimiento->nombre }}">

                  @error('nombre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
            </div>
    
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select 
                		class="form-control @error('categoria_id') is-invalid @enderror"
                		name="categoria_id"
                		id="categoria">
                <option value="" selected disabled>-- Seleccione una categoria  --</option>
                @foreach($categorias as $categoria)
                  <option 
                  		value="{{$categoria->id}}"
                      {{ $establecimiento->categoria_id == $categoria->id ? 'selected' : ''}}
                    >{{ $categoria->nombre }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
              <label for="imagen_principal">Image Principal</label>
              <input 
                type="file" 
                id="imagen_principal" 
                class="form-control @error('imagen_principal')  is-invalid  @enderror" 
                placeholder="imagen principal " 
                name="imagen_principal" 
                value="{{ old('imagen_principal')}}">

              @error('imagen_principal')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror

              <img src="/storage/{{ $establecimiento->imagen_principal }}"  style="width: 200px;margin-top: 20px;">
            </div>
	    	</fieldset>

        <fieldset class="border p-4 mt-5">
          <legend class="text-primary">Ubicación</legend>
          <div class="form-group">
            <label for="formbuscador">Coloca la direccion del Establecimiento</label>
            <input 
              type="text" 
              id="formbuscador" 
              class="form-control" 
              placeholder="nombre Establecimiento"
              >
              <p class="text-secondary mt-5 mb-3 text-center">El asistente colocara una dirección estimada o mueve el pin hacia el lugar Correcto</p>
            </div>

            <div class="form-group">
              <div id="mapa" style="height: 400px;"></div>
            </div>
          
            <p class="informacion">Confirma que los siguientes campos son correctos</p>

            <div class="form-group">
              <label for="dirección">Dirección</label>
              <input type="text" id="direccion" name="direccion" class="form-control @error('direccion')  is-invalid  @enderror"
              placeholder="Direccion" value="{{ $establecimiento->direccion }}">
                @error('direccion')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
              @enderror
            </div>

            <div class="form-group">
              <label for="colonia">Colonia</label>
              <input type="text" id="colonia" class="form-control @error('colonia')  is-invalid  @enderror"
              placeholder="colonia" name="colonia" value="{{ $establecimiento->colonia }}">
                @error('colonia')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
              @enderror
            </div>

          <input type="hidden" id="lat" name="lat" value="{{ $establecimiento->lat }}">
          <input type="hidden" id="lng" name="lng" value="{{ $establecimiento->lng }}">
        </fieldset>

        <fieldset class="border p-4 mt-5">
          <legend  class="text-primary">Información Establecimiento: </legend>
            <div class="form-group">
              <label for="nombre">Teléfono</label>
              <input 
              type="tel" 
              class="form-control @error('telefono')  is-invalid  @enderror" 
              id="telefono" 
              placeholder="Teléfono Establecimiento"
              name="telefono"
              value="{{ $establecimiento->telefono }}"
                >

              @error('telefono')
                  <div class="invalid-feedback">
                      {{$message}}
                  </div>
              @enderror
            </div>

                    

            <div class="form-group">
                <label for="nombre">Descripción</label>
                <textarea
                    class="form-control  @error('descripcion')  is-invalid  @enderror" 
                    name="descripcion"
                >{{ $establecimiento->descripcion }}</textarea>

                    @error('descripcion')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
            </div>

            <div class="form-group">
                <label for="nombre">Hora Apertura:</label>
                <input 
                    type="time" 
                    class="form-control @error('apertura')  is-invalid  @enderror" 
                    id="apertura" 
                    name="apertura"
                    value="{{ $establecimiento->apertura }}"
                >
                @error('apertura')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombre">Hora Cierre:</label>
                <input 
                    type="time" 
                    class="form-control @error('cierre')  is-invalid  @enderror" 
                    id="cierre" 
                    name="cierre"
                    value="{{ $establecimiento->cierre }}"
                >
                @error('cierre')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </fieldset>

        <fieldset class="border p-4 mt-5">
          <legend  class="text-primary">Imágenes Establecimiento: </legend>
            <div class="form-group">
              <label for="imagenes">Imagenes</label>
              <div id="dropzone" class="dropzone form-control"></div>
            </div>
            @if(count($imagenes) > 0)
							@foreach($imagenes as $imagen)
							<input type="hidden" class="galeria" value="{{ $imagen->ruta_imagen }}">
							@endforeach
            @endif 
        </fieldset>

            <input type="hidden" id="uuid" name="uuid" value="{{ $establecimiento->uuid }}">
            <input type="submit" class="btn btn-primary mt-3 d-block" value="Guardar Cambios">
	    </form>
		</div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>

<script src="https://unpkg.com/esri-leaflet"></script>
<script src="https://unpkg.com/esri-leaflet-geocoder"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.js" integrity="sha256-fegGeSK7Ez4lvniVEiz1nKMx9pYtlLwPNRPf6uc8d+8=" crossorigin="anonymous" defer></script>
@endsection