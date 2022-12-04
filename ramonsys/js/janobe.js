 
$(document).on("click", ".MEALID", function () { 

    var id = $(this).data('id');
    // alert(id)
    $(".modal-body #mealid").val( id );
}); 
        
$(document).ready(function() {
    $('#dash-table').DataTable({
                responsive: true ,
                  "sort": false
        });
 
});

// ********************************************************************************
//validate the amount tender berfore submitting in the cashie side 

        $(document).on("keyup", "#tenderamount",function(){
            var totalamount = $("#totalamount").val();
            var tenderamount = $("#tenderamount").val();
            var sukli;


            sukli = tenderamount - totalamount;

            $("#sukli").val(sukli.toFixed(2));

            // alert(totalamount);
            if (tenderamount==0 || tenderamount == "") {
                $("#sukli").val("0.00");
            }

        });


        $(document).on("click", "#save" ,function(){

             var totalamount = $("#totalamount").val();
             var tenderamount = $("#tenderamount").val();
             var sukli = $("#sukli").val();



                $("#errortrap").hide(); 

             if (tenderamount=='' || tenderamount <= 0 || totalamount <=0) {
                $("#errortrap").css({ 
                            "background" :"red",
                            "color"      : "#fff",
                            "padding"    : "2px",
                            "padding-left" : "3px;",
                            "padding-right" : "3px",
                            "font-size"    : "11px"
                          });
                $("#errortrap").fadeIn("slow"); 
                $("#errortrap").html("Please enter amount.");
                return false;
             }else if (sukli < 0) {
              $("#errortrap").css({ 
                            "background" :"red",
                            "color"      : "#fff",
                            "padding"    : "2px",
                            "padding-left" : "3px;",
                            "padding-right" : "3px",
                            "font-size"    : "11px"
                          });
                $("#errortrap").fadeIn("slow"); 
                $("#errortrap").html("Enter amount is less than to the total amount.");
                return false;
             }

 

        }); 
//end of validate the amount tender berfore submitting in the cashie side 
// ***************************************************************************************************
 
// for the event handler for the text quantity in the orderlist for the cashie side 
        $(document).on("keyup",".orderqty", function(){

            var id = $(this).data("id");
            var inptqty = document.getElementById(id+"orderqty").value;
            var price =  document.getElementById(id+'orderprice').value;
            var subtot; 

             // alert(price)


            $.ajax({
                type:"POST",
                url:  "controller.php?action=edit",
                dataType: "text",
                data:{ORDERID:id,QTY:inptqty,PRICE:price},
                success: function(data) {
                  // alert(data); 

                     subtot = parseFloat(price) * parseFloat(inptqty); 
            
                      document.getElementById('Osubtot'+id).value  =    subtot;

                      var table = document.getElementById('table');
                      var items = table.getElementsByTagName('output');

                      var sum = 0;
                      for(var i=0; i<items.length; i++)
                          sum +=   parseFloat(items[i].value);

                      var output = document.getElementById('totamnt');
                      // output.innerHTML =  sum.toFixed(2);
                      output.value = sum.toFixed(2);

                      document.getElementById("totalamount").value = sum;
                }


            });


        });

        $(document).on("change",".orderqty", function(){

            var id = $(this).data("id");
            var inptqty = document.getElementById(id+"orderqty").value;
            var price =  document.getElementById(id+'orderprice').value;
            var subtot; 

             // alert(price)
 
            $.ajax({
                type:"POST",
                url:  "controller.php?action=edit",
                dataType: "text",
                data:{ORDERID:id,QTY:inptqty,PRICE:price},
                success: function(data) {
                  // alert(data); 
                  
                     subtot = parseFloat(price) * parseFloat(inptqty); 
            
                      document.getElementById('Osubtot'+id).value  =    subtot;

                      var table = document.getElementById('table');
                      var items = table.getElementsByTagName('output');

                      var sum = 0;
                      for(var i=0; i<items.length; i++)
                          sum +=   parseFloat(items[i].value);

                      var output = document.getElementById('totamnt');
                      // output.innerHTML =  sum.toFixed(2);
                      output.value = sum.toFixed(2);

                      document.getElementById("totalamount").value = sum;
                }


            });


        });
$(document).on("click", ".orderqty", function () { 
  $(this).select();
 
}); 
// end of the event handler for the text quantity in the orderlist for the cashie side 
// ***************************************************************************************

// event handler for the pos in the cashier side
 
$(document).on("keypress", "#tenderamount", function (event) { 
 
      var tenderamount =  document.getElementById('tenderamount').value
 
      if(event.which < 46 || event.which >= 58 || event.which == 47){
          event.preventDefault();
      }

      if(event.which == 46 && $(tenderamount).val().indexOf('.') != -1){
          tenderamount.value = '';
      }

      return true;
       
 
}); 

$(document).on("keydown", "#tenderamount", function (event) {  
  return true;
}); 
 
$(document).on("click", "#tenderamount", function () { 
  $(this).select();
 
});
//end of the event handler for the pos in the cashier side
// *****************************************************************

 // for validating input date in the reports

$(document).on("keypress", ".validate_date", function(){
         event.preventDefault();
});
 
$('.date_pickerfrom').datetimepicker({
      format: 'mm/dd/yyyy',
       startDate : '01/01/2000', 
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1, 
        startView: 2,
        minView: 2,
        forceParse: 0 

});


$('.date_pickerto').datetimepicker({
  format: 'mm/dd/yyyy',
   startDate : '01/01/2000', 
    language:  'en',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1, 
    startView: 2,
    minView: 2,
    forceParse: 0   

    }); 

