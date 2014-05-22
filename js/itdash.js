
function loadServiceProvidersXML(x_func) {
  xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=x_func;
  xmlhttp.open("POST","http://workbooks.rsb.anu.edu.au/mis/service_providersXML.php",true);
  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
/*            xmlhttp.setRequestHeader("Content-length", v_params.length); */
  xmlhttp.setRequestHeader("Connection", "close");
  xmlhttp.send();
}

function loadStaffMembersXML(x_sp, x_func) {
  var v_params = "x_sp="+x_sp;
  xmlhttp2=new XMLHttpRequest();
  xmlhttp2.onreadystatechange=x_func;
  xmlhttp2.open("POST","http://workbooks.rsb.anu.edu.au/mis/user_groupsXML.php",true);
  xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp2.setRequestHeader("Content-length", v_params.length);
  xmlhttp2.setRequestHeader("Connection", "close");
  xmlhttp2.send(v_params);
}

function loadJobSummaryXML(x_sp, x_staff, x_func) {
  var v_params = "x_sp="+x_sp+"&x_staff="+x_staff;
  xmlhttp2=new XMLHttpRequest();
  xmlhttp2.onreadystatechange=x_func;
  xmlhttp2.open("POST","http://workbooks.rsb.anu.edu.au/mis/dashboard/public_html/php/job_summaryXML.php",true);
  xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttp2.setRequestHeader("Content-length", v_params.length);
  xmlhttp2.setRequestHeader("Connection", "close");
  xmlhttp2.send(v_params);
    
}

function loadServiceProviders()
{
  loadServiceProvidersXML(function()
  {

    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      var v_row = xmlhttp.responseXML.getElementsByTagName('ROW');
      var v_select = document.getElementById("sp_select");

      for(i=0;i<v_row.length;i++) {
          var option=document.createElement('option');
          option.text = v_row[i].getElementsByTagName('dv_u_name')[0].firstChild.nodeValue;
          option.value = v_row[i].getElementsByTagName('sys_id')[0].firstChild.nodeValue;
          v_select.add(option, 0);
      }
    }
  });
}

function loadStaffMembers(x_sp) {
  loadStaffMembersXML(x_sp, function()
  {
    if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    {
      var v_row = xmlhttp2.responseXML.getElementsByTagName('ROW');
      /* Add the ALL option */
      var v_select = document.getElementById("staff_select");
      var option=document.createElement('option');
      option.text = "All staff members";
      option.value = -1;
      v_select.add(option, 0);
      for (i=0; i<v_row.length; i++) {
          var option=document.createElement('option');
          option.text = v_row[i].getElementsByTagName('dv_name')[0].firstChild.nodeValue;
          option.value = v_row[i].getElementsByTagName('user')[0].firstChild.nodeValue;
          v_select.add(option, 0);
      }
    }
  });
}

