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
use App\Model\LogModel as LogModel;

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

	public function __construct(ResponseInterface $response)
	{
		parent::__construct();
		$this->response = $response;
	}

	public function index()
	{		

		if(!$this->checkSessionId())
			$this->validateSession();
		dd($this->getProductData(40));
		return $this->blade->make('index')->with([
			'session_id' => $this->getSessionId(),
		]);
	}

	private function autoLogin() : string
	{
		$xml_raw = '<?xml version="1.0" encoding="ISO-8859-1" ?><serviceRequest><requestBody><NOMUSU>teste</NOMUSU><INTERNO>innovation</INTERNO></requestBody></serviceRequest>';
		
		return $this->requestData('http://innovation.fmcdatacom.com.br:8332/mge/service.sbr?serviceName=MobileLoginSP.login', $xml_raw);
	}

	private function getProductData(int $product_code) : string
	{
		$xml_raw = '{"requestBody":{"sql":"Select * From [sankhya].[VW_DadosProduto] Where codprod = 0060"}}';
		
		return $this->requestData('http://innovation.fmcdatacom.com.br:8332/mge/service.sbr?serviceName=DbExplorerSP.executeQuery&mgeSession='. $this->getSessionId(), addslashes($xml_raw));
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
		    CURLOPT_TIMEOUT => 30,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "POST",
		    CURLOPT_POSTFIELDS => $raw,
		    CURLOPT_HTTPHEADER => array(
		        "cache-control: no-cache",
			    "content-type: text/xml",
			    "postman-token: 1c4a383b-51d9-5e08-b457-7184be176fec"
		    ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err)
		  return "cURL Error #:" . $err;
	  return $response;

	}

	private function checkSessionId() : bool 
	{
		$get_session_id = $this->getSessionId();

		if($get_session_id != null or $get_session_id != '')
			return true;
		return false;
	}

	private function validateSession() : void
	{
		$auto_login = stringToXml($this->autoLogin());
		$session_id = (string) $auto_login->responseBody->jsessionid;				
		saveSession('session_id', $session_id);
		$this->session_id = $session_id;
	}

	private function getSessionId() : string
	{
		return getSession('session_id') ? getSession('session_id') : $this->session_ids;
	}
}