<?php

global $dom, $rowset;

function add_totals($x_inc_stats, $x_req_stats, $rowset, $dom) {
  $sumrow = $rowset->appendChild($dom->createElement('SUMMARY'));
  $newelement = $sumrow->appendChild($dom->createElement('incident_count'));
  $newelement->appendChild($dom->createTextNode($x_inc_stats["logged"]));
  $newelement = $sumrow->appendChild($dom->createElement('incident_assigned_to'));
  $newelement->appendChild($dom->createTextNode($x_inc_stats["assigned_to"]));
  $newelement = $sumrow->appendChild($dom->createElement('request_count'));
  $newelement->appendChild($dom->createTextNode($x_req_stats["logged"]));
  $newelement = $sumrow->appendChild($dom->createElement('request_assigned_to'));
  $newelement->appendChild($dom->createTextNode($x_req_stats["assigned_to"]));
}

function add_single($x_datarec, $rowset, $dom, $x_rownum) {

    $row = $rowset->appendChild($dom->createElement('ROW'));
    $row->setAttribute('number', $x_rownum);
    $newelement = $row->appendChild($dom->createElement('incidentNumber'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_number']));

    $newelement = $row->appendChild($dom->createElement('sys_id'));
    $newelement->appendChild($dom->createTextNode($x_datarec['sys_id']));

    $newelement = $row->appendChild($dom->createElement('shortDescription'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_short_description']));

    $newelement = $row->appendChild($dom->createElement('requestedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_requestor']));

    $newelement = $row->appendChild($dom->createElement('openedOn'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_opened_at']));

    $newelement = $row->appendChild($dom->createElement('openedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_opened_by']));

    $newelement = $row->appendChild($dom->createElement('businessService'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_business_service']));

    $newelement = $row->appendChild($dom->createElement('category'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_category']));

    $newelement = $row->appendChild($dom->createElement('statusName'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_state']));

    $newelement = $row->appendChild($dom->createElement('statusCode'));
    $newelement->appendChild($dom->createTextNode($x_datarec['state']));

    $newelement = $row->appendChild($dom->createElement('assignedTo'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_assigned_to']));

    $newelement = $row->appendChild($dom->createElement('updatedOn'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_sys_updated_on']));

    $newelement = $row->appendChild($dom->createElement('updatedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_sys_updated_by']));

    $newelement = $row->appendChild($dom->createElement('contactType'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_contact_type']));

    $newelement = $row->appendChild($dom->createElement('priority'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_priority']));

    $newelement = $row->appendChild($dom->createElement('impact'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_impact']));

    $newelement = $row->appendChild($dom->createElement('escalation'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_escalation']));

    $newelement = $row->appendChild($dom->createElement('serviceProvider'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_service_provider']));
    
    $newelement = $row->appendChild($dom->createElement('dueDate'));
    if (substr($x_datarec['dv_number'], 0, 3) == 'REQ')
      $newelement->appendChild($dom->createTextNode($x_datarec['due_date']));
}

function add_single_wt($x_datarec, $rowset, $dom, $x_rownum) {
    $row = $rowset->appendChild($dom->createElement('ROW'));
    $row->setAttribute('number', $x_rownum);
    $newelement = $row->appendChild($dom->createElement('incidentNumber'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_number']));

    $newelement = $row->appendChild($dom->createElement('sys_id'));
    $newelement->appendChild($dom->createTextNode($x_datarec['sys_id']));

    $newelement = $row->appendChild($dom->createElement('shortDescription'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_short_description']));

    $newelement = $row->appendChild($dom->createElement('requestedBy'));
    // $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_requestor']));

    $newelement = $row->appendChild($dom->createElement('openedOn'));
    $newelement->appendChild($dom->createTextNode($x_datarec['opened_at']));

    $newelement = $row->appendChild($dom->createElement('openedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_opened_by']));

    $newelement = $row->appendChild($dom->createElement('businessService'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_business_service']));

    $newelement = $row->appendChild($dom->createElement('category'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['dv_category']));

    $newelement = $row->appendChild($dom->createElement('statusName'));
    $newelement->appendChild($dom->createTextNode('WorkTask'));

    $newelement = $row->appendChild($dom->createElement('statusCode'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['state']));

    $newelement = $row->appendChild($dom->createElement('assignedTo'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_assigned_to']));

    $newelement = $row->appendChild($dom->createElement('updatedOn'));
    $newelement->appendChild($dom->createTextNode($x_datarec['sys_updated_on']));

    $newelement = $row->appendChild($dom->createElement('updatedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_sys_updated_by']));

    $newelement = $row->appendChild($dom->createElement('contactType'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['dv_contact_type']));

    $newelement = $row->appendChild($dom->createElement('priority'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['dv_priority']));

    $newelement = $row->appendChild($dom->createElement('impact'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['dv_impact']));

    $newelement = $row->appendChild($dom->createElement('escalation'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['dv_escalation']));

    $newelement = $row->appendChild($dom->createElement('serviceProvider'));
    //$newelement->appendChild($dom->createTextNode($x_datarec['dv_u_service_provider']));

    $newelement = $row->appendChild($dom->createElement('primaryJob'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_primary_task']));
}

$dom = new DOMDocument("1.0");
$rowset = $dom->appendChild($dom->createElement('ROWSET'));

$x_sp = false;
if (isset($_POST["x_sp"]))
    $x_sp = $_POST["x_sp"];
$x_staff = $_POST["x_staff"];

$v_inc_stats = array();
$v_req_stats = array();
$v_unique_jobs = array();
  /*
   * Get incidents
   */
    $v_wsurl = "https://itservicedesk.anu.edu.au/incident.do?displayvalue=all&WSDL";
    $v_client = new SoapClient($v_wsurl, array(
        "login" => "A371615",
        "password" => "JPKbgYsEYw-6",
        "tableName" => "incident"
            )
    );
    if ($x_staff == "-1") {
      $v_result = $v_client->__soapCall("getKeys", array("getKeys" => array("u_service_provider" => $x_sp, "active" => "true",
              "uri" => "http://www.servicenow.com/incident")));
      $v_inc_array = explode(",", $v_result->sys_id);
      $v_inc_stats["logged"] = count($v_inc_array);
    }
    else {
      $v_result = $v_client->__soapCall("getKeys", array("getKeys" => array("u_service_provider" => $x_sp, 
                                                                             "u_requestor" => "{$x_staff}",
                                                                             "active" => "true",
                                                                             "uri" => "http://www.servicenow.com/incident")));

      if ($v_result->sys_id == NULL)
          $v_inc_stats["logged"] = 0;
      else {
        $v_inc_array = explode(",", $v_result->sys_id);
        $v_inc_stats["logged"] = count($v_inc_array);
      }
      $v_result2 = $v_client->__soapCall("getKeys", array("getKeys" => array("u_service_provider" => $x_sp, 
                                                                             "assigned_to" => "{$x_staff}",
                                                                             "active" => "true",
                                                                             "uri" => "http://www.servicenow.com/incident")));
      if ($v_result2->sys_id == NULL)
          $v_inc_stats["assigned_to"] = 0;
      else {
        $v_inc_array2 = explode(",", $v_result2->sys_id);
        $v_inc_stats["assigned_to"] = count($v_inc_array2);
      }
    }
    

    /*
     * Get requests
     */
    $v_wsurl = "https://itservicedesk.anu.edu.au/u_request.do?displayvalue=all&WSDL";
    $v_client = new SoapClient($v_wsurl, array(
        "login" => "A371615",
        "password" => "JPKbgYsEYw-6",
        "tableName" => "u_request"
            )
    );

    if ($x_staff == "-1")
      $v_result = $v_client->__soapCall("getKeys", array("getKeys" => array("u_service_provider" => $x_sp, "active" => "true",
              "uri" => "http://www.servicenow.com/u_request")));
    else {
      $v_result = $v_client->__soapCall("getKeys", array("getKeys" => array("u_service_provider" => $x_sp, 
                                                                            "u_requestor" => "{$x_staff}",
                                                                            "active" => "true",
                                                                            "uri" => "http://www.servicenow.com/u_request")));

      $v_result2 = $v_client->__soapCall("getKeys", array("getKeys" => array("u_service_provider" => $x_sp, 
                                                                            "assigned_to" => "{$x_staff}",
                                                                            "active" => "true",
                                                                            "uri" => "http://www.servicenow.com/u_request")));

      $v_req_array2 = explode(",", $v_result2->sys_id);
      $v_req_stats["assigned_to"] = count($v_req_array2);
    }
    $v_req_array = explode(",", $v_result->sys_id);
    $v_req_stats["logged"] = count($v_req_array);
    
    add_totals($v_inc_stats, $v_req_stats, $rowset, $dom);
    
    /* Go through all the arrays and get the data from service now.
     * Data will be added to the XML to be sent back to the calling program
     * to be loaded into the agent.
     */
    $v_wsurl = "https://itservicedesk.anu.edu.au/incident.do?displayvalue=all&WSDL";
    $v_client = new SoapClient($v_wsurl, array(
        "login" => "A371615",
        "password" => "JPKbgYsEYw-6",
        "tableName" => "incident"
            )
    );
    $v_lastcount = 0;
    foreach ($v_inc_array as $v_datavalue) {
        if ($v_datavalue != "") {
            $v_lastcount ++;
            $v_result = $v_client->__soapCall("get", array("get" => array("sys_id" => $v_datavalue,
                    "uri" => "http://www.servicenow.com/u_incident")));
            $v_recarray = objectToArray($v_result);
            if (!isset($v_unique_jobs[$v_recarray['dv_number']])) {
              add_single($v_recarray, $rowset, $dom, $v_lastcount);
              $v_unique_jobs[$v_recarray['dv_number']] = 1;
            }
        }
    }
    foreach ($v_inc_array2 as $v_datavalue) {
        if ($v_datavalue != "") {
            $v_lastcount ++;
            $v_result = $v_client->__soapCall("get", array("get" => array("sys_id" => $v_datavalue,
                    "uri" => "http://www.servicenow.com/u_incident")));
            $v_recarray = objectToArray($v_result);
            if (!isset($v_unique_jobs[$v_recarray['dv_number']])) {
              add_single($v_recarray, $rowset, $dom, $v_lastcount);
              $v_unique_jobs[$v_recarray['dv_number']] = 1;
            }
        }
    }
    $v_wsurl = "https://itservicedesk.anu.edu.au/u_request.do?displayvalue=all&WSDL";
    $v_client = new SoapClient($v_wsurl, array(
        "login" => "A371615",
        "password" => "JPKbgYsEYw-6",
        "tableName" => "u_request"
            )
    );
    foreach ($v_req_array as $v_datavalue) {
        if ($v_datavalue != "") {
            $v_lastcount ++;
            $v_result = $v_client->__soapCall("get", array("get" => array("sys_id" => $v_datavalue,
                    "uri" => "http://www.servicenow.com/u_request")));
            $v_recarray = objectToArray($v_result);
            if (!isset($v_unique_jobs[$v_recarray['dv_number']])) {
              add_single($v_recarray, $rowset, $dom, $v_lastcount);
              $v_unique_jobs[$v_recarray['dv_number']] = 1;
            }
        }
    }
    foreach ($v_req_array2 as $v_datavalue) {
        if ($v_datavalue != "") {
            $v_lastcount ++;
            $v_result = $v_client->__soapCall("get", array("get" => array("sys_id" => $v_datavalue,
                    "uri" => "http://www.servicenow.com/u_request")));
            $v_recarray = objectToArray($v_result);
            if (!isset($v_unique_jobs[$v_recarray['dv_number']])) {
              add_single($v_recarray, $rowset, $dom, $v_lastcount);
              $v_unique_jobs[$v_recarray['dv_number']] = 1;
            }
        }
    }
    
    if ($x_staff != "-1") {
        /* Now get all the work tasks assigned to you */
        $v_wsurl = "https://itservicedesk.anu.edu.au/u_work_task.do?displayvalue=all&WSDL";
        $v_client = new SoapClient($v_wsurl, array(
            "login" => "A371615",
            "password" => "JPKbgYsEYw-6",
            "tableName" => "u_work_task"
                )
        );
        $v_result = $v_client->__soapCall("getRecords", array("getRecords" => array("assigned_to" => $x_staff,
                                                                                    "active" => "true",
                        "uri" => "http://www.servicenow.com/u_work_task")));
        $v_recarray = objectToArray($v_result->getRecordsResult);
        if (!is_null($v_recarray)) {
            if (!is_array($v_result->getRecordsResult)) {
                $v_lastcount ++;
                add_single_wt($v_recarray, $rowset, $dom, $v_lastcount);
            } else {
                foreach ($v_recarray as $v_datakey => $v_datavalue) {
                    $v_lastcount ++;
                    add_single_wt($v_datavalue, $rowset, $dom, $v_lastcount);
                }
            }
        }

        $v_result = $v_client->__soapCall("getRecords", array("getRecords" => array("opened_by" => $x_staff,
                                                                                    "active" => "true",
                        "uri" => "http://www.servicenow.com/u_work_task")));
        $v_recarray = objectToArray($v_result->getRecordsResult);
        if (!is_null($v_recarray)) {
            if (!is_array($v_result->getRecordsResult)) {
                  $v_lastcount ++;
                  add_single_wt($v_recarray, $rowset, $dom, $v_lastcount);
            } else {
                foreach ($v_recarray as $v_datakey => $v_datavalue) {
                      $v_lastcount ++;
                      add_single_wt($v_datavalue, $rowset, $dom, $v_lastcount);
                }
            }
        }
    }


$dom->formatOutput = true;
header("Content-type: text/xml");
echo $dom->saveXML();



function objectToArray($d) {
    if (is_object($d)) {
        $d = get_object_vars($d);
    }
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

?>
