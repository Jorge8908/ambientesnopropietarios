<?php

$db = new mysqli('localhost' , 'root' , '', 'registro');
if (isset($_POST) && count($_POST)>0)
{
    if ($db->connect_errno)
    {
        die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
    }
    else
    {
        $query=$db->query("update editinplace set ".$_POST["campo"]."='".$_POST["valor"]."' where idusuario='".intval($_POST["id"])."' limit 1");
        if ($query) echo "<span class='ok'>Valores modificados correctamente.</span>";
        else echo "<span class='ko'>".$db->error."</span>";
    }
}

if (isset($_GET) && count($_GET)>0)
{
    if ($db->connect_errno)
    {
        die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
    }
    else
    {
        $query=$db->query("select * from usuario order by idusuario asc");
        $datos=array();
        while ($usuario=$query->fetch_array())
        {
            $datos[]=array(	"id"=>$usuario["idusuario"],
                "nombre"=>$usuario["nombre"],
                "email"=>$usuario["email"],
                "direccion"=>$usuario["direccion"],
                "usuario"=>$usuario["usuario"]
            );
        }
        echo json_encode($datos);
    }
}
?>