function loadJobSummary(x_sp, x_staff) {
  loadJobSummaryXML(x_sp, x_staff, function()
  {
    if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
    {
      var v_row = xmlhttp2.responseXML.getElementsByTagName('SUMMARY');
      /*
       * First clear the fields before populating
       */
      document.getElementById("num_incidents").innerHTML = '&nbsp;';
      document.getElementById("num_requests").innerHTML = '&nbsp;';
      document.getElementById("num_incidents_assigned").innerHTML = '&nbsp;';
      document.getElementById("num_requests_assigned").innerHTML = '&nbsp;';
      
      document.getElementById("num_incidents").innerHTML = v_row[0].getElementsByTagName('incident_count')[0].firstChild.nodeValue;
      document.getElementById("num_requests").innerHTML = v_row[0].getElementsByTagName("request_count")[0].firstChild.nodeValue;
      if (v_row[0].getElementsByTagName('incident_assigned_to')[0].firstChild)
        document.getElementById("num_incidents_assigned").innerHTML = v_row[0].getElementsByTagName('incident_assigned_to')[0].firstChild.nodeValue;
      if (v_row[0].getElementsByTagName('request_assigned_to')[0].firstChild)
        document.getElementById("num_requests_assigned").innerHTML = v_row[0].getElementsByTagName('request_assigned_to')[0].firstChild.nodeValue;
            
      /* Now populate the tabs based on the data */
      var v_html_new, v_html_ip, v_html_monitor, v_html_customer, v_html_third, v_html_resolved, v_html_tmp;
      v_html_new = "<table><tr class='ui-widget-header'><th>Type</th><th>Job</th><th>Logged By</th><th>Assigned To</th><th>Description</th><th>Opened On</th><th>Updated</th><th>Due Date</th></tr>";
      v_html_ip = v_html_new;
      v_html_monitor = v_html_new;
      v_html_customer = v_html_new;
      v_html_third = v_html_new;
      v_html_resolved = v_html_new;
      var v_html_wtask = "<table><tr class='ui-widget-header'><th>Type</th><th>Job</th><th>Parent</th><th>Assigned To</th><th>Description</th><th>Opened On</th><th>Updated</th></tr>";
      var v_html_new_count = 0;
      var v_html_ip_count = 0;
      var v_html_monitor_count = 0;
      var v_html_customer_count = 0;
      var v_html_third_count = 0;
      var v_html_resolved_count = 0;
      var v_html_wtask_count = 0;
      
      var v_row = xmlhttp2.responseXML.getElementsByTagName('ROW');
      var v_type;
      for (i = 0; i < v_row.length; i++) {
          if (v_row[i].getElementsByTagName('incidentNumber')[0].firstChild.nodeValue.substring(0, 3) == 'INC')
            v_type = "Incident";
          else if (v_row[i].getElementsByTagName('incidentNumber')[0].firstChild.nodeValue.substring(0, 3) == 'REQ')
            v_type = "Request";
          else
            v_type = "Work Task";
          v_html_tmp = "<tr>";
          v_html_tmp += "<td class='ui-widget-content'>"+v_type+"</td>";
          v_sys_id = v_row[i].getElementsByTagName('sys_id')[0].firstChild.nodeValue;
          /* https://itservicedesk.anu.edu.au//nav_to.do?uri=task.do%3Fsys_id=85c84621942815c04ee6204ab6d248d3%26sysparm_stack=home.do */
          v_html_tmp += "<td class='ui-widget-content'><a href='https://itservicedesk.anu.edu.au//nav_to.do?uri=task.do%3Fsys_id="+v_sys_id+"%26sysparm_stack=home.do' target=_new>"+v_row[i].getElementsByTagName('incidentNumber')[0].firstChild.nodeValue+"</a></td>";
          if (v_type == "Work Task") {
              v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('primaryJob')[0].firstChild.nodeValue+"</td>";
          } else {
            if (v_row[i].getElementsByTagName('requestedBy')[0].firstChild)
              v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('requestedBy')[0].firstChild.nodeValue+"</td>";
            else
              v_html_tmp += "<td>&nbsp;</td>";
          }
          if (v_row[i].getElementsByTagName('assignedTo')[0].firstChild)
            v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('assignedTo')[0].firstChild.nodeValue+"</td>";
          else
            v_html_tmp += "<td>&nbsp;</td>";
          if (v_row[i].getElementsByTagName('shortDescription')[0].firstChild)
            v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('shortDescription')[0].firstChild.nodeValue+"</td>";
          else
            v_html_tmp += "<td class='ui-widget-content'>&nbsp;</td>";
          v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('openedOn')[0].firstChild.nodeValue+"</td>";
          if (v_row[i].getElementsByTagName('updatedOn')[0].firstChild)
            v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('updatedOn')[0].firstChild.nodeValue+"</td>";
          else
            v_html_tmp += "<td>&nbsp;</td>";
        
          if (v_row[i].getElementsByTagName('dueDate').length > 0)
              if (v_row[i].getElementsByTagName('dueDate')[0].firstChild)
                v_html_tmp += "<td class='ui-widget-content'>"+v_row[i].getElementsByTagName('dueDate')[0].firstChild.nodeValue+"</td>";
              else
                v_html_tmp += "<td>&nbsp;</td>"
          else
              v_html_tmp += "<td>&nbsp;</td>"
        
          v_html_tmp += "</tr>";
          if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "New") {
              v_html_new += v_html_tmp;
              v_html_new_count += 1;
          } else if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "In Progress") {
              v_html_ip += v_html_tmp;
              v_html_ip_count += 1;
          } else if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "Monitoring") {
              v_html_monitor += v_html_tmp;
              v_html_monitor_count += 1;
          } else if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "Awaiting Customer") {
              v_html_customer += v_html_tmp;
              v_html_customer_count += 1;
          } else if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "Awaiting 3rd Party") {
              v_html_third += v_html_tmp;
              v_html_third_count += 1;
          } else if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "Awaiting 3rd party") {
              v_html_third += v_html_tmp;
              v_html_third_count += 1;
          } else if (v_row[i].getElementsByTagName('statusName')[0].firstChild.nodeValue == "Resolved") {
              v_html_resolved += v_html_tmp;
              v_html_resolved_count += 1;
          } else {
              v_html_wtask += v_html_tmp;
              v_html_wtask_count += 1;
          }
      }
      document.getElementById("tabs-new").innerHTML = v_html_new + "</table>";
      document.getElementById("spn-new").innerHTML = "New (" + v_html_new_count + ")";
      document.getElementById("tabs-in-progress").innerHTML = v_html_ip + "</table>";
      document.getElementById("spn-ip").innerHTML = "In Progress (" + v_html_ip_count + ")";
      document.getElementById("tabs-monitor").innerHTML = v_html_monitor + "</table>";
      document.getElementById("spn-monitor").innerHTML = "Monitor (" + v_html_monitor_count + ")";
      document.getElementById("tabs-customer").innerHTML = v_html_customer + "</table>";
      document.getElementById("spn-customer").innerHTML = "Awaiting Customer (" + v_html_customer_count + ")";
      document.getElementById("tabs-third").innerHTML = v_html_third + "</table>";
      document.getElementById("spn-third").innerHTML = "3rd Party (" + v_html_third_count + ")";
      document.getElementById("tabs-resolved").innerHTML = v_html_resolved + "</table>";
      document.getElementById("spn-resolved").innerHTML = "Resolved (" + v_html_resolved_count + ")";
      document.getElementById("tabs-wtask").innerHTML = v_html_wtask + "</table>";
      document.getElementById("spn-wtask").innerHTML = "Work Tasks (" + v_html_wtask_count + ")";
      document.getElementById("loading").style.cssText = "display: none";
      document.getElementById("go_button").disabled = "";
    }
  });
}