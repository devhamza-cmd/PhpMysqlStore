$(document).ready(function () {
   $("button").one("click", function () { 
       var value = $(this).val();
       $(".m").remove();
       $(".year").remove();
       $(".mounth").remove();
       $.ajax({
           url: "usersmonth.php",
           method: "POST", 
           data: {value: value}, 
           success: function(response) {
             
               $(".cyear").html(response);
           },
           error: function(xhr, status, error) {
             
               console.log("Error:", error);
           }
       });
   });
});


$(document).ready(function () {
    $(".search").click( function () {
       var nom=$('.nom').val();
       var prenom=$('.prenom').val();
       var email=$('.email').val();
      var adresse=$('.adresse').val();
       
       $.ajax({
        url: "loaduserstable.php",
        method: "POST", 
        data: {adresse:adresse,nom: nom,prenom:prenom,email:email}, 
        success: function(response) {
          
            $(".table").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
    });
    })
})
$(document).ready(function () {
    $(".search2").click( function () {
       var nom=$('.nom').val();
       var prenom=$('.prenom').val();
       var email=$('.email').val();
      var adresse=$('.adresse').val();
       
       $.ajax({
        url: "loadusellers.php",
        method: "POST", 
        data: {adresse:adresse,nom: nom,prenom:prenom,email:email}, 
        success: function(response) {
          
            $(".table").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
    });
    })
})
$(document).ready(function () {
    $(".navigation button").click(function(){
        var chose=$(this).val();
        $.ajax({
            url: "loaduserinfo.php",
        method: "POST", 
        data: {chose:chose}, 
        success: function(response) {
          
            $(".infoprofile").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
        })
    })
})
$(document).ready(function () {
    $(".navigation2 button").click(function(){
        
        var chose=$(this).val();
        $.ajax({
            url: "loadstoreinfo.php",
        method: "POST", 
        data: {chose:chose}, 
        success: function(response) {
          
            $(".infoprofile").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
        })
    })
})

document.addEventListener("DOMContentLoaded", function() {
    const imageFileInput = document.getElementById('img');
    const postButton = document.querySelector('.posti');
  
    imageFileInput.addEventListener('change', function(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
  
      reader.onload = function(e) {
        let imageData = e.target.result;
        imageFileInput.imageData = imageData;
        postButton.removeEventListener('click', postButtonClickHandler);
        postButton.addEventListener('click', postButtonClickHandler);
      };
  
      reader.readAsDataURL(file);
    });
  
    function postButtonClickHandler() {
      var text = $('#posttext').val();
      var imageData = imageFileInput.imageData;
  
      $.ajax({
        url: "postuseraction.php",
        method: "POST",
        data: { img: imageData, text: text },
        success: function(response) {
          $('#close-btn').click();
          $('#imgin').css('background-image', '');
          $(".test").html(response);
        },
        error: function(xhr, status, error) {
          console.log("Error:", error);
        }
      });
    }
  });
  

    const publishBtn = document.querySelector('.publish');
  const overlay = document.querySelector('#overlay');
  const closeBtn = document.querySelector('#close-btn');

  publishBtn.addEventListener('click', () => {
    overlay.style.display = 'flex';
  });

  closeBtn.addEventListener('click', () => {
    overlay.style.display = 'none';
  }); 

  $(document).ready(function () {
    $(document).on("click", ".post-comment", function () {
        var id = $(this).val();
        
        const input = $(`#${id}`);
        var cmnt=input.val();
        input.val("");
        $.ajax({
            url: "cmntaction.php",
            method: "POST",
            data: { codep: id, cmnt:cmnt },
            success: function (response) {
                $(".nwcmnt").html(response);
                
                
            },
            error: function (xhr, status, error) {
                console.log("Error:", error);
            }
        });
    });
});


$(document).ready(function () {
    $(document).on('click', '.view-all-comments', function() {
        var code=$(this).val();
        $('#overlay3').css('display', 'block');
        $.ajax({
            url: "loadcmnts.php",
        method: "POST", 
        data: {codep:code}, 
        success: function(response) {
          
            $(".cmnts").html(response);
        },
        error: function(xhr, status, error) {
          
            console.log("Error:", error);
        }
        })
    })
})
$(".close").click(function(){
    $('#overlay3').css('display', 'none');
})
$(document).on('click', '[statu="no"]', function() {
    var code = $(this).val();
    $(`button[value='${code}']`).removeAttr('statu');
    $(`button[value='${code}']`).attr('statu', 'yes');
    $.ajax({
        url: "like.php",
        method: "POST", 
        data: {codep: code}, 
        success: function(response) {
            $(".nnn").html(response);
            
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
});

$(document).on('click', '[statu="yes"]', function() {
    var code = $(this).val();
    $(`button[value='${code}']`).removeAttr('statu');
    $(`button[value='${code}']`).attr('statu', 'no');
    $.ajax({
        url: "deslike.php",
        method: "POST", 
        data: {codep: code}, 
        success: function(response) {
            $(".nnn").html(response);
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
});

setInterval(() => {
    
    $.ajax({
               
        url: "checkpost.php",
        method: "POST", 
        success: function(response) {
            $(".newpost").html(response);
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
    setInterval(() => {
        var oldvalue=$('.pnbr').text()
        var newvalue=$('.newpost').text()
      
        if(newvalue>oldvalue){
            $.ajax({
               
                url: "loadposts.php",
                method: "POST", 
                success: function(response) {
                    $('.pnbr').text(newvalue);
                    $(".test").html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        }
    }, 500);
}, 500);
setInterval(() => {
    
    $(".newlikenbr").each(function() {
    
        var codep=$(this).attr('custom'); 
        $.ajax({
            data :{codep:codep},
            url: "checklikes.php",
            method: "POST", 
            success: function(response) {
                $(`[custom='${codep}']`).html(response);
                
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
      });
      
}, 500);
setInterval(() => {
    var defult= $(".ntf").text();
    $.ajax({
        data :{defult:defult},
        url: "chechnotif.php",
        method: "POST", 
        success: function(response) {
            $(".newntfnbr").html(response);
            
        },
        error: function(xhr, status, error) {
            console.log("Error:", error);
        }
    });
}, 500);
