<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Loading controller api
include_once (dirname(__FILE__) . "/Api.php");

class Services extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $soap_name = 'vexanium';
        $soap_urn = 'urn:' . $soap_name;
        $this->server = new nusoap_server();  
        $this->server->configureWSDL("Vexanium Web Service", $soap_urn);

        $input_supply = array('supply' => 'xsd:decimal');
        $output_supply = array('data' => 'xsd:decimal');
        $this->server->register(
            "supply",           // method name
            $input_supply,          // input parameters
            $output_supply,         //  output parameters
            $soap_urn,              // namespace
            "$soap_urn#supply", // soapaction
            'rpc', // style
            'encoded', // use
            'Return information on the current circulating supply vexanium.' // documentation

        );

        $input_supply = array('total_supply' => 'xsd:decimal');
        $output_supply = array('data' => 'xsd:decimal');
        $this->server->register(
            "total_supply",           // method name
            $input_supply,          // input parameters
            $output_supply,         //  output parameters
            $soap_urn,              // namespace
            "$soap_urn#total_supply", // soapaction
            'rpc', // style
            'encoded', // use
            'Return information on the current total supply vexanium.' // documentation

        );
    }
    public function index() {  
    
        // Mengatur bagian halaman pada user$this->load->view('welcome_message');
		function supply() {
            // $api_url = "https://explorer.vexanium.com/api/v1/get_vex_token";

            // $vex_data = json_decode(file_get_contents($api_url), true);
            // $supply = $vex_data[0]['supply'];
            // return $supply;

            // Penggunaan curl untuk panggil api endpoint
            $api_url = "https://explorer.vexanium.com/api/v1/get_vex_token";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);

            // Mendapatkan data
            $response_data = json_decode($response, true);
            $supply = $response_data[0]['supply'];
            return $supply;
            
        }

        function total_supply() {
            // $api_url = "https://explorer.vexanium.com/api/v1/get_vex_token";

            // $vex_data = json_decode(file_get_contents($api_url), true);
            // $total_supply = $vex_data[0]['max_supply'];
            // return $total_supply;

            // Penggunaan curl untuk panggil api endpoint
            $api_url = "https://explorer.vexanium.com/api/v1/get_vex_token";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);

            // Mendapatkan data
            $response_data = json_decode($response, true);
            $total_supply = $response_data[0]['max_supply'];
            return $total_supply;
        }
        $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA:'';
        $this->server->service(file_get_contents("php://input"));
	}
}