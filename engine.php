<?php
# Hostyle 
#-----------------------------------------------
# author         : | Richard Obiri             |
# date started   : | 15th November             |
# date Complete  : | 12th January 2020         |
# Title          : | Hostyle                   |
#-----------------------------------------------




function ccc()
{
    echo '<script>
    
    $("#inpc").keyup(function (params) {
              

        var value = $("#inpc").val();

        $.ajax({
            url:"handler.php?fun=pre",
            method:"post",
            dataType:"text",
            data:{years:value},
            beforeSend:function (params) {
              $(".telthem").html("Loading...")
            },
            success:function (data) {
                $(".telthem").html(data)
            }
        })


    })
    
    
    
        </script>';
}



function pre()
{    

       include 'db.php';

       $hid = $_SESSION['hid'];
       $num_of_years = $_POST['years'];


       if (empty($_POST['years']) || $num_of_years== ' ') {
            echo '';
       }else{
     #number of years spent wit money
     $sel = mysqli_query($con,"SELECT * FROM hotels WHERE id='".$hid."' ");
     $row = mysqli_fetch_array($sel);

     $money1 = $row['one_price'];
     $money2 = $row['two_price'];

     #years for one in a room
     $y1room = $money1*$num_of_years;
     #years for two in a room
     $y2room = $money2*$num_of_years;



     #calculate for x number of years 
     echo 'for '.$num_of_years.' years with this hostel you will have to budget
     a minimum of <span id="per"> GHC '.$y1room.'.00</span> for <span id="per">one in a room</span> and a minimum of <span id="per2">GHC '.$y2room.'.00</span> for 
     <span id="per2">two in a room</span> ';



       }



}



function calculatedis($val) 
{
        $dv = 0.5;
        $dc = 84;
        
        $dval = round(($dv/$val)*$dc);

        return $dval;
}


function AIBOT()
{
      include 'db.php';

      $access    = $_POST['close'];
      $cost      = $_POST['cost'];
      $security  = $_POST['sec'];
      $private    = $_POST['priv'];



      #explode the prce into ranges
      $price = explode(":",$cost);
      $least = $price[0];
      $more = $price[1];



      #0.5 = 84%
      # calculate access in percentages

      # 84 = 0.5
      $distance = 0;
      $access2 = $access - 10;
      $c_distance = 84;
      $c_value = 0.5;
      $distance = round(($c_distance/$access)*0.5,2);
      $distance2 = round(($c_distance/$access2)*0.5,2);

      $d2d = 3.2 - $distance2;
      $d1d = 3.2 - $distance;

    


    
      
      $sel = mysqli_query($con,"SELECT * FROM hotels WHERE distance >= '$distance' and distance <= '$distance2'  ");

      while ($row = mysqli_fetch_array($sel)) {

            $hostel_name = $row['hname'];

      }
      if (empty($hostel_name)) {

           echo "error";

      }else{

      $sele2 = mysqli_query($con,"SELECT * FROM hotels WHERE hname = '$hostel_name' and accomodation='$private' and securitys='$security' and one_price >= '$least' and one_price <= '$more'   or  two_price >= '$least' and two_price <= '$more' or  three_price >= '$least' and three_price <= '$more'  ");
      
      echo '<div id="res"> if am right , you want a hostel with Distance  between '.calculatedis($distance2).' to '.calculatedis($distance).' percent close to campus<br>';
      echo 'with Prices between GHC'.$least.' and '.$more.' also, you want a';
      echo ''.$private.'type of accomodation with ';
      echo ':'.$security.' Security Type</div>';


      while ($row2 = mysqli_fetch_array($sele2)) {
          
            $sec = $row2['securitys'];
            $money1 = $row2['one_price'];
            $money2 = $row2['two_price'];
            $money3 = $row2['three_price'];
            $fdis = calculatedis($row2['distance']);



            if($sec != $security && $money1 > $more || $money2 > $more || $money3 > $more && ($fdis > $access && $fdis < $access2) ){
                
                  echo '<div id="spsp">
                        <span style="color:red;">'.$row2['hname'].'</span><br>
                        '.rating($row2['id']).'
                        <ul>
                           <li> &#x2714 Cost 20% within your choice </li>
                           <li> &#x2714 accomadation </li>
                           <li> &#x2716 Security </li>
                           <li> &#x2716 Distance </li>
                        </ul>
                    </div>
                  ';

            }else if($sec === $security && $money1 > $more || $money2 > $more || $money3 > $more &&  ($fdis > $access && $fdis < $access2) ){

                echo '<div id="spsp">
                        <span style="color:rgb(182, 182, 0);">'.$row2['hname'].'</span><br>
                        '.rating($row2['id']).'
                        <ul>
                           <li> &#x2714 Cost 50% within your choice </li>
                           <li> &#x2714 accomadation </li>
                           <li> &#x2714 Security </li>
                           <li> &#x2716 Distance </li>
                        </ul>
                    </div>
                  ';
           }
          
            else if($sec === $security && $money1 <= $more || $money2 <= $more || $money3 <= $more &&  ($fdis <= $access && $fdis >= $access2) ){

                  echo '<div id="spsp">
                  <span style="color:green;">'.$row2['hname'].'</span><br>
                  '.rating($row2['id']).'
                  <ul>
                     <li> &#x2714 Cost 100% within your choice</li>
                     <li> &#x2714 accomadation </li>
                     <li> &#x2714 Security </li>
                     <li> &#x2714 Distance </li>
                  </ul>
              </div>
            ';

            }else{
                echo "couldnt find any hostel of that choice...";
            }
        }
    } 
}


