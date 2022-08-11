<?php



    //recibe el codigo generado por el servidor de mercado libre para confimrar el directorio 
    $codigo_autorizacion = $_GET['code'];


    //Se inicia la peticion post para enviar los datos necesarios para obtener el token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://api.mercadolibre.com/oauth/token");
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&client_id=7413947623045152&client_secret=DH6vqE5dhBO1dAJ73G1Nd1AE2uuGS2tG&code=".$codigo_autorizacion."&redirect_uri=https://libreriashidalgo.com/mercadolibre/lhallbor.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    $data = json_decode($remote_server_output, true);
    $token = $data['access_token'];
    curl_close($ch);
    
    ?>

<!-- Script para borrar -->

<script>
     
    
    var url = `https://api.mercadolibre.com/items/<?php echo $MLM; ?>`;
    
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
    


</script>
