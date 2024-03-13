<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

use common\models\Ordenes;

class ApiController extends Controller
{

  public static function getUltimaComision()
  {
    $apiUrl = 'http://172.16.1.251/consultasapi/v0/comision';
    $client = new Client();
    $response = $client->createRequest()
      ->setMethod('GET')
      ->setUrl($apiUrl)
      ->send();

    // Verificar si la solicitud fue exitosa (código de estado 200)
    if ($response->isOk) {
      // Decodificar la respuesta JSON
      $data = $response->data['comision']['CostoComision'];
      // dd($data);
      return $data;
    } else {
      return [];
      Yii::error('Error al consumir el servicio REST: ' . $response->statusCode);
      // Por ejemplo, mostrar un mensaje de error
      throw new \yii\web\HttpException($response->statusCode, 'Error al consumir el servicio REST');
    }
  }

  public function actionConsumeApi()
  {
    // URL del servicio REST que deseas consumir
    $apiUrl = 'http://localhost:3000/posts';

    // Crear una instancia del cliente HTTP
    $client = new Client();

    // Realizar la solicitud GET al servicio REST
    $response = $client->createRequest()
      ->setMethod('GET')
      ->setUrl($apiUrl)
      ->send();

    // Verificar si la solicitud fue exitosa (código de estado 200)
    if ($response->isOk) {
      // Decodificar la respuesta JSON
      $data = $response->data;
      dd($data);
      // Trabajar con los datos recibidos
      // Por ejemplo, pasar los datos a la vista
      return $this->render('view', ['data' => $data]);
    } else {
      // Si la solicitud no fue exitosa, manejar el error apropiadamente
      Yii::error('Error al consumir el servicio REST: ' . $response->statusCode);
      // Por ejemplo, mostrar un mensaje de error
      throw new \yii\web\HttpException($response->statusCode, 'Error al consumir el servicio REST');
    }
  }

  public static function obtenerQr($IdOrden)
  {

    function crearSolicitudQr($ord) {
      //dd($ord);
      $code = completarCeros($ord->IdOrden);
      $cod2 = $code.'-'.$ord->creador->IdPersona;
      $fecha = date('Y-m-d', strtotime($ord->FechaCreacion));
      $fecha2 = new \DateTime($fecha); 
      $fecha2->modify('+2 days');
      $fecha2 = $fecha2->format('d/m/Y');
      $re = [
        'datos' => [
          'monto' => $ord->TotalOrden,
          'referencia' => 'pagoOrden-'.$cod2,
          'codigoPago' => 'VEN-'.$cod2,
          'nombreCompleto' => $ord->NombreCompleto,
          'item' => [
            'idOrden' => $code,
            'nroComprobante' => '0',
            'fechaPago' => $fecha,
            'FechaLimiteAtencion' => $fecha2
          ],
          'detallePagos' => [
            'monto' => "$ord->TotalOrden;$ord->CostoComision",
            'cuenta' => "1-1176028;416-451"
          ],
          "codigoTipoTransaccion" => "Q"
        ]
      ];
  
      return $re;
    }
  
    function completarCeros($nu) {
      $ta = strval($nu); //texto auxiliar
      $lg = strlen($ta);
      $cc = '0';
      for ($i=1; strlen($cc.$ta) < 5  ; $i++) { $cc .= '0'; }
      return $cc.$ta;
    }

    $orden = Ordenes::find()
          ->joinWith('creador')
          ->where(['Ordenes.IdOrden' => $IdOrden])
          ->one();
    //dd($orden);

    $solQr = crearSolicitudQr( $orden );
    //dd($solQr);
    // URL del servicio REST que deseas consumir
    $apiUrl = 'http://172.16.1.251/pagos/pagos-qr/obtener-qr';
    
    // Crear una instancia del cliente HTTP
    $client = new Client();

    // Realizar la solicitud POST al servicio REST con los datos en formato JSON
    $response = $client->createRequest()
      ->setMethod('POST')
      ->setUrl($apiUrl)
      ->setData($solQr) // Configurar los datos a enviar
      ->setFormat(Client::FORMAT_JSON) // Especificar el formato JSON
      ->send();
    
    // Verificar si la solicitud fue exitosa (código de estado 200)
    if ($response->isOk) {
      // Capturar la respuesta del servicio
      $responseData = $response->getData(); // Obtiene la respuesta en formato de array
      return ['resposeData' => $responseData, 'solQr' => $solQr];
    }
    else{
      // Si la solicitud no fue exitosa, manejar el error apropiadamente
      Yii::error('Error al enviar datos al servicio REST: ' . $response->statusCode);
      dd($response->statusCode);
      // Por ejemplo, mostrar un mensaje de error
      throw new \yii\web\HttpException($response->statusCode, 'Error al enviar datos al servicio REST');
    }
  }
}
