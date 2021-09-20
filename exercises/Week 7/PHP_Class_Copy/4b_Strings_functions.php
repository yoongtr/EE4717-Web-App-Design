<!DOCTYPE html>
<html>
<body>

<?php
echo strlen("Hello world!")."<br>"; // outputs 12

echo str_word_count("Hello world!")."<br>";  // outputs 2

echo strrev("Hello world!")."<br>";   // outputs !dlrow olleH

echo strpos("Hello world!", "world")."<br>";   // outputs 6

echo str_replace("world", "Dolly", "Hello world!"); // outputs Hello Dolly!


?> 
 
</body>
</html>