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
});
