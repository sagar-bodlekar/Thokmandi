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



  /* .text {
    position: relative;
    color: rgb(255, 255, 255);
    mix-blend-mode: difference;
    text-transform: uppercase;
    font-size: 60px;
  } */

  input[type="checkbox"] {
    position: relative;
    width: 80px;
    height: 30px;
    -webkit-appearance: none;
    border-radius: 20px;
    outline: none;
    transition: .4s;
    box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
    cursor: pointer;
  }

  input:checked[type="checkbox"] {
    background: green;
  }

  input[type="checkbox"]::before {
    z-index: 2;
    position: absolute;
    content: "";
    left: 0;
    width: 30px;
    height: 30px;
    background: #8E9AA0;
    border-radius: 50%;
    transform: scale(1.1);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: .4s;
  }

  input:checked[type="checkbox"]::before {
    left: 50px;
    background: #FFFFFF;
  }

  .toggle {
    position: relative;
    display: inline;
  }

  label {
    position: absolute;
    color: #fff;
    font-weight: 600;
    pointer-events: none;
    font-size: smaller;
  }

  .onbtn {
    bottom: 0px;
    left: 11px;
  }

  .ofbtn {
    bottom: 0px;
    right: 8px;
    color: #8E9AA0;
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
    console.log("call again call Orders table data");
    calltabledata('Orders');
    $('.modal-btn').html('Add ' + 'Order');
    $(".dropdown-menu li a").click(function() {
      var selText = $(this).text();
      $(this).parents('.dropdown').find('.dropdown-toggle').html(selText);
      $('.modal-btn').html('Add ' + selText);
      calltabledata(selText);
    });
    /**
     * modal button click function
     */
    $('.modal-btn').click(function() {
      var modalvalue = $('.modal-btn').text();
      $("#myModal").fadeIn("slow");
      $('#myModal').find('.modal-title').html(modalvalue);
      var content = '';
      if (modalvalue === 'Add Order') {
        content += '<div id="ordersection">';
        content += '<div style="display: grid;">'; //reatiler collapase section be change
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
            content += '<a href="#demo" class="well well-sm" data-toggle="collapse">Retailer Section</a>';
            content += '</div>'
            content += '<div id="demo" class="col-lg-12" class="collapse" style="border:1px solid red;">'; // click collapse under form DIV
            content += '<form id="orderForm">'; // Form starts here
            content += '<div class="form-group">';
            content += '<label for="input1">Company Name</label>';
            content += '<input type="text" class="form-control" id="company_name" name="input1" placeholder="Enter Company Name" required>';
            content += '</div>';
            content += '<div class="form-group">';
            content += '<label for="input2">Retailer Name</label>';
            content += '<input type="text" class="form-control" id="retailer_name" name="input2" placeholder="Enter Retailer Name" required>';
            content += '</div>';
            content += '<div class="form-group">';
            content += '<label for="input2">Mobile No.</label>';
            content += '<input type="text" class="form-control" id="mobile_no" name="input2" placeholder="Enter Mobile No." required>';
            content += '</div>';
            content += '<div class="form-group">';
            content += '<label for="input2">Email</label>';
            content += '<input type="text" class="form-control" id="email" name="input2" placeholder="Enter Email" required>';
            content += '</div>';
            content += '<div class="form-group">';
            content += '<label for="input2">GST No.</label>';
            content += '<input type="text" class="form-control" id="gst_no" name="input2" placeholder="Enter GST No." required>';
            content += '</div>';
            content += '<div class="form-group">';
            content += '<label for="input2">Address</label>';
            content += '<textarea id="address" class="form-control" name="story" rows="5" cols="33" placeholder="Enter Address of Retailers" required></textarea>';
            content += '</div>';
            // Add more form elements as needed
            content += '<br><button type="submit" class="btn btn-primary" id="submitBtn" style="display: none">Submit</button>'; // Submit button
            content += '</form>'; // Form ends here
            content += '</div>'; // collapse div end
            content += '</div>';
            console.log(content); // this is content for all elements 
            $('#myModal .modal-body').html(content);
            initializeSelect2();
          }
        });
      }
    });
    $(document).ready(function() {
      $(document).on('change', '#retailerDropdown', function() {
        var selectedValue = $(this).val();
        if (selectedValue == 0) {
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
            data: {
              id: selectedValue
            },
            success: function(response) {
              console.log(response)
              $('#company_name').val(response[0]['company_name'] || '');
              $('#retailer_name').val(response[0]['retailer_name'] || '');
              $('#mobile_no').val(response[0]['mobile_no'] || '')
              $('#email').val(response[0]['email'] || '');
              $('#gst_no').val(response[0]['gst_no'] || '');
              $('#address').val(response[0]['address'] || '');
            },
            error: function(xhr, status, error) {
              // Handle errors
              console.error(error);
            }
          })
        }
      });
      // $('#myTable').DataTable(); // this table load using datatable 
    });

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
      // var obj = {};
      // obj['Orders'] = 'orders';
      // obj['Products'] = 'products'; 
      // obj['Retailers'] = 'retailers'; 
      // obj['Salesman'] = 'salesman'; 
      // obj['Transports'] = 'transport';           
      // console.log(obj);
      $.ajax({
        url: 'php/datavstable.php', // URL to fetch fresh dropdown data
        type: 'GET', // Method type
        // dataType: "json",
        data: {
          value: data
        },
        success: function(response) {
          console.log(response)
          console.log("for more..");
          if (data == 'Orders') {
            var columnHeaders = Object.keys(response[0]);
            var headerRow = $("#myTable thead tr");
            for (let i = 0; i < 8; i++) {
              if ($('#myTable thead tr th').length === 8) {
                return false
              }
              headerRow.append("<th>" + columnHeaders[i] + "</th>");
            }


            // Example data (replace with data fetched from the database)
            var rowData = response;

            // Add rows to the table
            var tableBody = $("#myTable tbody");
            var rowHtml = "";
            $.each(rowData, function(index, row) {
              rowHtml = "<tr data-toggle='collapse' data-target='#details-" + row.id + "' class='accordion-toggle' data-id='" + row.id + "' style='cursor: pointer;'><td class='glyphicon glyphicon-eye-open'>" + row.id + "</td><td>" + row.invoice_no + "</td><td>" + row.retailer_id + "</td><td>" + row.orderstatus + "</td><td>" + row.salesman_id + "</td><td>" + row.transport_id + "</td><td>" + row.created_at + "</td><td>" + row.updated_at + "</td></tr>";
              tableBody.append(rowHtml);
            });

            $(".accordion-toggle").click(function() {
              var id = $(this).data("id");
              var target = "#details-" + id;

              $.ajax({
                url: 'php/datavstable.php', // URL to fetch fresh dropdown data
                type: 'GET', // Method type
                // dataType: "json",
                data: {
                  value: 'order_summery', //order child
                  id: $(this).data("id")
                },
                success: function(response) {
                  console.log(response);
                  // $.each(response, function(index, retailer) {
                  //   console.log(retailer);
                  //   // content += '<option value="' + retailer.id + '">' + retailer.company_name + '</option>';
                  //   content += `<option value=${retailer.id}>${retailer.company_name}</option>`
                  // });
                  if (response.length > 0) {
                    var tddata = "<th>Sno.</th><th>OrderId</th><th colspan='2'>Product Name</th><th>Total Price</th><th>Qty</th><th>Inword Qty</th><th>Product Status</th><th>Create Date</th><th>Update Date</th>";
                    tddata += "<td><button type='button' class='btn btn-primary'>Products <span class='badge badge-light'>9</span><span class='sr-only'>unread messages</span></button></td>";
                    tddata += "<td><button type='button' class='btn btn-primary position-relative'>Pending <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>99+</span></button></td>"
                    tddata += "<td><div class='toggle'><input type='checkbox'><label for='' value='completed' class='onbtn'></label><label for='' value='pending' class='ofbtn'></label></div></td>";
                    // tddata += "";
                    var selectrow = $('tr[data-id="' + id + '"]');
                    var childdiv = $('.child-div');
                    var nextrow = $('<tr class="collapse child-tr-' + id + '" id="details-' + id + '"style="background-color: #000; font-size: 13px; position: fixed; color: white;padding-left: 55px;"></tr>').append(tddata);

                    // $(`#details-'${id}'`).collapse();
                    // nextrow.hide();
                    // selectrow.after(nextrow);
                    // selectrow.click(function() {
                    //   nextrow.toggle();
                    // });
                    // var nextrow = selectrow.after($('<tr class="child-tr-' + id + '"></tr>'));
                    if ($('.child-tr-' + id).length === 0) {
                      selectrow.after(nextrow);
                    }
                  } else {
                    alert("No available Data")
                  }
                },
                error: function(xhr, status, error) {
                  console.error(error);
                }
              })
            });
          }



          // var columnHeaders = ["ID", "Name", "Actions"];

          // Add column headers to the table
          // var headerRow = $("#myTable thead tr");
          // $.each(columnHeaders, function(index, header) {
          //     headerRow.append("<th>" + header + "</th>");
          // });

          // // Example data (replace with data fetched from the database)
          // var rowData = [
          //     { id: 1, name: "John Doe" },
          //     { id: 2, name: "Jane Smith" }
          // ];

          // // Add rows to the table
          // var tableBody = $("#myTable tbody");
          // $.each(rowData, function(index, row) {
          //     var rowHtml = "<tr><td>" + row.id + "</td><td>" + row.name + "</td><td><button class='editBtn'>Edit</button><button class='deleteBtn'>Delete</button></td></tr>";
          //     tableBody.append(rowHtml);
          // });
          $('#myTable').DataTable();
        },
        error: function(xhr, status, error) {
          // Handle errors
          console.error(error);
        }
      })


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
  <table id="myTable" class="display" style="width: 100%;border:3px solid black;">
    <thead>
      <tr>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
<!-- <div id="details-1" class="child-div">
  <center> Organisation PAN, Organisation GST, TAN Certification, Certificate of Incorporation(COI)</center>
</div> -->
<script>
  $("table tbody").on("click", "tr.key", function() {
    var active = $(this)
    var trs = active.nextUntil(".key")
    trs.show();

    $("tr.item").not(trs).hide()

  })
</script>
<?php include("footer.php"); ?>