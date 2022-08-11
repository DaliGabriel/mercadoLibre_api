<?php 


$codigo_autorizacion = $_GET['code'];

//Codigos sku para convertirlos a codigos de mercado libre (MLN)
$arreglo = array();

    //Comprobamos que se  recibio el codigo en el parametro code
    if (isset($codigo_autorizacion)) {

     /**
     * Url para obtener autorización
     -- https://developers.mercadolibre.com.ar/es_ar/autenticacion-y-autorizacion
     */
     
    
    // abrimos la sesion cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.mercadolibre.com/oauth/token");
    
    // indicamos el tipo de petición: POST
    curl_setopt($ch, CURLOPT_POST, TRUE);
    
    // definimos cada uno de los parametros
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&client_id=APP_ID&client_secret=CLAVE_SECRETA&code=".$codigo_autorizacion."&redirect_uri=REDIRECT_URI");
    
    // recibimos la respuesta y la guardamos en una variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    
    //Transformar jeson a array en php
    $data = json_decode($remote_server_output, true);
    
    //filtramos el valor del token de acceso
    $token = $data['access_token'];
    
    
    // Muestra el json recibido por mercado libre
    //print_r($remote_server_output);
    
    //echo $token;
    
    curl_close($ch);
    
        //Se comprueba que el token esta asignado
        if(isset($token)){
            //iterar por producto
            foreach($arreglo as $arr){
                    //Iniciamos la nueva sesion para usar el token dado y mandar peticion por medio de la api
                $ch = curl_init();
                
                curl_setopt($ch, CURLOPT_URL, 'https://api.mercadolibre.com/users/$ID_USUARIO/items/search?seller_sku='.$arr);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                
                
                $headers = array();
                $headers[] = 'Authorization: Bearer '.$token;
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                $result = curl_exec($ch);
                
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                
                // convertir json a arreglo php
                $json_to_array = json_decode($result, true);
                
                //Accedemos al codigo de mercado libre del producto
                $codigo_mercado_libre = $json_to_array['results'][0];
                
                $codigos_mercado_libre .= $codigo_mercado_libre;
                
                
                echo '<br>'.$codigo_mercado_libre.'</br>';
            
            }
            
            //separar el string generado por el inicio de cada codigo de 
            $codigos_mercado_libree = explode("MLM", $codigos_mercado_libre);
            
            
            curl_close($ch);
            
            
            
        }

} else {
    // Fallback behaviour goes here
    echo '<h1> Algo salio mal y no pudimos obtener el codigo de autorizacion enviado por el servidor de mercado libre </h1>';
}
}else{
    echo '<h1> Ocurrio un error en el formulario </h1>';
}

?>

<script>
     
    //Se le asigna el valor al arreglo proveniente de la variable de php 
    var array= <?php echo json_encode($codigos_mercado_libree); ?>;
    
    //Se itera en cada uno de los elementos del arreglo y se accede mediante la variable element en el parametro de la funcion anonima
    array.forEach(function(element){
    
    var url = `https://api.mercadolibre.com/items/MLM${element}`;
    
    //Se inicia la peticion
    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);
    
    //Se declaran las cabeceras de la peticion
    xhr.setRequestHeader("Authorization", "Bearer <?php echo $token ?>");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Accept", "application/json");
    
    xhr.onreadystatechange = function () {
       if (xhr.readyState === 4) {
          console.log(xhr.status);
          console.log(xhr.responseText);
       }};
    
    var data = '{"deleted":"true"}';
    
    xhr.send(data);
    
});


</script>

<?php 
print_r($codigos_mercado_libree);
echo json_encode($codigos_mercado_libree);
?>
