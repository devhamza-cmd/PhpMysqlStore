$(document).ready(function () {
    let buttons=document.querySelectorAll(".month button")
    buttons.forEach(element => {
        element.addEventListener('click',function () { 
           var month =element.value;
           var name=element.name;
           
           $.ajax({
            url: "sellermonth.php",
            method: "POST", 
            data: {name:name,month:month}, 
            success: function(response) {
              
                $(".cyear").html(response);
            },
            error: function(xhr, status, error) {
              
                console.log("Error:", error);
            }
        });
         })
    });
        }) 
$(document).ready(function () {
    $('.ctsmbtn').on('click', function () {
        var role=$(this).attr('role');
        switch (role) {
            case 'add':
                
                $(".addcontainer").css("display","block");
                break;
        }
    }); 
    
});
$(document).ready(function () {
    const closebtn=$(".closeBtn");
    closebtn.on('click', function () {
        $(".addcontainer").css("display","none");
    });
    $(".cstn").on("click", function () {

    let inptimg=document.querySelector(".upimg");
    inptimg.click();
});
let inptimg=document.querySelector(".upimg");
let deafultimg=document.querySelector(".upload img");


inptimg.addEventListener('change',(event)=>{
    var  file = event.target.files[0];
    var  reader = new FileReader();
    reader.onload = function (e) {
        var imageData = e.target.result;
        
        deafultimg.setAttribute("src",`${imageData}`);
    };
    reader.readAsDataURL(file);
})
const uploadbtn = $(".create");

uploadbtn.on("click", function () {
    let id = uploadbtn.val();
    let strname = document.querySelector(".storename").value;
    let fileInput = document.getElementById('img');
    let file = fileInput.files[0];

    let reader = new FileReader();
    reader.onload = function(event) {
        let base64String = event.target.result;
        if(!base64String){
            console.log("empty")
        }
        
        $.ajax({
            type: "POST",
            url: "createstore.php",
            data: {
                id: id,
                name:strname,
                store: strname,
                img:base64String,
                
            },
            success: function (response) {
                const closebtn=$(".closeBtn");
                document.querySelector(".storename").value="";
                closebtn.click();
               
            },
            error: function(xhr, status, error) {
                alert("you have to upload your store logo");
              }
        });
    };

    reader.readAsDataURL(file);
});

});
