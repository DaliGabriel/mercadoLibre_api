<?php

    //recibe el codigo generado por el servidor de mercado libre para confimrar el directorio 
    $codigo_autorizacion = $_GET['code'];


    //Se inicia la peticion post para enviar los datos necesarios para obtener el token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.mercadolibre.com/oauth/token");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&client_id=$APP_ID&client_secret=$CLIENT_SECRET&code=".$codigo_autorizacion."&redirect_uri=$YOUR_REDIRECT_URI");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    $data = json_decode($remote_server_output, true);
    $token = $data['access_token'];
    curl_close($ch);



    <script>
         
        // Url a la cual se va hacer la peticion Put para actualizar los datos
        var url = `https://api.mercadolibre.com/items/<?php echo $MLM; ?>`;
        
        //Se inicia la peticion
        var xhr = new XMLHttpRequest();
        xhr.open("PUT", url);
        
        //Se declaran las cabeceras de la peticion
        xhr.setRequestHeader("Authorization", "Bearer <?php echo $token ?>");
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Accept", "application/json");
        
        // Imprime el estatus y la respuesta, no hacer mucho caso a esta respuesta ya que php es mas rapido que js y no imprime correctamente los cambios realizados
        xhr.onreadystatechange = function () {
           if (xhr.readyState === 4) {
              console.log(xhr.status);
              console.log(xhr.responseText);
           }};
        
        // Cuerpo de la peticion PUT es decir los parametros a enviar
        var data = '{"available_quantity":"<?php echo $cantidad ?>","price":"<?php echo $price ?>"}';
        
        // Envio de los datos
        xhr.send(data);
        
        
    </script>
    
