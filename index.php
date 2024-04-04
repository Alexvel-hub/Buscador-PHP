<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>
<body>
  <video src="img/video2.mp4" id="vidFondo"></video>
  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Buscador</h1>
    </div>
    <div class="colFiltros">
      <form action="index.php" method="get" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Realiza una búsqueda personalizada</h5>
          </div>
          <!-- Los menús desplegables a la izquierda de la página que indican la ciudad y
          el tipo de vivienda deben cargarse con todas las ciudades y tipos presentes en los datos generales sin repetirse. -->
          <div class="filtroCiudad input-field">
            <label for="selectCiudad">Ciudad:</label><br>
            <select name="ciudad" id="selectCiudad">
              <!-- Si se selecciona un elemento del menú desplegable Ciudad, se deben seleccionar únicamente
              los registros que hagan parte de la ciudad seleccionada y cuyo precio esté dentro del rango indicado. -->
              <option value="" selected>Elige una ciudad</option>
              <option value="New York">New York</option>
              <option value="Orlando">Orlando</option>
              <option value="Los Angeles">Los Angeles</option>
              <option value="Houston">Houston</option>
              <option value="Washington">Washington</option>
              <option value="Miami">Miami</option>
            </select>
          </div>
          <!-- Si se selecciona un elemento del menú desplegable Tipo, se deben seleccionar únicamente los registros
          que hagan parte del tipo seleccionado y cuyo precio esté dentro del rango indicado. -->
          <div class="filtroTipo input-field">
            <label for="selecTipo">Tipo:</label><br>
            <select name="tipo" id="selectTipo">
              <option value="" selected>Elige un tipo</option>
              <option value="Apartamento">Apartamento</option>
              <option value="Casa">Casa</option>
              <option value="Casa de Campo">Casa de campo</option>
            </select>
          </div>
          <!-- Todas las búsquedas deben ser filtradas por un rango de precios, es decir,
          se deben mostrar todos los registros cuyo precio se encuentre entre los dos valores
          del rango especificado en el buscador. -->
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn black" name="buscar" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div class="colContenidoppal">
      <form action="index.php" method="get">
        <div class="tituloContenido card">
          <h5>Resultados de la búsqueda:</h5>
          <div class="divider"></div>
          <button type="submit" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>
        </div>
      </form>
      <?php
       // El buscador debe mostrar todos los registros disponibles en los datos generales al hacer click en el botón “Mostrar todos”.
        if(isset($_GET['todos'])){
          $data=file_get_contents("data-1.json");
          $propiedades=json_decode($data,true);
          for($i=0;$i<count($propiedades);$i++) {
            $ciudad=$propiedades[$i]["Ciudad"];
            $tipo=$propiedades[$i]["Tipo"];
            $precio=$propiedades[$i]["Precio"];
            $direccion=$propiedades[$i]["Direccion"];
            $codigo_postal=$propiedades[$i]["Codigo_Postal"];
            $telefono=$propiedades[$i]["Telefono"];
            echo "<div class='colContenido'>
              <div class='tituloContenido'>
                <div class='itemMostrado'>
                  <img src='img/imagen.jpg'>
                  <ul>
                      <p><strong>Direccion:</strong>".$direccion."</p>";
                    echo "<p><strong>Ciudad:</strong>".$ciudad."</p>";
                    echo"<p><strong>Telefono:</strong>".$telefono."</p>";
                    echo"<p><strong>Codigo Postal:</strong>".$codigo_postal."</p>";
                    echo"<p><strong>Tipo:</strong>".$tipo."</p>";
                    echo "<p><strong>Precio:</strong></p> <p class='precioTexto'>"."$".$precio."</p>";
                    echo"
                  </ul>
                </div>
              </div>
            </div>";
          }
        }
      // Si se seleccionan elementos tanto del menú desplegable Ciudad como del menú desplegable Tipo,
      //se deben filtrar los resultados por la ciudad, tipo y precios ingresados.
        if(isset($_GET['buscar'])){
          $data=file_get_contents("data-1.json");
          $propiedades=json_decode($data,true);
          $filtro_ciudad=$_GET['ciudad'];
          $filtro_tipo=$_GET['tipo'];
          $precios=$_GET['precio'];
          $precios=explode(";",$precios);
          $precio_bajo=$precios[0];
          $precio_alto=$precios[1];
          for($i=0;$i<count($propiedades);$i++) {
            $ciudad=$propiedades[$i]["Ciudad"];
            $tipo=$propiedades[$i]["Tipo"];
            $precio=$propiedades[$i]["Precio"];
            $direccion=$propiedades[$i]["Direccion"];
            $codigo_postal=$propiedades[$i]["Codigo_Postal"];
            $telefono=$propiedades[$i]["Telefono"];
            $precio=str_replace("$","",$precio);
            if($ciudad==$filtro_ciudad && $tipo==$filtro_tipo){
              if($precio<$precio_alto && $precio>$precio_bajo){
                echo "<div class='colContenido'>
                  <div class='tituloContenido'>
                    <div class='itemMostrado'>
                      <img src='img/imagen.jpg'>
                      <ul>
                        <p><strong>Direccion:</strong>".$direccion."</p>";
                        echo "<p><strong>Ciudad:</strong>".$ciudad."</p>";
                        echo"<p><strong>Telefono:</strong>".$telefono."</p>";
                        echo"<p><strong>Codigo Postal:</strong>".$codigo_postal."</p>";
                        echo"<p><strong>Tipo:</strong>".$tipo."</p>";
                        echo "<p><strong>Precio:</strong></p> <p class='precioTexto'>"."$".$precio."</p>";
                        echo"
                      </ul>
                    </div>
                  </div>
                </div>";
              }
            }else{
              if($ciudad==$filtro_ciudad && $filtro_tipo==""){
                if($precio<$precio_alto && $precio>$precio_bajo){
                    echo "<div class='colContenido'>
                    <div class='tituloContenido'>
                      <div class='itemMostrado'>
                        <img src='img/imagen.jpg'>
                        <ul>
                          <p><strong>Direccion:</strong>".$direccion."</p>";
                          echo "<p><strong>Ciudad:</strong>".$ciudad."</p>";
                          echo"<p><strong>Telefono:</strong>".$telefono."</p>";
                          echo"<p><strong>Codigo Postal:</strong>".$codigo_postal."</p>";
                          echo"<p><strong>Tipo:</strong>".$tipo."</p>";
                          echo "<p><strong>Precio:</strong></p> <p class='precioTexto'>"."$".$precio."</p>";
                          echo"
                        </ul>
                      </div>
                    </div>
                  </div>";
                }
              }elseif ($tipo==$filtro_tipo && $filtro_ciudad==""){
                if($precio<$precio_alto && $precio>$precio_bajo){
                  echo "<div class='colContenido'>
                    <div class='tituloContenido'>
                      <div class='itemMostrado'>
                        <img src='img/imagen.jpg'>
                        <ul>
                          <p><strong>Direccion:</strong>".$direccion."</p>";
                          echo "<p><strong>Ciudad:</strong>".$ciudad."</p>";
                          echo"<p><strong>Telefono:</strong>".$telefono."</p>";
                          echo"<p><strong>Codigo Postal:</strong>".$codigo_postal."</p>";
                          echo"<p><strong>Tipo:</strong>".$tipo."</p>";
                          echo "<p><strong>Precio:</strong></p> <p class='precioTexto'>"."$".$precio."</p>";
                          echo"
                        </ul>
                      </div>
                    </div>
                  </div>";
                }
              }else{
                if($filtro_ciudad==""&& $filtro_tipo==""&&$precio<$precio_alto && $precio>$precio_bajo){
                  echo "<div class='colContenido'>
                    <div class='tituloContenido'>
                      <div class='itemMostrado'>
                        <img src='img/imagen.jpg'>
                        <ul>
                          <p><strong>Direccion:</strong>".$direccion."</p>";
                          echo "<p><strong>Ciudad:</strong>".$ciudad."</p>";
                          echo"<p><strong>Telefono:</strong>".$telefono."</p>";
                          echo"<p><strong>Codigo Postal:</strong>".$codigo_postal."</p>";
                          echo"<p><strong>Tipo:</strong>".$tipo."</p>";
                          echo "<p><strong>Precio:</strong></p> <p class='precioTexto'>"."$".$precio."</p>";
                          echo"
                        </ul>
                      </div>
                    </div>
                  </div>";
                }
              }
            }
          }
        }
      ?>

    </div>
  </div>
  <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
  <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</body>
</html>
