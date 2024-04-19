<?php include("header.php"); ?>
<style>
.key {
  background-color: #CCC;
}
.item {
  display: none;
}

.item td {
  border: 1px solid black;
}
</style>
<br>
<br>
<br>
<br>
<br>
<script>
$(function() {
  $('#mySelect').select2();
  $('.dropdown').find('.dropdown-toggle').html('Orders');
  $('.modal-btn').html('Add '+'Order');
  $(".dropdown-menu li a").click(function() {
    var selText = $(this).text();
    $(this).parents('.dropdown').find('.dropdown-toggle').html(selText);
    $('.modal-btn').html('Add '+selText);
    calltabledata(selText);
  });
/**
 * modal button click function
 */
$('.modal-btn').click(function () {
    var modalvalue = $('.modal-btn').text();
    $( "#myModal" ).fadeIn("slow");
    $('#myModal').find('.modal-title').html(modalvalue);    
    var content = '';
    if(modalvalue ==='Add Order') {
      content += '<div id="ordersection">';
      content += '<span><b>Enter Retailers:&nbsp;&nbsp;&nbsp;&nbsp;</b></span>';
      content += '<select title="All Retailers here.."  class="js-example-basic-single" id="retailerDropdown">';
      content += '<option value="0">add new retailer...</option>';
      $.ajax({
        url: 'php/fetch_retailer_data.php',
        type: 'GET',
        // dataType: 'json',
        success: function(response) {
          // console.log(response);
      $.each(response, function(index, retailer) {
        console.log(retailer);
        // content += '<option value="' + retailer.id + '">' + retailer.company_name + '</option>';
        content += `<option value=${retailer.id}>${retailer.company_name}</option>`
        });
      // id	company_name	retailer_name	mobile_no	email	gst_no	address
    content += '</select>';
    content += '<form id="orderForm">'; // Form starts here
    content += '<div class="form-group">';
    content += '<label for="input1">Company Name</label>';
    content += '<input type="text" class="form-control" id="company_name" name="input1" placeholder="Enter Company Name" required>';
    content += '</div>';
    content += '<div class="form-group">';
    content += '<label for="input2">Retailer Name</label>';
    content += '<input type="text" class="form-control" id="retailer_name" name="input2" placeholder="Enter Retailer Name" required>';
    content += '</div>';
    content += '<label for="input2">Mobile No.</label>';
    content += '<input type="text" class="form-control" id="mobile_no" name="input2" placeholder="Enter Mobile No." required>';
    content += '</div>';
    content += '<label for="input2">Email</label>';
    content += '<input type="text" class="form-control" id="email" name="input2" placeholder="Enter Email" required>';
    content += '</div>';
    content += '<label for="input2">GST No.</label>';
    content += '<input type="text" class="form-control" id="gst_no" name="input2" placeholder="Enter GST No." required>';
    content += '</div>';
    content += '<label for="input2">Address</label>';
    content += '<textarea id="address" class="form-control" name="story" rows="5" cols="33" placeholder="Enter Address of Retailers" required></textarea>';
    content += '</div>';
    // Add more form elements as needed
    content += '<br><button type="submit" class="btn btn-primary" id="submitBtn" style="display: none">Submit</button>'; // Submit button
    content += '</form>'; // Form ends here
    content += '</div>';
      console.log(content);
      $('#myModal .modal-body').html(content);
      initializeSelect2();
            }
      });
    }
});
$(document).ready(function() {
  $(document).on('change', '#retailerDropdown', function () {
    var selectedValue  =  $(this).val();
    if (selectedValue  == 0) {
      console.log(selectedValue);      
      $("#submitBtn").css("display", "block");
      
      $("#submitBtn").click(function() {
        var company_name = $('#company_name').val();
        var retailer_name = $('#retailer_name').val();
        var mobile_no = $('#mobile_no').val();
        var email = $('#email').val();
        var gst_no = $('#gst_no').val();
        var address = $('#address').val();
        // console.log(company_name, retailer_name, mobile_no, email, gst_no, address);
      $.ajax({
        url: 'php/save_retailer.php',
        type: 'POST',
        data: {
          company_name: company_name,
          retailer_name: retailer_name,
          mobile_no: mobile_no,
          email: email,
          gst_no: gst_no,
          address: address
        },
          success: function(response) {
            // Handle success response
            console.log(response);
            console.log('Form data submitted successfully:', response);

            $.ajax({
                url: 'php/fetch_retailer_data.php', // URL to fetch fresh dropdown data
                type: 'GET', // Method type
                success: function(response) {
                  // Update the dropdown options with fresh data
                  $('#retailerDropdown').empty(); // Clear existing options
                  $.each(response, function(index, item) {
                    $('#retailerDropdown').append('<option value="' + item.id + '">' + item.company_name + '</option>');
                  });
                  // Refresh Select2 dropdown
                  $('#retailerDropdown').trigger('change');
                },
                error: function(xhr, status, error) {
                  console.error('Error fetching dropdown data:', error);
                }
            });

          },
          error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
          }
      });

      })
    } else {
      console.log(selectedValue);   
      $("#submitBtn").css("display", "none");
      $.ajax({
        url: 'php/fetch_retailer_data.php', // URL to fetch fresh dropdown data
        type: 'GET', // Method type
        data: { id: selectedValue},
        success: function(response){
          console.log(response)
        $('#company_name').val(response[0]['company_name'] || '');
        $('#retailer_name').val(response[0]['retailer_name'] || '');
        $('#mobile_no').val(response[0]['mobile_no'] || '')
        $('#email').val(response[0]['email'] || '');
        $('#gst_no').val(response[0]['gst_no'] || '');
        $('#address').val(response[0]['address'] || '');
        },
        error:function(xhr, status, error) {
            // Handle errors
            console.error(error);
          }
      })
    }
  });
});
// $('#retailerDropdown').change(function () {
//   console.log("running....");
// })



// $(".js-example-basic-single").click(function () {
//                 // alert($(this).val());
//               var t =  ('#retailerDropdown').val();
//                 console.log(t);
// });
/**initialize dropdown for reatiler */
function initializeSelect2() {
    $('#retailerDropdown').select2({
      // placeholder: 'Search for a retailer',
      allowClear: true
    });
}
function calltabledata(data) {
  /**
   * this is for data for datatable through ajax and set datatable 
   */
  console.log(data);
  // location.reload(); this is using for page reload 
};
})
</script>
<!-- apply on your code edit -->
<!-- Drop Down -->
<div class="container">                                         
  <div class="dropdown">
    <button class="btn btn-default  dropdown-toggle btn-lg" type="button" data-toggle="dropdown">Select Table
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#" value="order">Orders</a></li>
      <li><a href="#" value="product">Products</a></li>
      <li><a href="#" value="retailer">Retailers</a></li>
      <li><a href="#" value="salesman">Salesman</a></li>
      <li><a href="#" value="salesman">Transports</a></li>
    </ul>
  </div>
  <br>
  <!-- Trigger the modal with a button -->

