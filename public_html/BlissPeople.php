<!DOCTYPE html>
<?php          
        include("header.php");
?>
      
<html>
  <head>
    <title> BlissQuants - Delta Hedging | Fund Management </title>
 
    <link href="Carousel-Marquee-Like-List-Scrolling-Plguin-For-jQuery-Scrollbox/demos/demo.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/custom.css" />
<script src="Carousel-Marquee-Like-List-Scrolling-Plguin-For-jQuery-Scrollbox/jquery.scrollbox.js"></script>
    <style>
  
.scroll-img {
  border: 1px solid red;
  width: 100%;
  height: 450px;
  overflow: hidden;
  font-size: 0;
  border:none;
}
.scroll-img ul {
  width: 700px;
  height: 600px;
  margin: 0;
   white-space:nowrap; 
}
.scroll-img ul li {
  display: inline-block;
 
  margin: 10px 0 10px 10px;
}
.margin-left{
    margin-left: 5%;
} 

.hovereffect {
width:100%;
height:70%;
float:left;
overflow:hidden;
position:relative;
text-align:center;
cursor:default;
padding: 0% 0%;

}
.hovereffect1 .overlay {
width:100%;
height:250px;
position:absolute;
overflow:hidden;
top:0;
left:0;
opacity:0;
background-color:rgba(0,0,0,0.5);
-webkit-transition:all .4s ease-in-out;
transition:all .4s ease-in-out; 
border-radius: 50%;
    
}
.hovereffect .overlay {
width:100%;
height:280px;
position:absolute;
overflow:hidden;
top:0;
left:0;
opacity:0;
background-color:rgba(0,0,0,0.5);
-webkit-transition:all .4s ease-in-out;
transition:all .4s ease-in-out; 
    
    
}

.hovereffect img {
display:block;
position:relative;
-webkit-transition:all .4s linear;
transition:all .4s linear;

}

.hovereffect h2 {
text-transform:uppercase;
color:#fff;
text-align:center;
position:relative;
font-size:17px;
background:rgba(0,0,0,0.6);
-webkit-transform:translatey(-100px);
-ms-transform:translatey(-100px);
transform:translatey(-100px);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
padding:10px;

}

.hovereffect a.info {
text-decoration:none;
display:inline-block;
/*text-transform:uppercase;*/
color:#fff;
/*border:1px solid #fff;*/
background-color:transparent;
opacity:0;
filter:alpha(opacity=0);
-webkit-transition:all .2s ease-in-out;
transition:all .2s ease-in-out;
margin:90px 0 0;
padding:5% 5%;
font-size: 16px;
}

.hovereffect a.info:hover {
box-shadow:0 0 5px #fff;
}

.hovereffect:hover img {
-ms-transform:scale(1.05);
-webkit-transform:scale(1.05);
transform:scale(1.05);

}

.hovereffect:hover .overlay {
opacity:1;
filter:alpha(opacity=100);

}

.hovereffect:hover h2,.hovereffect:hover a.info {
opacity:1;
filter:alpha(opacity=100);
-ms-transform:translatey(0);
-webkit-transform:translatey(0);
transform:translatey(0);
}

.hovereffect:hover a.info {
-webkit-transition-delay:.2s;
transition-delay:.2s;
}

.img_circle{
   
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    padding:2% 5%;
}
.img_team{
    height:100%; 
    
}
.person_title{
    color:  rgb(132,194,37);
    text-align: center;
   
}
.padd{
    padding-top: 5%;
    padding-left: 5%;
}
.img-responsive{
     height:80% !important;
    width:80% !important;
}
.img-responsive2{
     height:80%;
    width:100% !important;
}
.img-responsive2 + .overlay{
    width:100%;
}
#node_people{
    height:80%;
}
#node_people  .overlay{
    height:90%;
    width:100%;
}
img {
    display:block;
    margin:auto;
}
           </style>
    <script>
        $(function (){

$('#demo2').scrollbox({
    linear: true,
    step: 1,
    delay: 0,
    speed: 35,
     direction: 'h'
  });
   $(function() {
            $('a').click(function() {
             if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                  $('html,body').animate({
                    scrollTop: target.offset().top
                  }, 1000);
                  return false;
                }
              }
            });
        });

});

       
        </script>
    
  </head>
   <body id = "top">
   
    <div class="row wrap margin-left">  
             <div class="col-lg-12 col-md-12 col-sm-12  ">
           
                
               
                  
                       <div class="col-lg-3 col-md-3 col-sm-12    col-md-offset-4 ">
                        <div class="hovereffect text-center">
                            <img class="img_circle" src="people/papa.jpg" alt="" >
                            <div class="overlay">
                               <h2>Bharatbhai Shah</h2>
                               <a class="info" href="#">I admire quality.</a>
                            </div>
                            <br><h5 class="person_title">A divine inspiration & Fearless leader</h5>
                        </div>
                       </div>                         
           
               
                      
            </div>   
        <div class="col-lg-12 col-md-12 col-sm-12  ">
           
                     <div class="col-lg-3 col-md-3 col-sm-12 ">
                        <div class="hovereffect">
                            <img class="img_circle" src="people/Falguni.JPG" alt="">
                            <div class="overlay">
                               <h2>Falguni Vahora</h2>
                               <a class="info" href="#">I enjoy analytics.</a>
                            </div>
                            <br><h5 class="person_title">Data Analytics &<br>  Coaching Head </h5>
                        </div>
                     </div>  
               
                    <div class="col-lg-3 col-md-3 col-sm-12  ">
                        <div class="hovereffect">
                            <img class="img_circle" src="people/Rupak.JPG"   alt="">
                            <div class="overlay">
                               <h2>Rupak Shah</h2>
                               <a class="info" href="#">I love options.</a>
                            </div>
                            <br><h5 class="person_title">Chief Option Delta hedger</h5>
                        </div>
                    </div>  
                    
                                         
            <div class="col-lg-3 col-md-3 col-sm-12    ">
                        <div class="hovereffect">
                            <img class="img_circle" src="people/nehal4.jpg" alt="" >
                            <div class="overlay">
                               <h2>Nehal Shah</h2>
                               <a class="info" href="#">I enjoy management.</a>
                            </div>
                            <br><h5 class="person_title">Delta Hedging Division Head</h5>
                        </div>
                       </div>   
               
                         <div class="col-lg-3 col-md-3 col-sm-12 ">
                        <div class="hovereffect">
                            <img class="img_circle" src="people/Samir.JPG" alt="">
                            <div class="overlay">
                               <h2>Samir Vahora</h2>
                               <a class="info" href="#">I appreciate perfection.</a>
                            </div>
                            <br>   <h5 class="person_title">Advisor</h5>
                        </div>
                         </div>
           
            </div> 
             <div class='col-lg-3 col-md-3 col-sm-12 col-md-offset-4 text-center '> 
                    <a  href="#node_people"><img src="images/bliss_down.png" height="70" width="70"></a>
                        <a href="#top"><img  src="images/bliss_up.jpg" height="70" width="70"></a><br>
            </div>
             </div> 
             <div id="node_people" class="hovereffect team" >
                    <div id="demo2" class="scroll-img">
                        <ul>
                           <li><img class="img_team" src="people/bt14.jpg"  ></li>
                          <li><img class="img_team" src="people/bt14.jpg"  ></li>
                  
                        </ul>

                    </div>
                    <div class="overlay">
                          <h2>BlissQuants Team</h2>
                           <a class="info" href="#">Delta Hedgers & Data Analysts</a>
                    </div>
             </div>
       
    </div>
      
   </body>
</html>
<?php
include("html/footer.html");
?>