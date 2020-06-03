<?php
    include "../conexion/conexionBD.php";
    $cedula = $_GET['cedula'];
    $senial = false;
    
    
    if($cedula!=''){
        $sql = "SELECT usu_id, usu_nombre, usu_direccion, usu_telefono FROM usuario WHERE usu_cedula='$cedula'";
        $result = $conn->query($sql);
        $senial = false;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $usu_id =  $row["usu_id"];
                $usu_nombre = $row["usu_nombre"];
                $usu_direccion = $row['usu_direccion'];
                $usu_telefono = $row['usu_telefono'];
            }
            $senial = true;
        } else {
           echo "<p>No existe un usuario con esta cedula</p>";
           $senial = false;
        }
    }

    if($senial==true){
        $sql = "SELECT * FROM vehiculo WHERE veh_usuario=$usu_id";
        $result = $conn->query($sql);
        echo " <table style='width:100%'>
        <tr>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
        </tr>
        <tr>
        
        <td> $usu_nombre  </td>
        <td> $usu_direccion </td>
        <td> $usu_telefono </td>
        </tr>
        <tr>
        <th>Placa</th>
        <th>Marca</th>
        <th>Modelo</th>

        </tr>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['veh_placa'] ."</td>";
                echo "<td>" . $row['veh_marca'] ."</td>";
                echo "<td>".$row['veh_modelo']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen vehiculos para este usuario </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

        
    $conn->close();
?>