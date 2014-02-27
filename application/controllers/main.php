<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function  __construct(){
    parent::__construct();
    $this->calendar = $this->config->item('weekDays');
    date_default_timezone_set('America/Los_Angeles');
    }

    public function index()
    {
        $supData['days'] = $this->calendar;

        // get suppliers for today
        $today = array_search(date('l'), $this->calendar);
        $supData['today'] = $today;

        $this->load->model('supplier_model','supplier');
        $data['suppliers'] = $this->supplier->getSupplierForDate($today);
        $data['newSupplierView'] = $this->load->view('dialogs/supplier',$supData, true);
        $data['newVisitView'] = $this->load->view('dialogs/visit','', true);



        $data['styles'] = array('visit');
        $data['scripts'] = array('visit');
        $data['view'] = $this->load->view('visit',$data, true);
        $this->renderer->renderPage($data);
    }

    public function testSearch()
    {
        $data['styles'] = array('typeahead');
        $data['scripts'] = array('typeahead','hogan','searchTest');
        $data['view'] = $this->load->view('test/search',$data, true);
        $this->renderer->renderPage($data);
    }

    public function testSearchJSON()
    {
        $arr[0] = array('value' => 'Star Wars',
                     'tokens'=> array('Star', 'Wars'),
                     'name' => 'Star Wars',
                     'id' => 3);

        $arr[1] = array('value' => 'John Smith',
                     'tokens'=> array('John', 'Smith'),
                     'name' => 'John Smith',
                     'id' => 2);


        $arr[2] = array('value' => 'Krish Sumaroo',
                     'tokens'=> array('Krish', 'Sumaroo'),
                     'name' => 'Krish Sumaroo',
                     'id' => 1);


        echo json_encode($arr);
    }
}

