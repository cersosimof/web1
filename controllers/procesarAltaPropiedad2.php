
<?php

    if(!empty($_FILES))
    {
        //Linea que le dice a donde subirla.
        $path = '../imagenesPropiedades/' . $_FILES['file']['name'];
        //Linea que sube la imagen a mi carpeta.
        move_uploaded_file($_FILES['file']['tmp_name'], $path);
        echo $_FILES['file']['name'];
    }
    else
    {
        echo 0;
    }


?>