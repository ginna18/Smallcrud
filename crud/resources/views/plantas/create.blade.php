
    @extends('layouts.master')
    @section('titulo','Nueva planta')

@section('contenido')
<form  class="my-2 border p-5" method="POST" 
enctype="multipart/form-data" 
action="{{route('plantas.store')}}">
    @csrf
    <div class="form-group row">
        <label for="inputCategoria" class="col-sm-2 col-form-label">Categoria</label>
               <div > <select name="categoria" id="inputCategoria" required class="up form-control col-sm-10" value="{{old('categoria')}}">
                        <option value="">- Seleccione -</option>
                        <option value="Arbusto">Arbusto</option>
                        <option value="Árbol">Árbol</option>
                        <option value="Herbáceas">Plantas herbáceas</option>

                 </select>
            </div>
        <!-- <input type="text" name="categoria" class="up form-control col-sm-10" id="inputCategoria" 
        placeholder="Categoria" maxlength="255" required value="{{old('categoria')}}"> -->
    </div>
    <div class="form-group row">
        <label for="inputipo" class="col-sm-2 col-form-label">Tipo</label>
        <div > <select name="tipo" id="inputipo" required class="up form-control col-sm-10" value="{{old('tipo')}}">
                        <option value="">- Seleccione -</option>
                        <option value="Plantas sin flor:musgos,helechos">Plantas sin flor:musgos, helechos</option>
                        <option value="Plantas con flor: gimnospermas, angiospermas">Plantas con flor: gimnospermas, angiospermas</option>
                 </select>
            </div>
       <!--  <input type="text" name="tipo" class="up form-control col-sm-10" id="inputipo" 
        placeholder="Tipo" maxlength="255" required value="{{old('tipo')}}"> -->
    </div>
    <div class="form-group row">
        <label for="inputNombres" class="col-sm-2 col-form-label">Nombre Silvestre:</label>
        <input type="text" name="nombres" class="up form-control col-sm-10" id="inputNombres" 
        placeholder="Nombre Silvestre" maxlength="255" required value="{{old('nombres')}}">
    </div>

    <div class="form-group row">
        <label for="inputNombrec" class="col-sm-2 col-form-label">Nombre Cientifico:</label>
        <input type="text" name="nombrec" class="up form-control col-sm-10" id="inputNombrec" 
        placeholder="Nombre Cientifico" maxlength="255" required value="{{old('nombrec')}}">
    </div>

    <div class="form-group row">
        <label for="descripcion" class="col-sm-2 col-form-label">descripcion:</label>
        <input type="text" name="descripcion" class="up form-control col-sm-10" id="inputDescripcion" 
        placeholder="descripcion" maxlength="255" required value="{{old('descripcion')}}">
    </div>

    <div class="form-group row">
        <label for="inputAltura" class="col-sm-2 col-form-label">Altura:</label>
        <input type="number" name="altura" class="up form-control col-sm-10" id="inputAltura" 
        placeholder="altura maxima de la planta" maxlength="255" required value="{{old('altura')}}">
    </div>

    <div class="form-group row">
        <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
        <input type="file" name="imagen" class="form-control-file col-sm-10" id="inputImagen">
    </div>

    <div class="form-group row my-3">
        <div class="form-check col-sm-6">
        <input name="registrada" value="1" class="form-check-input" id="chkRegistrada"
        type="checkbox" {{empty(old('registrada'))? "" : "checked"}}>
        <label for="chkRegistrada" class="form-check-label">Registrada ?</label>
        </div>

        <div class="form-group row col-sm-6">
            <label for="inputRegistro" class="col-sm-2 col-form-label">Registro:</label>
            <input type="text" name="registro" class="up form-control" id="inputRegistro" 
                   maxlength="7" value="{{old('registro')}}">
        </div>
</div>
<script>
    inputRegistro.disabled = !chkRegistrada.checked;

    chkRegistrada.onchange = function(){
        inputRegistro.disabled = !chkRegistrada.checked;
    }
</script>

    <div class="form-group row">
        <div class="form-check col-sm-6">
       <input type="checkbox" class="form-check-input" id="chkColor">
        <label class="form-check-label">Indicar el Color:</label>
    </div>

    <div class="form-check col-sm-6">
            <label for="inputColor" class="col-sm-2 col-form-label">Color:</label>
            <input type="color" name="color" class="up form-control form-control-color" 
            id="inputColor" value="{{old('color') ?? '#FFFFFF'}}">
        </div>
</div>
<script>
     inputColor.disabled = !chkColor.checked;

chkColor.onchange = function(){
    inputColor.disabled = !chkColor.checked;
}
</script>
  

     <div class="form-group row">
        <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
        <button type="reset" class="btn btn-secondary m-2">Borrar</button>
    </div>
</form> 
@endsection

        @section('enlaces')
        @parent
        <a href="{{route('plantas.index')}}" class="btn btn-primary m-2">Huerto</a>
        @endsection
   
</main>

     <!--parte inferior-->
     @section('pie')

     
</body>
</html>