function fetchImg($hid)
{
    include 'db.php';

    $sele = mysqli_query($con,"SELECT * FROM hotels WHERE id = '".$hid."' ");

    while($row = mysqli_fetch_array($sele)){


        echo '<div class="cover">
        <div class="imagebox">
          <div class="close">
            <img id="closeimg" src="assets/close.png" alt="" srcset="">
          </div>
          <div class="ite">
          <p>Sample Image for One in a Room</p>
          <img id="pics" src="http://localhost/hostel2/oneroom/'.$row['one_img'].'" alt="" srcset="">
         </div>
         <div class="ite">
          <p>Sample Image for Two in a Room</p>
          <img id="pics" src="http://localhost/hostel2/tworoom/'.$row['two_img'].'" alt="" srcset="">
         </div>
         <div class="ite">
          <p>Sample Image for Two in a Room</p>
          <img id="pics" src="http://localhost/hostel2/threeroom/'.$row['three_img'].'" alt="" srcset="">
         </div>
        </div>
     </div>
';

       

    }

}







function getIntroImg($id)
{
    include 'db.php';

    $sele  = mysqli_query($con,"SELECT * FROM hotels WHERE id = '$id' ");


    $row = mysqli_fetch_array($sele);

    $img = $row['introImg'];

    if (empty($img)) {
        $img = 'assets/6s.jpg';
    }else{
        $img = 'http://localhost/hostel2/int/'.$row['introImg'];
    }

    return $img;
    

}



function hostel_name($id)
{
    include 'db.php';

    $sele  = mysqli_query($con,"SELECT * FROM hotels WHERE id = '$id' ");

    $row = mysqli_fetch_array($sele);

    return $row['hname'];
    
}



function Most_reted()
{
    include 'db.php';

    $sele  = mysqli_query($con,"SELECT * from hotels ORDER BY points DESC LIMIT 6");
    
        
    while ($row = mysqli_fetch_array($sele)) {
             
              $per = ($row['points']/100)*100;

        echo '
              <div id="list1">
                  <div class="elem">
                  <img id="hoimg" src="'.getIntroImg($row['id']).'">
                    <div class="hnamex">
                        '.$row["hname"].'
                    </div>
                        <div class="views">
                             '.$per.'%
                             <div class="p">
                               <div style="width:'.$per.'%;" class="ra"></div>
                             </div>
                        </div>
                  </div>
              </div>
             ';


    }
   

}





