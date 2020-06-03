
<?php
    include "../conexion/conexionBD.php";
    $senial = false;
    
    
        $sql = "SELECT * FROM usuario ";
        $result = $conn->query($sql);
        $senial = false;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $usu_id =  $row["usu_id"];
                $usu_cedula =  $row["usu_cedula"];  
                $usu_nombre = $row["usu_nombre"];
                $usu_direccion = $row['usu_direccion'];
                $usu_telefono = $row['usu_telefono'];
            }
            $senial = true;
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
                $veh_id =  $row["veh_id"];
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


        $sql = "SELECT * FROM ticket WHERE tic_vehiculo = $veh_id";
        $result = $conn->query($sql);

        echo"
        <tr>
        <th>Fecha de Ingreso</th>
        <th>Hora de Ingreso</th>
        <th>Fecha de Salida</th> 
        <th>Hora de Salida</th>
        </th>
        ";
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['tic_ingreso_fecha'] ."</td>";
                echo "<td>" . $row['tic_ingreso_hora'] ."</td>";
                echo "<td>" . $row['tic_salida_fecha']."</td>";
                echo "<td>" . $row['tic_salida_hora']."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='7'> No hay ticket asosiados a este vehiculo </td>";
            echo "</tr>";
        }

        echo "</table>";
    }

        
    $conn->close();
?>