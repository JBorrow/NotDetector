<?php

echo "<form name = 'dategrab' method = 'POST'>\n";

echo "    <select name = 'day'>\n";


        for ($i = 1; $i <= 31; $i++) {
            $currentday = date('j');
            if ($i==$currentday) {
                $selected = " selected='selected'";
            } else {
                $selected = "";
            }

            echo "<option$selected value = '$i'>$i</option>\n";
        }


echo "    </select>\n";

echo "    <select name = 'month'>\n";

        
        $currentmonth = date("F");

        $months = array('January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December');

        foreach ($months as $month) {
            if ($month == $currentmonth) {
                $selected = " selected='selected'";
            } else {
                $selected = "";
            }
            echo "<option$selected value = '$month'>$month</option>\n";
        }


echo "    </select>\n";

echo "    <select name = 'year'>\n";


        $currentyear = date("Y");
        
        for ($i = 2000; $i <= $currentyear; $i++) {
            if ($i == $currentyear) {
                $selected = " selected='selected'";
            } else {
                $selected = "";
            }
            echo "<option$selected value = '$i'>$i</option>\n";
        }


echo "    </select>\n";

echo "</form>\n";