function rating($id)
{
    include 'db.php';

    $sele  = mysqli_query($con,"SELECT sum(score) as sums FROM feeds WHERE hid = '$id' ");


  
    while($row = mysqli_fetch_array($sele)){

        $sum =  round($row['sums']);

         mysqli_query($con,"UPDATE hotels SET points = '$sum' WHERE id = '$id' ");


        
        
         if ($sum >= 10 || $sum <= 10 ) {
             $img = '<img id="house" src="assets/hstar.png" alt="" srcset="">';
         }
         if ($sum >= 20) {
             $img = '<img id="house" src="assets/1star.png" alt="" srcset="">';
         }
         if ($sum >= 30) {
             $img = '<img id="house" src="assets/1hstar.png" alt="" srcset="">';
         }
         if ($sum >= 40) {
            $img = '<img id="house" src="assets/2star.png" alt="" srcset="">';
         }
         if ($sum >= 50) {
            $img = '<img id="house" src="assets/2hstar.png" alt="" srcset="">';
         }
         if ($sum >= 60) {
            $img = '<img id="house" src="assets/3star.png" alt="" srcset="">';
         }
         if ($sum >= 70) {
            $img = '<img id="house" src="assets/3hstar.png" alt="" srcset="">';
         }
         if ($sum >= 80) {
            $img = '<img id="house" src="assets/4star.png" alt="" srcset="">';
         }
         if ($sum >= 90) {
            $img = '<img id="house" src="assets/4hstar.png" alt="" srcset="">';
         }
         if ($sum >= 100) {
            $img = '<img id="house" src="assets/5star.png" alt="" srcset="">';
         }
         
         



         return $img;

    }



}







function ServerScript2()
{
    echo '
 <script>
 
   $(".cover").hide();

 $("#images").click(function (params) {
    $(".cover").fadeIn(200);
    $(".imagebox").fadeIn(300);
})


$("#closeimg").click(function (params) {
         $(".cover").fadeOut(200);
         $(".imagebox").hide();
})

    
    </script>
    ';
}





function ServerScript()
{
    echo '
    <script>
    $("#postfeed").click(function (e) {

        e.preventDefault();
        var data = $("#textbox").val()
        $.ajax({
            url:"handler.php?fun=inserComm",
            method:"post",
            dataType:"text",
            data:{comment:data},
            beforeSend:function (params) {
                
            },
            success:function (response) {
                $(".msg").css({
                    background:"green",
                })
                $(".msg").html(response)
            }

        })
 })
    
    </script>
    ';
}



function O_sentiment2($string)
{

  include ('sent/lib/sentiment_analyser.class.php');
  $sa = new SentimentAnalysis();
  $sa->initialize();
  $sa->analyse($string);
  $score = $sa->return_sentiment_rating();
  
  if ($score < 2.5) {

       $rate = -$score;
      
  }elseif ($score > 2.5) {

       $rate = $score;
      
  
  }elseif ($score >= 2.0 || $score <= 2.5 ) {
  
       $rate = $score;
      
  
  }

  return $rate;
  
}








function inserComm()
{
      include 'db.php';

      $comment = $_POST['comment']; 

      $score = O_sentiment2($comment);

      $hid = $_SESSION['hid'];

      $date = date('D-M-Y');

      $hostel  = hostel_name($hid);

      if (mysqli_query($con,"INSERT INTO feeds(feeds,hid,score,date,hname)VALUES('".$comment."','".$hid."','".$score."','".$date."','".$hostel."')")) {
        
              echo "Posted Successfully !!";

      }else{
              echo "Oops could not post data";
      }


      
}




