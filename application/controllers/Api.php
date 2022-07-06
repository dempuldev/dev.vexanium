<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

// Loading controller services
include_once (dirname(__FILE__) . "/Services.php");
class Api extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }
    // Direct menuju halaman supply
    public function supply() {
        // $this->load->view('v_supply');
        $wsdl  = base_url("/index.php?wsdl");
        $client = new nusoap_client($wsdl, true);

        // Check for an error
        $err = $client->getError();
        if ($err) {
            // Display the error
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
            // At this point, you know the call that follows will fail
        }

        $result = $client->call('supply');

        // Check for a fault
        if ($client->fault) {
            echo '<h2>Fault</h2><pre>';
            print_r($result);
            echo '</pre>';
        } else {
            // Check for errors
            $err = $client->getError();
            if ($err) {
                // Display the error
                echo '<h2>Error</h2><pre>' . $err . '</pre>';
            } else {
                // Display the result
                $response = sprintf("%01.4f", $result);
                echo $response;

            }
            // $response = sprintf("%01.4f", $result);
            // echo $response;
        }
        // Display the request and response
        // echo '<h2>Request</h2>';
        // echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        // echo '<h2>Response</h2>';
        // echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
    }

    // Direct menuju halaman total supply
    public function total_supply() {
        // $this->load->view('v_totalsupply');
        $wsdl  = base_url("/index.php?wsdl");
        $client = new nusoap_client($wsdl, true);
        // $err = $client->getError();
        // if ($err) {
        //     return false;
        // }

        $result = $client->call('total_supply');

        // Check for a fault
        if ($client->fault) {
            // echo '<h2>Fault</h2><pre>';
            // print_r($result);
            // echo '</pre>';

            echo "Fault: <p> Code: (". $client->faultcode .")</p> ";
            echo "String: " . $client->faultstring;
            } else {
                // Check for errors
                $err = $client->getError();
                if ($err) {
                    // Display the error
                    echo '<h2>Error</h2><pre>' . $err . '</pre>';
                } else {
                    // Display the result
                    // echo '<h2>Result</h2><pre>';
                    // echo number_format((float) $result, 2, '.', ''); 
                    $response = sprintf("%01.4f", $result);
                    echo $response;

                }
                // $response = sprintf("%01.4f", $result);
                // echo $response;
            }
        }
    }

?>