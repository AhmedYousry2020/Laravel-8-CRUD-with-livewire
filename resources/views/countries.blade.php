<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Contries</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
    .head {
       margin-top:45px 
    }
    .fa {
      padding: 4px 6px;
    }

    </style>
    <livewire:styles />
</head>
<body>

    <div class="container">
       <div class="row head">  
           <div class="col-md-9 offset-md-2"> 
                <h4>World Countries</h4>
                @livewire('countries')
           </div> 
       </div>  
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="{{asset('sweetalert2/sweetalert2.min.js')}}"></script>

<livewire:scripts />
<script>
window.addEventListener("OpenAddCountryModal",function(){
   $(".addCountry").find("span").html(" ");
   $(".addCountry").find("form")[0].reset();
   $(".addCountry").modal("show");
});

window.addEventListener("OpenEditCountryModal",function(){
   $(".editCountry").find("span").html(" ");
   $(".editCountry").modal("show");
   
});

window.addEventListener("CloseAddCountryModal",function(){
   $(".addCountry").find("span").html(" ");
   $(".addCountry").find("form")[0].reset();
   $(".addCountry").modal("hide");
   alert("New Country added Successfully");
});

window.addEventListener("CloseEditCountryModal",function(event){
   $(".editCountry").find("span").html(" ");
   $(".editCountry").modal("hide");
   alert("The Country updated Successfully");
});

window.addEventListener("SwalConfirm",function(event){
   swal.fire({
                   title:event.detail.title,
                   imageWidth:48,
                   imageHeight:48,
                   html:event.detail.html,
                   showCloseButton:true,
                   showCancelButton:true,
                   cancelButtonText:'Cancel',
                   confirmButtonText:'Yes, Delete',
                   cancelButtonColor:'#d33',
                   confirmButtonColor:'#3085d6',
                   width:300,
                   allowOutsideClick:false
               }).then(function(result){
                   if(result.value){
                      window.livewire.emit('delete',event.detail.id);
                   }
               })
  
});
window.addEventListener("Swal:deleteCountries",function(event){
   swal.fire({
                   title:event.detail.title,
                   imageWidth:48,
                   imageHeight:48,
                   html:event.detail.html,
                   showCloseButton:true,
                   showCancelButton:true,
                   cancelButtonText:'Cancel',
                   confirmButtonText:'Yes, Delete',
                   cancelButtonColor:'#d33',
                   confirmButtonColor:'#3085d6',
                   width:300,
                   allowOutsideClick:false
               }).then(function(result){
                   if(result.value){
                     window.livewire.emit('deleteCheckedCountries',event.detail.checkedIDs);
                   }
               })
  
});

window.addEventListener("deleted",function(event){
  
   alert("The "+ event.detail.title +" deleted Successfully");
});




</script>
</body>
</html>
