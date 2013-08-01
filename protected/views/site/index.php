<style>
.sched-box img {
  margin:0 30px;
}
.rate-box img {
  margin:0 10px;
  height:410px;
}
</style>
<div style="background:#f68937;margin-top:-20px;padding:50px 0;">
  <div class="container" >
    <div class="pull-right ">
	  <h1 class="arcName">FastCat</h1>
	  <h3 style="color:white;text-shadow:0 0px 0px #111">FerrySafe. FerryFast. FerryConvenient.</h3>
	</div>
	<div class="homeHero">
	</div>
	
  </div>

</div>

  <div class="container" style="background:#fff;margin-top:-50px;min-height:300px;border:0px solid #f68937;border-top:none;box-shadow: 0px 3px 5px #888888;">
    <div class="sched-box">
      <h2>Schedules</h2>
      <?php
        echo CHtml::image(Yii::app()->theme->baseUrl."/img/archipelago-M1-Schedule.jpg");
      ?>
    </div>
    <div class="rate-box">
      <h2>Passenger Rates</h2>
      <?php
        echo CHtml::image(Yii::app()->theme->baseUrl."/img/archipelago-rate-passenger-small.jpg");
        echo CHtml::image(Yii::app()->theme->baseUrl."/img/archipelago-rate-cargo-small.jpg");
      ?>
    
    </div>
  
  </div>
