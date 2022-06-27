<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

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
        $err = $client->getError();
        if ($err) {
            return false;
        }

        $result = $client->call('get_supply');

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
                // echo '<h2>Result</h2><pre>';
                echo number_format((float) $result, 2, '.', ''); 
            }
        }
    }

    // Direct menuju halaman total supply
    public function total_supply() {
        // $this->load->view('v_totalsupply');
        $wsdl  = base_url("/index.php?wsdl");
        $client = new nusoap_client($wsdl, true);
        $err = $client->getError();
        if ($err) {
            return false;
        }

        $result = $client->call('total_supply');

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
                    // echo '<h2>Result</h2><pre>';
                    echo number_format((float) $result, 2, '.', ''); 
                }
            }
        }
    }

?>