<?php 
//sku precio cantidad id_producto


$codigo_autorizacion = $_GET['code'];
//TG-62e2c787eff14400124ff63b-791802117
//$codigo_autorizacion = "TG-62e2c787eff14400124ff63b-791802117";


$arreglo = array(9786078473120, 9786074531046, 9786071430632, 9788416972173, 9788446046981, 9789688607114, 9788496669765, 9788496669796, 9786078683017, 9786077723585);

if (true){
    
    
    
    //Comprobamos que se  recibio el codigo en el parametro code
    if (isset($codigo_autorizacion)) {

     /**
     * Url para obtener autorización
     --https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=181537600478799&redirect_uri=https://libreriashidalgo.com/mercadolibre/api.php
     */
     
    
    // abrimos la sesión cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.mercadolibre.com/oauth/token");
    
    // indicamos el tipo de petición: POST
    curl_setopt($ch, CURLOPT_POST, TRUE);
    
    // definimos cada uno de los parámetros
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&client_id=181537600478799&client_secret=QEos6WWaUsyHMqu5ZI9nq5NEZP28ifge&code=".$codigo_autorizacion."&redirect_uri=https://libreriashidalgo.com/mercadolibre/api.php");
    
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
                
                curl_setopt($ch, CURLOPT_URL, 'https://api.mercadolibre.com/users/791802117/items/search?seller_sku='.$arr);
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




<!-- 
<table>
  <thead align="left" style="display: table-header-group">
  <tr>
     <th>Sku </th>
     <th>Precio</th>
     <th>Cantidad </th>
     <th>Id_Producto </th>
  </tr>
  </thead>
<tbody>
<?php 
foreach ($codigos_mercado_libree as $codigos_mercado_libr) :?>
  <tr class="item_row">
        <td><?php echo 'MLM'.$codigos_mercado_libr; ?></td>
        <td> <?php echo 'null'; ?></td>
        <td> <?php echo 'null';?></td>
        <td> <?php echo 'null'; ?></td>
  </tr>
<?php endforeach;?>
</tbody>
</table>

-->

<?php 
print_r($codigos_mercado_libree);
echo json_encode($codigos_mercado_libree);
?>
