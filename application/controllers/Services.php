<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $soap_name = 'vexanium';
        $soap_urn = 'urn:' . $soap_name;
        $this->server = new nusoap_server();  
        $this->server->configureWSDL("Vexanium Web Service", $soap_urn);

        $input_supply = array('supply' => 'xsd:integer');
        $output_supply = array('data' => 'xsd:integer');
        $this->server->register(
            "get_supply",           // method name
            $input_supply,          // input parameters
            $output_supply,         //  output parameters
            $soap_urn,              // namespace
            "$soap_urn#get_supply", // soapaction
            'rpc', // style
            'encoded', // use
            'Return information on the current circulating supply vexanium.' // documentation

        );

        $input_supply = array('tot_supply' => 'xsd:integer');
        $output_supply = array('data' => 'xsd:integer');
        $this->server->register(
            "get_total_supply",           // method name
            $input_supply,          // input parameters
            $output_supply,         //  output parameters
            $soap_urn,              // namespace
            "$soap_urn#get_total_supply", // soapaction
            'rpc', // style
            'encoded', // use
            'Return information on the current total supply vexanium.' // documentation

        );
    }
    public function index() {  
    
        // Mengatur bagian halaman pada user$this->load->view('welcome_message');
		function get_supply($supply) {
            $api_url = "https://explorer.vexanium.com/api/v1/get_vex_token";

            $vex_data = json_decode(file_get_contents($api_url), true);
            $supply = $vex_data[0]['supply'];
            return $supply;
        }

        function get_total_supply() {
            $api_url = "https://explorer.vexanium.com/api/v1/get_vex_token";

            $vex_data = json_decode(file_get_contents($api_url), true);
            $tot_supply = $vex_data[0]['max_supply'];
            return $tot_supply;
        }
        $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA:'';
        $this->server->service(file_get_contents("php://input"));
	}

    // Direct menuju halaman supply
    public function supply() {
        $this->load->view('v_supply');
    }

    // Direct menuju halaman total supply
    public function total_supply() {
        $this->load->view('v_totalsupply');
    }
}
