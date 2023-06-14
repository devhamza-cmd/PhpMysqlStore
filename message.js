let selectBtn=document.querySelectorAll(".select")
let sendBtn=document.querySelector(".sendbtn")
selectBtn.forEach(btn => {
    btn.addEventListener('click',function () {
        sendBtn.setAttribute("id",btn.id)
    })
});
$('.select').on('click', function () {
    
    var to=sendBtn.id;
    $.ajax({
        data :{to:to},
        url: "loadmsg.php",
        method: "POST", 
        success: function(response) {
            $('.test').html(response);
            
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
    $.ajax({
        data :{to:to},
        url: "checkmsg.php",
        method: "POST", 
        success: function(response) {
            $('.count').html(response);
            console.log("vvv");
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
    setInterval(() => {
        $.ajax({
            data :{to:to},
            url: "checkmsg2.php",
            method: "POST", 
            success: function(response) {
                $('.count2').html(response);
                console.log("vvv");
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
    }, 2000);
    setInterval(()=>{
        let old=document.querySelector(".count");
        let New=document.querySelector(".count2");
        if (New.innerHTML>old.innerHTML){
            $.ajax({
                data :{to:to},
                url: "loadmsg.php",
                method: "POST", 
                success: function(response) {
                    $('.test').html(response);
                    
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
            old.innerHTML=New.innerHTML;
            
        }
    })
});
$('.sendbtn').on('click', function () {
    var to=sendBtn.id;
    var txt =$(".msTxt").val();
    $.ajax({
        data :{to:to,txt:txt},
        url: "sendmsg.php",
        method: "POST", 
        success: function(response) {
            $('.test').html(response);
            
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
})