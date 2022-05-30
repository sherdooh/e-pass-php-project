  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <a class="navbar-brand logo_h" href="index.php">

                      <div class="logo">
                        <img src="img/cepms.PNG" alt="CePM" width="250" height="80" style="border-radius: 30px; margin-left: 0px;">
                    </div>

            <!-- <h1 style="color:#fff">CePMS</h1> -->
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li> 
            </ul>

            <div class="nav-right text-center text-lg-right py-4 py-lg-0">
              <a class="button button-outline button-small" href="admin/">Admin Login</a>
            </div>


            <div class="nav-right text-center text-lg-right py-4 py-lg-0">
              <li>
             <div class="button button-outline button-small">
        
            <form name="clock">
            <input style="width:150px;" type="submit" class="trans" name="face" value="">
            </form>
              </div>
            </li>
              
            </div>
            
            <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</script>
            

          </div> 
        </div>
      </nav>
    </div>
  </header>