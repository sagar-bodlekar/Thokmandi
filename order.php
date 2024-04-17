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
}</style>
<br>
<br>
<br>
<br>
<br>
<!-- this is action it -->
<form>
  Select your favorite fruit:
  <select id="mySelect">
    <option value="apple">Apple</option>
    <option value="orange">Orange</option>
    <option value="pineapple">Pineapple</option>
    <option value="banana">Banana</option>
  </select>
</form>

<p>Click the button to change the selected fruit to banana.</p>

<button id="btnTxt" type="button" onclick="myFunction()">Try it</button>
<script>
function myFunction() {  
let buttonVal = document.getElementById("mySelect").value;
console.log(buttonVal);
document.getElementById('btnTxt').innerHTML = buttonVal;  
}
</script>
<!-- apply on your code edit -->
<!-- Drop Down -->
<div class="container">                                         
  <div class="dropdown mx-3">
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
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

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
        <p>Some text in the modal.</p>
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