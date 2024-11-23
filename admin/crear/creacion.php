<?php
if (!empty($_POST)) {
    include('../php/cone.php');
    $conn = Conexion();
    $correo = $_POST['correo'];       
    $clave = $_POST['clave'];  
    $tipo = $_POST['tipo'];           
    $primN = $_POST['primN'];         
    $segN = $_POST['segN'];         
    $primA = $_POST['primA'];         
    $segA = $_POST['segA'];           
    $numCedula = $_POST['numCedula'];
    
    $conn->beginTransaction();

    $stmt = $conn->prepare("INSERT INTO usuarios (correo, clave, tipo) VALUES (?, ?, ?)");
    $stmt->execute([$correo, $clave, $tipo]);

    
    $id_usuario = $conn->lastInsertId();

    if ($tipo == 'Admin') {
        $stmt = $conn->prepare("INSERT INTO admins (primNombre, segNombre, primApellido, segApellido, numCedula, id_usuario) 
           VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$primN, $segN, $primA, $segA, $numCedula, $id_usuario]);

    } elseif ($tipo == 'Docente') {
        $stmt = $conn->prepare("INSERT INTO docentes (primNombre, segNombre, primApellido, segApellido, numCedula, id_usuario) 
        VALUES (?, ?, ?, ?, ?, ?)");
     $stmt->execute([$primN, $segN, $primA, $segA, $numCedula, $id_usuario]);

    } elseif ($tipo == 'Estudiante') {
        $stmt = $conn->prepare("INSERT INTO estudiantes (primNombre, segNombre, primApellido, segApellido, numCedula, id_usuario) 
           VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$primN, $segN, $primA, $segA, $numCedula, $id_usuario]);

    }

    $conn->commit();

    echo '<div class="alert alert-danger text-center">USUARIO CREADO CORRECTAMENTE</div>';
    exit();
}
?>
    
    

