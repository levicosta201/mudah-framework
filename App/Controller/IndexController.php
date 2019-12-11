<?php

/*
 * This file is part of the leviframework to projetc webjump.
 *
 * (c) Levi Costa <levi.costa1@gmail.com>
 *
 * For non-commercial use
 * 
 */
 
 /*
  * Set PHP heavily typed
  */
declare(strict_types=1);
namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

/**
 * Class LogsController.
 *
 * @author Levi Costa <levi.costa1@gmail.com>
 */
class IndexController extends Controller
{

	/**
     * @var ResponseInterface
     */
	private $response;

	/**
     * @var LogModel
     */
	private $log_model;

	/**
     * @var string
     */
	private $session_id;

	/**
     * Return a view with form to search product
     *
     * @return view
     */
	public function index()
	{		
		$this->getSessionId();
		//json_decode($this->getProductData(35))->response
		return $this->blade->make('index')->with([
			'session_id' => $this->getSessionId(),
		]);
	}

	private function getSessionId()
	{
		$xml_raw = '<?xml version="1.0" encoding="ISO-8859-1" ?><serviceRequest><requestBody><NOMUSU>teste</NOMUSU><INTERNO>innovation</INTERNO></requestBody></serviceRequest>';
		$response = simplexml_load_string($this->requestData('http://innovation.fmcdatacom.com.br:8332/mge/service.sbr?serviceName=MobileLoginSP.login', $xml_raw));
		$this->saveSessionId($response->responseBody->jsessionid);
		return $response->responseBody->jsessionid;
	}

	public function getProductData(string $product_code = null)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8332",
		  CURLOPT_URL => "http://innovation.fmcdatacom.com.br:8332/mge/service.sbr?serviceName=DbExplorerSP.executeQuery&mgeSession=KfnUMQPfEDxw6bwK948DILDVVu9sJhfr-Q2Jb2yT",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\"serviceName\":\"DbExplorerSP.executeQuery\",\"requestBody\":{\"sql\":\"SELECT * FROM [sankhya].[VW_DadosProduto] WHERE codprod = ".$product_code." \"}}",
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Content-Length: 131",
		    "Content-Type: application/html+xml",
		    "Cookie: JSESSIONID=KfnUMQPfEDxw6bwK948DILDVVu9sJhfr-Q2Jb2yT.snk-app-treina02",
		    "Host: innovation.fmcdatacom.com.br:8332",
		    "Postman-Token: 1cdc67e9-de7f-480f-80b7-70f24ff73d5f,f6a8a0da-d7c7-478b-be48-e73964da0ec5",
		    "User-Agent: PostmanRuntime/7.20.1",
		    "cache-control: no-cache"
		  ),
		));

		$response = json_decode(utf8_encode(curl_exec($curl)));

		$err = curl_error($curl);
		if ($err) 
		    return json_encode([
		        'error' => $err,
		  	]);

		return json_encode([
			'response' => $response->responseBody,
		]);
	}

	private function requestData(string $url, string $raw) : string
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8332",
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 120,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $raw,
		  CURLOPT_ENCODING => 'UTF-8',
		  CURLOPT_HTTPHEADER => array(
		    "Accept: */*",
		    "Accept-Encoding: gzip, deflate",
		    "Cache-Control: no-cache",
		    "Connection: keep-alive",
		    "Content-Length: 155",
		    "Content-Type: application/xml",
		    "Cookie:".$this->getSessionIdFromSession(),
		    "Host: innovation.fmcdatacom.com.br:8332",
		    "Postman-Token: a25f84bb-01d4-4b21-b2ac-89e7a9f6194b,27b4365c-543e-44d2-83bd-8dba3f31052c",
		    "User-Agent: PostmanRuntime/7.20.1",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		print("CURL RESPONSE: " + $response);
		$err = curl_error($curl);
		print("CURL ERROR: " + $err);

		curl_close($curl);

		if ($err) 
		  return "Error #:" . $err;
		
		return $response;
	}

	private function saveSessionId($session_id) : void
	{	
		saveSession('session_id', (string) $session_id);
	}

	private function getSessionIdFromSession() : string
	{
		return getSession('session_id') ?? '';
	}
}