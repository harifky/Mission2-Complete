function myfunction() {
  $GLOBALS["x"] = 100;
}

myfunction();

echo $GLOBALS["x"];
echo $x;