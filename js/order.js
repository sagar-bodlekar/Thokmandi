// console.log("order script running!!!!")
// $(function() {
//     $('#modal-btn').click(function() {
//         console.log("checking ooooo")
//     })
// })

// $('#ordersection').click(function() {
//     var t =  ('#retailerDropdown').val();
//               console.log("running123")
//               console.log(t);
// });

$(function () {
    $(".fold-table tr.view").on("click", function () {
        $(this).toggleClass("open").next(".fold").toggleClass("open");
    });
});