$(document).on("click", ".submit",function(){
    var datefrom = $("#datefrom").val();
    var dateto  = $("#dateto").val();
    $("#validaterecord").hide();
    if (datefrom=='' || dateto == '') { 
        $("#validaterecord").css({ 
                            "background" :"red",
                            "color"      : "#fff",
                            "padding"    : "2px",
                            "padding-left" : "3px;",
                            "padding-right" : "3px",
                            "font-size"    : "15px",
                            "text-align"  : "center"
                          });
                $("#validaterecord").fadeIn("slow"); 
                $("#validaterecord").html("Please enter the dates.");
        return false;
    } 
    return true;
}); 
// end of validating date of the reports
// **************************************************************

// validating the cart value on the cashier side
setInterval(function(){loadnotifcart()},3000); 
function loadnotifcart(){
    $.ajax({
        type: "POST",
        url : "cartvalue.php", 
        success : function(data){ 
            // alert(data);
            $("#cartvalue").html(data);
        }
    });
} 
// end of validating the cart value on the cashier side
// ********************************************************************

// validating ordelist on the cashier side
setInterval(function(){autoloadpage()},3000); 
function autoloadpage() {
    $.ajax({
        type: "POST",
        url : "data.php",
        data :{orderlist:"yes"},
        success : function(data){
            $("#reload").html(data);
        }
    }); 
}  
setInterval(function(){loadnotif()},3000); 
function loadnotif(){
    $.ajax({
        type: "POST",
        url : "data.php",
        data :{msg:"yes"},
        success : function(data){
            $("#notif").html(data);
        }
    });
}
// end of validating ordelist on the cashier side
// ************************************************************

// validate today sales input box
$("#todaysales").keypress(function(e){
   e.preventDefault();
}); 
// end of validate today sales input box
// *********************************************************************

//event handler for the text quantity in the cart for the cashie side 
$(document).on("keyup", ".admincartqty", function () {
   
    var id = $(this).data('id'); 

    var qty = document.getElementById(id+'qty').value;  
    var price =  document.getElementById(id+'price').value;
    var subtot; 


         $.ajax({    //create an ajax request to load_page.php
            type:"POST",  
            url: "controller.php?action=updatecart",    
            dataType: "text",  //expect html to be returned  
            data:{mealid:id,QTY:qty},               
            success: function(data){    

               subtot = parseFloat(price) * parseFloat(qty); 
    
              document.getElementById('Osubtot'+id).value  =    subtot;

              var table = document.getElementById('table');
              var items = table.getElementsByTagName('output');

              var sum = 0;
              for(var i=0; i<items.length; i++)
                  sum +=   parseFloat(items[i].value);

              var output = document.getElementById('sum');
              // output.innerHTML =  sum.toFixed(2);
              output.innerHTML =  sum; 
            }

        }); 
   
    });

$(document).on("change", ".admincartqty", function () {
   

    var id = $(this).data('id'); 

    var qty = document.getElementById(id+'qty').value;  
    var price =  document.getElementById(id+'price').value;
    var subtot; 


         $.ajax({    //create an ajax request to load_page.php
            type:"POST",  
            url: "controller.php?action=updatecart",    
            dataType: "text",  //expect html to be returned  
            data:{mealid:id,QTY:qty},               
            success: function(data){    
              subtot = parseFloat(price) * parseFloat(qty); 
    
              document.getElementById('Osubtot'+id).value  =    subtot;

              var table = document.getElementById('table');
              var items = table.getElementsByTagName('output');

              var sum = 0;
              for(var i=0; i<items.length; i++)
                  sum +=   parseFloat(items[i].value);

              var output = document.getElementById('sum');
              // output.innerHTML =  sum.toFixed(2);
              output.innerHTML =  sum;
            }

        }); 
   
    });
//end of event handler for the text quantity in the cart for the cashie side 
// **********************************************************

 
// pop up window
 function OpenPopupCenter(pageURL, title, w, h) {
  var left = (screen.width - w) / 2;
  var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
  var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
 } 
 // enf of popup window
// ***************************************************************

 
// event handler of the add new order and delete cart in the cashier side
    // $(document).on("click",".addcartadmin",function(){
    //    var id = $(this).data("id");
    //    // alert(id)
    //    $.ajax({
    //     type : "POST",
    //     url : "addtocart.php",
    //     dataType : "text",
    //     data :{MEALID:id},
    //     success : function(data) {
    //        $("#cart").html(data);
    //        $("#addnotif").hide();
    //        $("#addnotif").show()
    //        $("#addnotif").html("meal has been added in the cart"); 
    //        setInterval(function(){
    //        $("#addnotif").hide();  
    //        },3000); 
    //     }

    //    });
    //  });

    //  $(document).on("click",".removecartadmin",function(){
    //     var id = $(this).data("id");
    //     // alert(id)
    //     $.ajax({
    //     type : "POST",
    //     url : "deletecart.php",
    //     dataType : "text",
    //     data :{MEALID:id},
    //     success : function(data) {
    //        $("#cart").html(data);
    //        $("#addnotif").hide();
    //        $("#addnotif").show()
    //        $("#addnotif").html("meal has been remove in the cart"); 
    //        setInterval(function(){
    //        $("#addnotif").hide();  
    //       },3000);

    //     }

    //    });
    //  });
// end of event handler of the add new order and delete cart in the cashier side
// ******************************************************************* 