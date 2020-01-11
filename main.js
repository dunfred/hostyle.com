$(function (params) {
    


    $(".display").hide()
    $(".cover").hide();
    $(".st2").hide();

    
    
    


    // $("#inpc").keyup(function (params) {
              

    //     var value = $("#inpc").val();

    //     $.ajax({
    //         url:"handler.php?fun=pre",
    //         method:"post",
    //         dataType:'text',
    //         data:{years:value},
    //         beforeSend:function (params) {
    //           $(".telthem").html("Loading...")
    //         },
    //         success:function (data) {
    //             $(".telthem").html(data)
    //         }
    //     })


    // })
    
     

//    $('#call2').click(function (params) {
//            $("#feedbox").css({
//                height:"auto"
//            })
//    })
     
      $("#next").click(function (e) {
           e.preventDefault();

           $(".slide").css({
               marginLeft:'-300px',
               transition:'0.3s'
           });
           speak("how much do you think you can afford for a hostel...");

      })
      $("#next2").click(function (e) {
        e.preventDefault();

        $(".slide").css({
            marginLeft:'-600px',
            transition:'0.3s'
        });
        speak("how do you want to be safe");

      })
      $("#next3").click(function (e) {
        e.preventDefault();

        $(".slide").css({
            marginLeft:'-900px',
            transition:'0.3s'
        });
        speak("how private do you want to live")
      })

      $("#back4").click(function (e) {
        e.preventDefault();

        $(".slide").css({
            marginLeft:'-600px',
            transition:'0.3s'
        });

      })

      $("#back3").click(function (e) {
        e.preventDefault();

        $(".slide").css({
            marginLeft:'-300px',
            transition:'0.3s'
        });

      })
      $("#back2").click(function (e) {
        e.preventDefault();

        $(".slide").css({
            marginLeft:'0px',
            transition:'0.3s'
        });

      })








    $("#stb").click(function(){
        $(".file").html('<audio autoplay><source src="assets/sound.mp3" type="audio/mpeg"></audio>');
        
        
        $("#banabox").fadeOut(300)

    })





    $("#search").keyup(function (e) {
        
        e.preventDefault()
        
        var text = $("#search").val()


        if(text == ''){
            $('.footer').fadeIn(300)
            $('.footer').css({
                marginTop:'',
                transition:'0.3s'
            })
            $("#display").fadeOut(300);

        }else{

            $('.footer').css({
            marginTop:'-600px',
            transition:'0.3s'
            })
            $('.footer').fadeOut(300)

            $("#display").fadeIn(300);


        $.ajax({
            url:'handler.php?fun=fetchinfo',
            method:'post',
            dataType:'text',
            data:{data:text},
            beforeSend:function (params) {
                $("#aibot").attr('src','assets/load.gif')
            },
            success:function (response) {
                $("#display").html(response);
                $("#aibot").attr('src','assets/ll.png')
            }
        })

        }
        

        
        
        
             

  })



  function speak(word) {
    speechRs.speechinit('Google UK English Female',function(e){
         speechRs.speak(word,function() {}, false);   
  });

 }









    $("#bba").click(function (params) {
        

       window.location.href='index.php'

    })





   $("#aibutt").click(function (params) {

          $(".file").html('<audio autoplay><source src="assets/sound.mp3" type="audio/mpeg"></audio>');

            speak("Hi there !!, welcome to hostyle, let me help you find a hostel of your choice");

             $('.aishow').css({
                 marginLeft:'0',
                 transition:'0.3s'
             });

          setTimeout(function (params) {
              $(".st2").fadeIn(300)
              speak("Now, Lets start by filling the questions below..");

          },6000)
          setTimeout(function (params) {
            speak("how close do you want your hostel to be with respect to the campus...");
        },8000)
   })


//   $(".nameb").click(function (){
    
// inside engine

//        var id = this.id;
//        var info = id.split(":");
//        var newData = info[1];

//        alert(newData)
    
//         //  $.ajax({
//         //      url:"handler.php?fun=showdet",
//         //      method:"post",
//         //      dataType:"text",
//         //      data:{dataId:newData},
//         //      beforeSend:function () {
//         //         $("#aibot").attr("src","assets/load.gif")
//         //      },
//         //      success:function (response) {
//         //         $("#display").html(response);
//         //         $("#aibot").attr("src","assets/ll.png")
//         //      }
//         //  })

//   })








//    $("#postfeed").click(function (e) {

//           e.preventDefault();
//           var data = $("#textbox").val()
//           $.ajax({
//               url:'handler.php?fun=inserComm',
//               method:'post',
//               dataType:'text',
//               data:{comment:data},
//               beforeSend:function (params) {
                  
//               },
//               success:function (response) {
//                   $('.msg').css({
//                       background:'green',
//                   })
//                   $('.msg').html(response)
//               }

//           })
//    })



setInterval(function () {
    $('#feedbox').load('handler.php?fun=fetchComm');
},1000)





$(".rat").click(function(){
    
setInterval(function () {
    $('.n3').load('handler.php?fun=Most_reted',function(response,status) {
          if(status == 'success'){
            $('.n3').html(response)
          }else{
            $('.n3').html("loading...")
          }
          
    });
},1000)

})

$(".vis").click(function(){
    
    setInterval(function () {
        $('.n1').load('handler.php?fun=Most_searched_hostel',function(response,status) {
              if(status == 'success'){
                $('.n1').html(response)
              }else{
                $('.n1').html("loading...")
              }
              
        });
    },1000)
    
    })

    $(".ser").click(function(){
    
        setInterval(function () {
            $('.n2').load('handler.php?fun=Recently_searched',function(response,status) {
                if(status == 'success'){
                  $('.n2').html(response)
                }else{
                  $('.n2').html("loading...")
                }
                
          });
        },1000)
        
        })









// $("#images").click(function (params) {
//     $(".cover").fadeIn(200);
//     $('.imagebox').fadeIn(300);
// })


// $("#closeimg").click(function (params) {
//          $(".cover").fadeOut(200);
//          $('.imagebox').hide();
// })



$("#aibotZ").click(function (params) {
      
      $("#showev").css({
          marginLeft:"-600px",
          transition:'0.3s'
      })


})


$("#noti").hide();

    // $("#sufeed").click(function (e) {

    //        e.preventDefault();

    //        $.ajax({
    //             url:"handler.php?fun=sendfeed",
    //             method:"post",
    //             dataType:"text",
    //             data:$("#feedform").serialize(),
    //             beforeSend:function (params) {
                    
    //             },
    //             success:function (data) {
    //                 if (data == 'done') {
    //                     $("#noti").fadeIn(200)
    //                     setTimeout(function(params) {
    //                         $("#noti").fadeOut(200)
    //                     },3000)
    //                 }
    //             }
    //        })

    // })



    //  $('.tboxx').click(function (e) {

    //     e.preventDefault();

    //     var id = this.id;
    //     var arr = id.split(":");
    //     var data = arr[1];


    //     $.ajax({
    //         url:'handler.php?fun=feed',
    //         method:'post',
    //         dataType:'text',
    //         data:{id:data},
    //         beforeSend:function (params) {
                
    //         },
    //         success:function (data) {
    //             $('.finder').html(data)
    //         }
    //     })


    //  })


$("#find").keyup(function (e) {
        
    e.preventDefault()
    
    var text = $("#find").val()
  

    if(text == ''){
        $('.finder').html('')
    }else{
        $.ajax({
            url:'handler.php?fun=finder',
            method:'post',
            dataType:'text',
            data:{find:text},
            beforeSend:function (params) {
                
            },
            success:function (response) {
                $('.finder').html(response)
            }
        })
    }

    

})







$("#aifind").click(function (e) {
        
    e.preventDefault()
    
        $.ajax({
            url:'handler.php?fun=AIBOT',
            method:'post',
            dataType:'text',
            data:$("#fff").serialize(),
            beforeSend:function (params) {
                $('.st2').html("fetching required hostels....")
            },
            success:function (response) {
                if(response == 'error'){
                  speak("Sorry, i could not find hostels of such preference... try again...");
                  $('.st2').html("Sorry, i could not find hostels of such preference... try again...")
                }else{
                speak("Ok !, this is what i found according to your preferences ");
                $('.st1').html("Ok !, this is what i found according to your preferences ")
                $('.st2').css({
                 textAlign:'left'
                })
                $('.st2').html(response)

                }
            }
        })
    

    

})















});