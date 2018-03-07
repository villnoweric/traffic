<style>
    html{
  background: linear-gradient(#08f, #fff);
  padding: 40px;
  width: 170px;
  height: 100%;
  margin: 0 auto;
}

.trafficlight{
  background: #222;
  background-image: linear-gradient(transparent 2%, #111 2%, transparent 3%, #111 30%);
  width: 170px;
  height: 400px;
  border-radius: 20px;
  position: relative;
  border: solid 5px #333;
}

.trafficlight:before{
  background: #222;
  background-image: radial-gradient(#444, #000);
  content: "";
  width: 170px;
  height: 150px;
  margin: 0 auto;
  position: absolute;
  top: -20px;
  margin-left: 0px;
  border-radius: 50%;
  z-index: -1;
}

.trafficlight:after{
  background: #222;
  background-image: linear-gradient(-90deg, #222 0%, #444 30%, #000);
  content: "";
  width: 50px;
  height: 500px;
  margin-left: 60px;
  position: absolute;
  top: 150px;
  z-index: -1;
}

.protector{
  background: transparent;
  width: 180px;
  height: 0;
  position: absolute;
  top: 20px;
  left: -35px;
  border-right: solid 30px transparent;
  border-left: solid 30px transparent;
  border-top: solid 90px #111;
  border-radius: 10px;
  z-index: -1;
}

.protector:nth-child(2){
  top: 140px;
}

.protector:nth-child(3){
  top: 260px;
}

.red{
  background: red;
  background-image: radial-gradient(brown, transparent);
  background-size: 5px 5px; 
  width: 100px;
  height: 100px;
  border-radius: 50%;
  position: absolute;
  top: 20px;
  left: 35px;
  animation: 13s red infinite;
  border: dotted 2px red;
  box-shadow: 
    0 0 20px #111 inset,
    0 0 10px red;
  opacity: .1;
}

.yellow{
  background: yellow;
  background-image: radial-gradient(orange, transparent);
  background-size: 5px 5px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: dotted 2px yellow;
  position: absolute;
  top: 145px;
  left: 35px;
  animation: 13s yellow infinite;
  box-shadow: 
    0 0 20px #111 inset,
    0 0 10px yellow;
  opacity: .1;
}

.green{
  background: green;
  background-image: radial-gradient(lime, transparent);
  background-size: 5px 5px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: dotted 2px lime;
  position: absolute;
  top: 270px;
  left: 35px;
  box-shadow: 
    0 0 20px #111 inset,
    0 0 10px lime;
  animation: 13s green infinite;
  opacity: .1;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    function setLight(value){
        $.get( "https://playground-villnoweric.c9users.io/traffic/index.php", { set : value} )
    }
    function myfunction(){
        jQuery.getJSON("https://playground-villnoweric.c9users.io/traffic/index.php",function( data ){
            if(data.mode=="pattern"){
                var duration = 0;
                for (var x = 0, ln = (data.pattern.length + 1); x < ln; x++) {
                    console.log(x);
                    if(x != data.pattern.length){
                        duration += data.pattern[x][1];
                        setTimeout(function(i){
                            console.log(i);
                                setLight(data.pattern[i][0]);
                        },duration - data.pattern[x][1], x);
                    }else{
                        setTimeout(function(){
                            myfunction();
                        },duration);
                    }
                    }
                }else{
                    setTimeout(function(){
                        myfunction();
                    }, 2000);
                }
        });
    }
    $(function(){myfunction()}
    );
</script>
<script>
    $(function() {
            jQuery.getJSON("https://playground-villnoweric.c9users.io/traffic/index.php",function( data ){
                setInterval(function(){jQuery.getJSON("https://playground-villnoweric.c9users.io/traffic/index.php",function( data ){
                    $(".red").css("opacity",(((9/10)*data.lights.red) + (1/10)));
                    $(".yellow").css("opacity",(((9/10)*data.lights.yellow) + (1/10)));
                    $(".green").css("opacity",(((9/10)*data.lights.green) + (1/10)));
                })}, 100);
            });
    });
</script>

<div class="trafficlight">
  <div class="protector"></div>
  <div class="protector"></div>
  <div class="protector"></div>
  <div class="red"></div>
  <div class="yellow"></div>
  <div class="green"></div>
</div>