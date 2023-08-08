<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Programming :: Lab 2" />
<meta name="keywords" content="Web,programming" />
<meta name="Nghia" content="103806269">
</head>
<body>
    <?php
        function is_leapyear ($is_year) {
            $result = false;
            if ($is_year % 400 == 0)
            {
                $result = true;
            }
            else if ($is_year % 100 == 0)
            {
                $result = false;
            }
            else if ($is_year % 4 == 0)
            {
                $result = true;
            }
            else
            {
                $result = false;
            }
            return $result;
        }
    ?> 
</body>
</html>


