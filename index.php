<?php
session_start();
include 'engine.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="media.css">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">

    <title>Hostyle</title>
   
    <script src="jquery.js"></script>    
    <script src="rs.speech.js"></script>
    <script src="main.js"></script>
    <script src="Chart.min.js"></script>
	 <script src="utils.js"></script>

</head>
<body>



   <div class="file"></div>


   <div class="aishow">
         <img id="bba" src="assets/menu2.png" alt="" srcset="">
         <center>
         <img id="aibotxx" src="assets/ll.png" alt="" srcset="">
         
        <div class="st1">
           Hi there !!, welcome to hostyle, let me help you find a hostel of your choice
        </div>
         <div class="st2">
        <div class="st1">Now, Lets start by filling the questions below.."</div>

               <form id="fff" action="" method="post">
                  <div class="slide">
                      <div class="q1">
                           <span id="per"><h2>Accessibily and Convenience</h2></span>
                           <p>how close do you want your hostel to be with respect to the campus...</p>
                           <select name="close" id="inp">
                               <option value="---">How Close</option>
                               <option value="20">10-20%</option>
                               <option value="30">20-30%</option>
                               <option value="40">30-40%</option>
                               <option value="50">40-50%</option>
                               <option value="60">50-60%</option>
                               <option value="70">60-70%</option>
                               <option value="80">70-80%</option>
                               <option value="90">80-90%</option>

                           </select>
                           <button class="sbu"  id="next">Next</button>

                      </div>
                      <!-- end q1 -->
                      <div class="q2">
                         <span id="per"><h2>Cost</h2></span>
                         <p>how much do you think you can afford for a hostel...</p>
                         <select name="cost" id="inp">
                               <option value="---">How Much can you afford</option>
                               <option value="500:900">GHC 500 - 900</option>
                               <option value="900:1000">GHC 900 - 1000</option>
                               <option value="1000:2000">GHC 1000 - 2000</option>
                               <option value="2000:3000">GHC 2000 - 3000</option>
                               <option value="3000:4000">GHC 3000 - 4000</option>
                               <option value="4000:5000">GHC 4000 - 5000</option>
                               <option value="5000:6000">GHC 5000 - 6000</option>
                           </select>
                           <button class="sbu"  id="next2">Next</button>
                           <button  class="sbu" id="back2">Back</button>


                      </div>
                      <!-- end q2 -->
                      <div class="q3">
                       <span id="per"><h2>Safety And Security</h2></span>
                         <p>how do you want to be safe</p>
                         <select name="sec" id="inp">
                               <option value="---">Choose type of hostel security</option>
                               <option value="rules">Hostels with rules and regulations</option>
                               <option value="gaurds">Hostels with security gaurds</option>
                               <option value="personal">Hostels with personal security system</option>
                           </select>
                           <button class="sbu"  id="next3">Next</button>
                           <button class="sbu" id="back3">Back</button>

                      </div>
                      <!-- end q3 -->
                      <div class="q4">
                      <span id="per"><h2>Privacy</h2></span>
                         <p>how private do you want to live</p>
                         <select name="priv" id="inp">
                               <option value="---">Choose type of Privacy</option>
                               <option value="one_and_two">Hostels with one and two room type</option>
                               <option value="one_two_tree">Three in room</option>
                           </select>
                           <button class="sbu"  id="back4">Back</button>
                           <input class="sbus" type="submit" id="aifind" value="Find">
                      </div>
                      <!-- end q4 -->
                   
            
               
                  
        </center>
                 
               </form>
            </div>
   </div>
   <!-- slide pane -->
   <div id="showev">
        <div class="boxx">
            <img id="aibotZ" src="assets/menu2.png" alt="" srcset="">
        </div>
       <div class="boxa">
                
       </div>

   </div>

        <form id="form" action="" method="post">
            <div type="submit" id="bot"><img id="aibot" src="assets/ll.png" alt="" srcset=""></div>
            <input type="text" name="search" id="search" placeholder="Search for your hostel , location or a landmark ...">
        </form>
        <!-- end of head -->
        <div id="banabox">
        <div class="foot">
         A product of <span id='c1'>O</span> <span id='c2'>Analytics</span>&reg; <?php echo date("Y")?>
        </div>
<div class="title">
   <h3> A new style to choose your hostel...</h3>
</div>
<!-- ANIMATION SECTION -->

<center>

<div class="anibox">
    <div class="c1">
        <center>
        <div class="c2">
            <div class="eye1"></div>
            <div class="eye2"></div>
            <div class="mouth"></div>
        </div>
        </center>
        <div class="point"></div>
    </div>
</div>

</center>
<!-- END OF ANIMATION SECTION -->
               <img id="banna" src="assets/mlogo.png" alt="" srcset="">
                
               <div class="start">
                  <center>
                    <button id="stb">
                        Find Hostel
                    </button>
                  </center>
               </div>
         </div>

          <div class="footer">
           
            <div class="note">
               <center>
               <h2 class="re1">Welcome to hostyle</h2>
                <img id="iimg" src="assets/newban.png" alt="" srcset="">
                   
               </center>
               <p>Welcome to a new style of choosing your Hostel using Artificial Interligence</p>
               <h2 class="re1">Find your Hostel using AI ...</h2>
               <p>For college students, having a safe, comfortable place to live is 
                  an essential part of being able to focus and do good work in school. But whether its a 
                  convenient on-campus dorm or an off-campus apartment, student housing 
                  presents challenges that students 
                  need to consider before they <span id="per"> decide</span> where to live each semester 
                  and <span id="per">Hostyle is here to solve that problem </span>with advance <span id="per"> Artificial Interlligence ..</span>
                  </p>
                    <button class="vis" id="aibutt">
                    <img id="aibotxx" src="assets/ll.png" alt="" srcset=""> <br>
                     Use AI
                    </button>
               <div class="rfeed">
                 <h2 class="re1">Give a feed on your Hostel ...</h2>
                 <h3 class="re2">Do you already have a hostel ? Your feed is needed to improve the functionality of the app</h3>
                 <button id="noti"></button>
                 <form action="" method="post">
                     
                        <input type="text" name="" id="find" placeholder="What is the name of your hostel ?">
                    
                 </form>
                 <div class="finder">
                 </div>

               </div>
            </div>
            <div class="note">
                <center>
               <span id="per"><p><b>Top 10 Most Viewed Hostels</b></p></span>
                <img id="iimg" src="assets/mviewd.png" alt="" srcset="">
                    <button class="vis" id="stbs">
                        View
                    </button>
               </center>
                    
               <div class="n1"></div>
            </div>
            <div class="note">
               
               <center>
               <span id="per"><p><b>People also Serached for</b></p></span>
               <img id="iimg" src="assets/msearched.png" alt="" srcset="">
               <button class="ser" id="stbs">
                        View
                    </button>
               </center>
                    
               <div class="n2"></div>
            </div>
            <div class="note">
           
            <center>
            <span id="per"><p><b>Top 6 Most rated hostels</b></p></span>
               <img id="iimg" src="assets/mrated.png" alt="" srcset="">
                    <button class="rat" id="stbs">
                        View
                    </button>
            </center>
                   
               <div class="n3"></div>
            </div>
          </div>
          
        <!-- display form -->
    
       <div id="display">
           
       </div>




       
   
</body>
</html>