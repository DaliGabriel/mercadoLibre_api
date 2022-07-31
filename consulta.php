


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class=" mt-5  flex space-x-2 justify-center">
<a href="https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=181537600478799&redirect_uri=https://libreriashidalgo.com/mercadolibre/api.php">
  <button
    type="button"
    data-mdb-ripple="true"
    data-mdb-ripple-color="light"
    class="inline-block px-8 py-5 bg-blue-600 text-white font-medium text-lg leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
  >
  
  Procesar Mercado Libre
  
  </button>
    </a>
</div>

</body>
</html>



<?php


//Procesar mercado libre
//https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=181537600478799&redirect_uri=https://libreriashidalgo.com/mercadolibre/api.php



//Iniciamos la nueva sesion para usar el token dado y mandar peticion por medio de la api
//        $ch = curl_init();
//        
//        curl_setopt($ch, CURLOPT_URL, 'https://auth.mercadolibre.com.mx/authorization?response_type=code&client_id=181537600478799&redirect_uri=https://libreriashidalgo.com/mercadolibre/api.php');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//        
//        
//        $headers = array();
//        //se asigna la cookie necesaria para el logeo en mercado libre
//        $headers[] = 'cookie: _ml_ga=GA1.3.731168663.1658843164; _ml_ga_gid=GA1.3.1929426660.1658843164; _d2id=cbadc115-475d-4c6a-8060-67535de4e84c; cookiesPreferencesNotLogged=%7B%22categories%22%3A%7B%22advertising%22%3Atrue%7D%7D; __gads=ID=16bb750b4cb1fd57:T=1658843169:S=ALNI_Ma38vVWK8odpuLOqApQtE_hXvHnmg; orgnickp=LILI3032357; orguseridp=791802117; ssid=ghy-072610-x4NhQsATaQJxD6ZWwZL0oETKV2I6T4-__-791802117-__-1753452654969--RRR_0-RRR_0; ftid=PJfWxb47BoKHhmLghIzjewwfsuWPklGF-1658843170850; cookiesPreferencesLoggedFallback=%7B%22userId%22%3A791802117%2C%22categories%22%3A%7B%22advertising%22%3Atrue%7D%7D; cp=58000; _gcl_au=1.1.594068181.1658844702; _fbp=fb.2.1658844702947.921591773; _hjSessionUser_550932=eyJpZCI6IjhlOTEwMWRhLTU2YTQtNTg2NS04ODMyLTI2OTk1N2VjMjdmMyIsImNyZWF0ZWQiOjE2NTg4NDQ3MDIzOTcsImV4aXN0aW5nIjp0cnVlfQ==; _hjSessionUser_427661=eyJpZCI6ImQxMzY2MzlkLTI1NzQtNTZhNi1hZjA5LTdmYTljOTFkMWM0MCIsImNyZWF0ZWQiOjE2NTg4NDg3Njk0NDksImV4aXN0aW5nIjpmYWxzZX0=; _hjSessionUser_720735=eyJpZCI6ImJhYjZiNTkzLTY4NjAtNWY2NC04MjI1LWU3MmViYjI1MjBjZSIsImNyZWF0ZWQiOjE2NTg4NDQ2NjE4NTUsImV4aXN0aW5nIjp0cnVlfQ==; _gid=GA1.3.94366585.1658856586; __gpi=UID=0000076510846437:T=1658843169:RT=1658931983:S=ALNI_MaxSFzstcORUOPIc0-CaQJG5go9sg; _ga_HEZRL7JLMR=GS1.1.1658932244.3.1.1658932247.57; _ga=GA1.3.731168663.1658843164; _csrf=y4jmK1wMQsgV8a8cXUCJ_UWB; orguserid=Hh4H0H7dZ00h';
//       
//       
//       
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//        
//        $result = curl_exec($ch);
//        
//        if (curl_errno($ch)) {
//            echo 'Error:' . curl_error($ch);
//        }
//        
//        
//        echo $result;

        


        
        