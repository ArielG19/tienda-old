<!DOCTYPE html>
<html lang="en">
<head>
  <title>Actualizar</title>
</head>
<body>
<h1> Insertar Nuevo Usuario </h1>
<form action="{{url('usuarios'.$usuarios['id']}}" method="put">
  {{csrf_field()}}
  Nombre:
  <input type="text" name="nombre" value="{{$usuarios['nombre']}}"> <br>
  Apellido:
  <input type="text" name="apellido" value="{{$usuarios['apellido']}}"> <br>
  <input type="submit" name='enviar' value="Guardar">
</form>
</body>
</html>
