$(function(){
    $(document).on('click','#delete',function(e){
      e.preventDefault();
      var link = $(this).attr("href");
      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href= link;
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})

    });
    });

//confirm
$(function(){
  $(document).on('click','#confirm',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
title: 'Are you sure to confirm?',
text: "Once confirm, You won't be able to pending this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Comfirm it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href= link;
  Swal.fire(
    'Confirm!',
    'Confirmed your order.',
    'success'
  )
}
})

  });
  });


 //processing
$(function(){
  $(document).on('click','#processing',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
title: 'Are you sure to processing?',
text: "Once processing, You won't be able to confirm this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, processing it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href= link;
  Swal.fire(
    'processing!',
    'processing your order.',
    'success'
  )
}
})

  });
  });


//picked
$(function(){
  $(document).on('click','#picked',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
title: 'Are you sure to picked?',
text: "Once picked, You won't be able to processing this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, picked it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href= link;
  Swal.fire(
    'picked!',
    'picked your order.',
    'success'
  )
}
})

  });
  });


//Shipped
$(function(){
  $(document).on('click','#shipped',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
title: 'Are you sure to shipped?',
text: "Once shipped, You won't be able to picked this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, shipped it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href= link;
  Swal.fire(
    'shipped!',
    'shipped your order.',
    'success'
  )
}
})

  });
  });


//delivered
$(function(){
  $(document).on('click','#delivered',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
title: 'Are you sure to delivered?',
text: "Once delivered, You won't be able to Shipped this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delivered it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href= link;
  Swal.fire(
    'delivered!',
    'delivered your order.',
    'success'
  )
}
})

  });
  });

//cancel
$(function(){
  $(document).on('click','#cancel',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
title: 'Are you sure to cancel?',
text: "Once cancel, You won't be able to Change this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, cancel it!'
}).then((result) => {
if (result.isConfirmed) {
  window.location.href= link;
  Swal.fire(
    'cancel!',
    'cancel your order.',
    'success'
  )
}
})

  });
  });