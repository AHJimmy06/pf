<?php
if (!empty($_POST)) {
    if ((empty($_POST["correo"])) and (empty($_POST["contrasenia"]))) {
        echo '<div class="alert alert-danger text-center">INGRESE SU CORREO Y CONTRASEÑA</div>';
    } else {
        include('php/cone.php');
        $conn = Conexion();
        $correo = $_POST["correo"];
        $clave = $_POST["contrasenia"];
       
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND clave = ?");
        $stmt->execute([$correo, $clave]);
        $resultado=$stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado){
            $tipo = $resultado['tipo'];
            if ($tipo === 'admin') {
                header("location: admin/c_.php");
                session_start();
            } elseif ($tipo === 'profesor') {
                header("location: b_profesor/profesor.php");
                session_start();
            } elseif ($tipo === 'estudiante') {
                header("location: b_estudiante/estudiante.php");
                session_start(); 
            }
            exit();
        } else{
            echo'<div class="alert alert-danger text-center">INGRESE CORRECTAMENTE SU USUARIO Y CONTRASEÑA</div>';
        }
    }
}
?>