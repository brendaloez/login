<?php
  // creamos una variable de sesion
  error_reporting(0);
  session_start();
  include 'conecta.php';
  // recuperar datos de el formulario login
  $usuario = $conecta->real_escape_string($_POST['usuario']);
  $password = $conecta->real_escape_string(md5($_POST['contraseña']));
  // consulta para extraer los datos de la base de datos de el alumno
  $consulta = "SELECT * FROM Alumnos WHERE usuario = '$usuario' and contraseña = '$password'";
  if ($resultado = $conecta->query($consulta)) {
    while ($row = $resultado->fetch_array()) {
        $userok = $row['usuario'];
        $passwordok = $row['contraseña'];
    }
    $resultado->close();
  }
  $conecta->close();
  if (isset($usuario) && isset($password)) {
     if ($usuario == $userok && $password == $passwordok) {
         $_SESSION['escuela']= TRUE;
         $_SESSION['usuario']= $usuario;
         header("location:../principal.php");
     }
      else {
          header("location:../Aplicativo1.php");
      }
    }     else{
       header("location:../Aplicativo1.php");
  }
 ?>