function Predict_chart($afford,$prone,$social)
{
    echo "
    

    <script>
              

    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Affordability','Prone to school resources', 'Prone to social expirence'],
            datasets: [{
                label: '# of Predictions',
                data: [".$afford.", ".$prone.",".$social."],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                   
                    
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>

         ";
}



function Recently_searched()
{

    include 'db.php';

    

    $sele  = mysqli_query($con,"SELECT * FROM recent ORDER BY id DESC LIMIT 5 ");

    while($row = mysqli_fetch_array($sele)){
            $id  = $row['hid'];

           $sele2  = mysqli_query($con,"SELECT * from hotels WHERE id= '".$id."' ");
           
           while ($row2 = mysqli_fetch_array($sele2)) 
           {
            echo '
            <div id="list1">
                <div class="elem">
                <img id="hoimg" src="'.getIntroImg($row['id']).'">
                  <div class="hnamex">
                      '.$row2['hname'].'
                  </div>
                      <div class="views">
                        <span style="color:green;">'.$row["date"].'</span>
                      </div>
                </div>
            </div>';
           }  
    }

}



function Most_searched_hostel()
{
       include 'db.php';
       
    //    $database = $_SESSION['DataLocation'];

       $sele  = mysqli_query($con,"SELECT hid, count(*) as cnt FROM recent GROUP BY hid order by cnt desc LIMIT 10 ");

       while($row = mysqli_fetch_array($sele)){
         
        $id = $row['hid'];
        $views = $row['cnt'];

       $sele2  = mysqli_query($con,"SELECT * from hotels WHERE id= '".$id."' ");
           
         while ($row2 = mysqli_fetch_array($sele2)) {
             
             echo '
                   <div id="list1">
                       <div class="elem">
                       <img id="hoimg" src="'.getIntroImg($row2['id']).'">
                         <div class="hnamex">
                             '.$row2['hname'].'
                         </div>
                             <div class="views">
                               '.$views.' views
                             </div>
                       </div>
                   </div>
                  ';


         }
        
       }

       
}



function number_of_rooms($one = null,$two = null,$three = null)
    {
                return "
                

                <script>

                var ctx = document.getElementById('myChart').getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['One in room', 'Two in a room ', 'Three in a room'],
                        datasets: [{
                            label: 'available',
                            data: [".$one.", ".$two.", ".$three."],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
                </script>

                ";
    }



    function fetchinfo_location($location,$search)
    {

        include 'db.php';

            if ($location == 'ucc') {


                $DataLocation = 'hostel';

                $_SESSION['DataLocation'] = $DataLocation;


    
            }else if($location == 'legon'){

                $DataLocation = 'hostel_leg';

                $_SESSION['DataLocation'] = $DataLocation;



            }else if($location == 'knust'){

                 $DataLocation = 'hostel_knust';

                 $_SESSION['DataLocation'] = $DataLocation;


            }else{

                echo '<script> window.location.href="error.html" </script>';

            }

            $database = $_SESSION['DataLocation'];

            $sele = mysqli_query($con,"SELECT * FROM {$database}.hotels WHERE hname LIKE '%".$search."%' OR location LIKE '%".$search."%' OR landmark LIKE '%".$search."%' ");

     
            while ($row = mysqli_fetch_array($sele)) {
            
             $id              = 'hostel:'.$row['id'];
             $one_in_room     = $row['one_available'];
             $two_in_room     = $row['two_available'];
             $three_in_room   = $row['three_available'];
             $total_num_room  = $row['total_num_room'];
             $location        = $row['location'];
             $hostel_name     = $row['hname'];
             $land_mark       = $row['landmark'];


             $available_rooms = ($one_in_room + $two_in_room + $three_in_room );


             echo '
             <div class="contain">
           
               <div class="b1p">
                  <div class="himg">
                     <img id="house" src="'.getIntroImg($row['id']).'" alt="" srcset="">
                  </div>
           
                  <div id="'.$id.'" class="nameb">
                        <p>'.$hostel_name.'</p>
                  </div>
             
               </div>
              
               <div class="b1">
                  <div class="himg">
                     <img id="house" src="assets/location.png" alt="" srcset="">
                     <div class="locate">'.$location.' . '.$land_mark.'</div>
                  </div>
               </div>
               <div class="b1r">
                  '.rating($row['id']).'
                  <br><button class="review" id="'.$id.'">See Review</button>
               </div>
            </div>
          
             
                  ';
         
        }
         echo ' 
          <script>




       $(".review").click(function(e){


        $("#showev").css({
             marginLeft:"0px",
             transition:"0.3s"
        })

         e.preventDefault();

        var id = this.id;
        var info = id.split(":");
        var Data = info[1];
        $.ajax({
            url:"handler.php?fun=showrev",
            method:"post",
            dataType:"text",
            data:{datas:Data},
            beforeSend:function () {
               $("#aibot").attr("src","assets/load.gif")
            },
            success:function (response) {
               $(".boxa").html(response);
               $("#aibot").attr("src","assets/ll.png")
            }
        })



       })





          $(".nameb").click(function (){
    

       var id = this.id;
       var info = id.split(":");
       var newData = info[1];

      
    
         $.ajax({
             url:"handler.php?fun=showdet",
             method:"post",
             dataType:"text",
             data:{dataId:newData},
             beforeSend:function () {
                $("#aibot").attr("src","assets/load.gif")
             },
             success:function (response) {
                $("#display").html(response);
                $("#aibot").attr("src","assets/ll.png")
             }
         })

  }) 
  </script>
  ';
    }




function fetchinfo()
{
          $search = $_POST['data'];

          fetchinfo_location('ucc',$search);

}





function showdet()
{
    include 'db.php';
    include 'linearRegession.php';
    

    
    $id = $_POST['dataId'];

    ServerScript();

    $_SESSION['hid'] = $id;

    $database = $_SESSION['DataLocation'];

    $date = date("D-M-Y");

    $sele = mysqli_query($con,"SELECT * FROM {$database}.hotels WHERE id = '".$id."' ");

    mysqli_query($con,"INSERT INTO {$database}.recent(hid,date)VALUES('".$id."','".$date."') ");


    while ($row = mysqli_fetch_array($sele)){


        $id                 = $row['id'];
        $one_in_room        = $row['one_available'];
        $two_in_room        = $row['two_available'];
        $three_in_room      = $row['three_available'];
        $total_num_room     = $row['total_num_room'];
        $location           = $row['location'];
        $hostel_name        = $row['hname'];
        $accomodation_type  = $row['accomodation'];
        $hostel_type        = $row['hostel_type'];
        $oneroom_img        = $row['one_img'];
        $tworoom_img        = $row['two_img'];
        $threeroom_img      = $row['one_img'];
        $distance           = $row['distance'];
        $price_for_one      = $row['one_price'];
        $price_for_two      = $row['two_price'];
        $price_for_three    = $row['three_price'];
        $land_mark          = $row['landmark'];





        # calculation for pecentage distance in km
        # 84 = 0.5
        $dv = 0.5;
        $dc = 84;
        $dres = $distance;
        $dval = round(($dv/$distance)*$dc);

     
        $for_time_at_distance = 38.1;
        $average_distance = 3.1;
        # calculating for time spent on distance
        $time_take_walking = round(($distance/$average_distance)*$for_time_at_distance); #the use of ratio and proportion



        # calculating prone to school resources
        $prone_to_resources = null;

        if ($dval >= 70 || $dval <= 85 ) {
                     $prone_to_resources  =  75;
        }
        if ($dval >= 50 || $dval <= 69) {
                     $prone_to_resources  =  50;
        }
        if ($dval >= 30 || $dval <= 49) {
                     $prone_to_resources  =  35;
        }
        if ($dval >= 10 || $dval <= 29) {
                     $prone_to_resources  =  20;
        }
        if ($dval < 10) {
                     $prone_to_resources  = 9;
       }

       
       # claculating for security
       #distance , time 
       #the lesser the time the more secured 
       #security here is mesured to to night time
       
       #for 6 percent s = 40
       $constant_time_take_walking = 6; 
       $constant2 = 50;
       $security = ($time_take_walking/$constant_time_take_walking)*$constant2;


       #  calculating  social experience
       $social_life = round($total_num_room/$time_take_walking);



      
       // calculating affordability
       $av_num = 0;
       $afford_price_percentage = 0;
       $average_fee = 900;

    if ($accomodation_type == 'one') {
       $av_num = 1;
    }
    if ($accomodation_type == 'two') {
       $av_num = 1;
     }
     if ($accomodation_type == 'three') {
        $av_num = 1;
    }
    if ($accomodation_type == 'one_and_two') {
        $av_num = 2;
    }
    if ($accomodation_type == 'one_two_three') {
        $av_num = 3;
    }
   
    
       $average_price = ($price_for_one + $price_for_two + $price_for_three)/$av_num;



       $afford_price_percentage = round(($average_fee/$average_price)*100);
       if ($afford_price_percentage > 90) {
           $afford_price_percentage = 85;
       }
   
   
      

    

      
      $frequency = $afford_price_percentage + $social_life + $prone_to_resources;

      $social_life_n = round(((($social_life/$frequency)*360)/360)*100);
      $afford_price_percentage_n = round(((($afford_price_percentage/$frequency)*360)/360)*100);
      $prone_to_resources_n = round(((($prone_to_resources/$frequency)*360)/360)*100);







        $race  = '<span id="per"><b>Type </b></span>: ( '.$hostel_type.' ) ';

        // specifying types of hostels
        $message = '';
        $icons = '';
        if ($accomodation_type == 'one_and_two') {
             
            $message = "<span id='per'><b> Description </b> </span>: Both one and two in a room type of accomodation";
            $race ;
           
        }
        if ($accomodation_type == 'one_two_three') {
             
           $message = "<span id='per'><b> Description </b> </span>: Both one , two  and three in a room type of accomodation";
           $race ;
       }
       if ($accomodation_type == 'one') {
             
        $message = "<span id='per'><b> Description </b></span>: Only One in a room type of accomodation";
        $race ;

       }
       if ($accomodation_type == 'two') {
             
        $message = " <span id='per'><b>Description </b> </span>: Only Two in a room type of accomodation";
        $race;
       }
       if ($accomodation_type == 'three') {
             
        $message = "<span id='per'><b>Description</b></span> : Only three in a room type of accomodation";
        $race ;
       }



       $disclaimer = '';
       $t = 60; # = 1 hour
       



       # Display images of hostels
       fetchImg($id);



       # years calculate script
       ccc();


         
           echo '<div class="maininfo">
           <div class="pan1">
                 <img id="hoimg" src="'.getIntroImg($id).'">
                 <span id="per">'.$hostel_name.'</span> is <span id="per">'.$dval.'%</span> close to Campus 
                 '.rating($id).'
           </div>
           <!--  -->
           <div class="visualize">
               <div style="width:'.$dval.'%;" class="distance">
                  <img id="dis" src="assets/house3.png" alt="" srcset="">
                  <center id="pe">'.$dval.'%</center>
               </div>
               <div style="width:'.(100-$dval).'%;" class="range">
                   <img id="walk"  src="assets/walk.png" alt="" srcset="">
                   <img id="dis" src="assets/school.png" alt="" srcset="">
                   <center id="pe">'.$time_take_walking.' mins walk </center>
               </div>
           </div>
           <!--  -->
           <div class="main_cont">
           '.number_of_rooms($one_in_room,$two_in_room,$three_in_room).'
          
            <div class="ch">
            <h3>Available rooms</h3>
               <canvas id="myChart" width="200" height="200"></canvas>
            </div>
            

            <div class="ch">
            <h3>About</h3>

            <ul>
            <li>
               <div class="item">'.$message.'</div>
            </li>
            <li>
               <div class="item">'.$race.'</div>
            </li>
            <li>
               <div class="item"><span id="per"><b>Location</b></span> : '.$location.'</div>
            </li>
           </ul>
            </div>    
            <div class="ch">
            <h3>Rules and Rgulations</h3>
            <span id="per"></p></span>
                <div class="botn">
                   <img id="aibot" src="assets/ll.png" id="">
                   <div class="msg">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque in velit consequuntur sapiente? Excepturi, a ducimus.     
                   </div>
                </div>
            </div>         
              
           </div>

                 <div class="second">
                 <div class="ph">
                    Here are some possible Predictions made so far ...
                 </div>
                         <div class="char">
                         <h3>Prdictions</h3>
                         <div class="diva">
                         <canvas id="myChart2" width="500" height="500"></canvas>
                         </div>
                            '.Predict_chart($afford_price_percentage_n,$prone_to_resources_n,$social_life_n).'
                         </div>
                         <div class="char">
                           <h3>Budget Calculator</h3>
                           <ul>
                              <li id="per">how many Years have you got left</li>
                              <li><input type="number" id="inpc" placeholder="Enter the rest of your accadamic years left"></li>
                                <div class="telthem"></div>
                           </ul>
                         
                         </div>
                         
                         <div class="charx">
                             <div id="jus"><h3>Prices</h3></div>
                             
                             <div id="tab">
                              <span id="per"><p><b>Prices for one(1) in a room</b></p></span>
                               <center><img id="catego" src="assets/one.png"></center>
                              <div class="amount">GHC : '.$price_for_one.'.00</div>
                             </div>
                             <div id="tab">
                              <span id="per"><p><b>Prices for two(2) in a room</b></p></span>
                              <center><img id="catego" src="assets/two.png"></center>
                              <div class="amount">GHC : '.$price_for_two.'.00</div>

                             </div>
                             <div id="tab">
                             <span id="per"><p><b>Prices for three(3) in a room</b></p></span>
                             <center><img id="catego" src="assets/three.png"></center>
                             <div class="amount">GHC : '.$price_for_three.'.00</div>
                             </div>
                             <div id="tab">
                             <span id="per"><p><b>Call Now</b></p></span>
                             <center><a href="tel:0249576859"><img id="call" src="assets/pho.png"></a></center>
                             </div>
                             <div id="tab">
                             <span id="per"><p><b>View Sample Images</b></p></span>
                             <center><img id="images" src="assets/viewimg.png"></center>
                             
                             </div>
                           <script>
                           $("#call2").click(function (params) {
                            $("#feedbox").css({
                                height:"auto"
                            })
                            $("#call2").fadeOut()
                           })
                           </script>
                         </div>
                         <div class="chatbox">
                           <h3 id="h3s">Here is what people say about this Hostel...</h3>
                              <div id="feedbox">
                                   
                              </div>
                              <div id="fade" class="b">
                              <button id="call2">view all</button>
                              </div>
                              <div class="b">
                                <div class="botn">
                                   <img id="aibot" src="assets/ll.png" id="">
                                   <div class="msg">
                                   <b>what can you say about this hostel ? leave a comment , remember that your feedback
                                    is needed to improve this  system thank you....</b>
                                   </div>
                                  </div>
                                  <form action="" method="post">
                                  <textarea name="comment" id="textbox" cols="0" rows="0" placeholder="Leave a Comment..."></textarea><br>     
                                  <input id="postfeed" type="submit" value="Post feed">                   
                                  </form>
                              </div>
                
                         </div>
                 </div>
                    
       </div>';
      

    }
    ServerScript2();
}




function fetchComm()
{
    include 'db.php';

    $hid = $_SESSION['hid'];

    $sele = mysqli_query($con,"SELECT * FROM feeds WHERE hid = '".$hid."' order by hid desc");

    while ($row = mysqli_fetch_array($sele)) {
        
         echo '
         
              <div class="tboxs">
                 <img id="aibot" src="assets/user.png" id="">
                 <div class="textbox">
                     '.$row['feeds'].'
                 </div>
              </div>
         
              ';

    }

     
}






function finder()
{
    include 'db.php';

    $find = $_POST['find'];

    $sele = mysqli_query($con,"SELECT * FROM hotels WHERE hname LIKE('%".$find."%')");

    while ($row = mysqli_fetch_array($sele)) {
        $id = $row['id'];
         echo '
         
              <div id="id:'.$id.'" class="tboxx">
                 <img id="aibot" src="'.getIntroImg($id).'">
                 <div class="textbox">
                     '.$row['hname'].'
                 </div>
              </div>
         
              ';

    }
    findscript();
}


function findscript()
{

    echo "
    <script>
    
    $('.tboxx').click(function (e) {

        e.preventDefault();

        var id = this.id;
        var arr = id.split(':');
        var data = arr[1];


        $.ajax({
            url:'handler.php?fun=feed',
            method:'post',
            dataType:'text',
            data:{id:data},
            beforeSend:function (params) {
                
            },
            success:function (data) {
                $('.finder').html(data)
            }
        })


     })
    
    
    </script>
    
    
        ";
}

function feed()
{
    include 'db.php';

    $id = $_POST['id'];


    $_SESSION['n_id'] = $id;

    $new_id = $_SESSION['n_id'];

    $sele = mysqli_query($con,"SELECT * FROM hotels WHERE id ='$new_id' ");

    while ($row = mysqli_fetch_array($sele)) {

         echo '
           <div id="">
               <p>Say somthing about <span id="per">'.$row['hname'].'</span></p>

               <form id="feedform" action="" method="post">
                   <textarea name="feedtxt" id="feedtxt" cols="0" rows="0" placeholder="Say something..."></textarea>
                   <input type="hidden" id="name"  name="name" value="'.$row['hname'].'">
                   <input type="submit" id="sufeed"  name="post" value="Post Feed">
               </form>
           </div>
         
              ';

    }

    sendfeedscript();
}


function sendfeedscript()
{
    echo '<script>
    $("#sufeed").click(function (e) {

        e.preventDefault();

        $.ajax({
             url:"handler.php?fun=sendfeed",
             method:"post",
             dataType:"text",
             data:$("#feedform").serialize(),
             beforeSend:function (params) {
                 
             },
             success:function (data) {
                 if (data == "done") {
                    $("#noti").fadeIn(200)
                    $("#noti").html("your feed is submitted successfully thank you ...")
                     setTimeout(function(params) {
                         $("#noti").fadeOut(200)
                     },3000)
                 }else{
                    $("#noti").fadeIn(200)
                    $("#noti").html(data)
                    setTimeout(function(params) {
                         $("#noti").fadeOut(200)
                     },3000)
                 }
             }
        })

 })
    
     
         </script>';
}

function sendfeed()
{

    include 'db.php';

    $text  = $_POST['feedtxt'];

    $hid   = $_SESSION['n_id'];

    $name  = $_POST['name'];

    $date  = date('D-M-Y');

    $score = O_sentiment2($text);

    if(mysqli_query($con,"INSERT INTO feeds(feeds,hid,score,date,hname) VALUES('".$text."','".$hid."','".$score."','".$date."','".$name."')"))
    {
          echo 'done';
    }else{
          echo 'Oops ';
    }


}


function showrev()
{

    include 'db.php';

    $id =  $_POST['datas'];

    $sele = mysqli_query($con,"SELECT * FROM feeds WHERE hid ='".$id."' ");


    while($row = mysqli_fetch_array($sele)) {

             echo '

              <div class="tboxxx">
                 <img id="aibotZz" src="assets/user.png" id="">
                 <div class="textbox">
                     '.$row['feeds'].'
                 </div>
              </div>

             ';
   

    }

}