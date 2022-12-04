<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body >
<h1 align="center">List of Student</h1>
<table border="1" align="center">
    <thead>
                    <tr>
                        <th>IDNO</th>
                        <th>Student Name</th>
                        <th>Semester</th>
                        <th>AY</th>
                        <th>Course/Yr</th>
                        
                    </tr>   
                  </thead>
<?php 
                     global $mydb;
                  

                            $res = $mydb->setQuery("SELECT * FROM schoolyr, course where schoolyr.COURSE_ID = course.COURSE_ID AND course.COURSE_ID='{$_GET['course']}' and AY='{$_GET['ay']}' and SEMESTER='{$_GET['sem']}' ");
                           $row_cnt = $mydb->num_rows();
                            if ($row_cnt > 0) {
                            $cur = $mydb->loadResultList();
                            foreach ($cur as $sy) {
                            echo '<tr>';
                            echo '<td width="10%">'. $sy->IDNO.'</td>';
                            echo '<td width="25%">'. $sy->STUDENTNAME.'</td>';
                            echo '<td width="15%">'. $sy->SEMESTER.'</td>';
                            echo '<td width="15%">' . $sy->AY.'</a></td>';
                            echo '<td  width="25%">'.$sy->COURSE_NAME .'-' . $sy->COURSE_LEVEL.'</td>';
                        
                            
                            echo '</tr>';
        

                            } 
       
                            }else{
                            message("No results found!","info");
                        //    redirect('index.php');   
                                    
                            }
                   
                        
                    
                    ?>  
</table>

</body>
</html>


       <script>
function tablePrint(){  
    var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
    display_setting+="scrollbars=no,width=500, height=500, left=100, top=25";  
    var content_innerhtml = document.getElementById("printout").innerHTML;  
    var document_print=window.open("","",display_setting);  
    document_print.document.open();  
    document_print.document.write('<body style="font-family:verdana; font-size:12px;" onLoad="self.print();self.close();" >');  
    document_print.document.write(content_innerhtml);  
    document_print.document.write('</body></html>');  
    document_print.print();  
    document_print.document.close();  
    return false;  
    } 
    $(document).ready(function() {
        oTable = jQuery('#studentlogs').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
        } );
    }); 
</script>