<button type="button" class="btn btn-info btn-lg modal-btn" data-toggle="modal" data-target="#myModal">Open Modal</button>
<!-- Modal start -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal End -->

</div>

<div class="container">
    <div>
  <h2>Simple Collapsible</h2>
  <a href="#demo" class="well well-sm" data-toggle="collapse">Simple collapsible</a>
  <div id="demo" class="collapse">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
  </div>
  </div>
  <table>
  <thead>
    <tr>
      <th colspan="2">Name</th>
      <th colspan="2">Date</th>
    </tr>
  </thead>
  <tbody>
    <tr class="key">
      <td colspan="4">AAA</td>
    </tr>
    <tr class="item">
      <td colspan="2">ANAME</td>
      <td colspan="2">20200101</td>
    </tr>
    <tr class="item">
      <td colspan="2">ANAME</td>
      <td colspan="2">20200101</td>
    </tr>
    <tr class="item">
      <td colspan="2">ANAME</td>
      <td colspan="2">20200101</td>
    </tr>
    <tr class="key">
      <td colspan="4">BBB</td>
    </tr>
    <tr class="item">
      <td colspan="2">BNAME</td>
      <td colspan="2">20200101</td>
    </tr>
    <tr class="item">
      <td colspan="2">BNAME</td>
      <td colspan="2">20200101</td>
    </tr>
    <tr class="key">
      <td colspan="4">CCC</td>
    </tr>
    <tr class="item">
      <td colspan="2">CNAME</td>
      <td colspan="2">20200101</td>
    </tr>
  </tbody>
</table>
</div>
<script>
$("table tbody").on("click", "tr.key", function () {
  var active = $(this)
  var trs = active.nextUntil(".key")
  trs.show();

  $("tr.item").not(trs).hide()

})
</script>
<?php include("footer.php"); ?>