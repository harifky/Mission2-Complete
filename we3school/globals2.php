$x = 75;
  
function myfunction() {
  global $x;
  echo $x;
}

myfunction()