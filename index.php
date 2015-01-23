<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<!--
    	Sorting Your MySQL Results Set In PHP Using jQuery (And A More Traditional Approach)
        Copyright (C) 2009 Doug Vanderweide
        
        This program is free software: you can redistribute it and/or modify
        it under the terms of the GNU General Public License as published by
        the Free Software Foundation, either version 3 of the License, or
        (at your option) any later version.
        
        This program is distributed in the hope that it will be useful,
        but WITHOUT ANY WARRANTY; without even the implied warranty of
        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
        GNU General Public License for more details.
        
        You should have received a copy of the GNU General Public License
        along with this program.  If not, see <http://www.gnu.org/licenses/>.
    -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sorting Your MySQL Results Set In PHP Using jQuery (And A More Traditional Approach) Example 1: Traditional PHP Sorting</title>
        <link href="../demo.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    	<h1>
        	Sorting Your MySQL Results Set In PHP Using jQuery (And A More Traditional Approach)<br />
            Example 1: Traditional PHP Sorting
        </h1>
		<?php
		function makeHeaderLink($value, $key, $col, $dir) {
			$out = "<a href=\"" . $_SERVER['SCRIPT_NAME'] . "?c=";
			//set column query string value
			switch($key) {
				case "person_name":
					$out .= "1";
					break;
				case "person_surname":
					$out .= "2";
					break;
				case "person_birthdate":
					$out .= "3";
					break;
				case "person_department":
					$out .= "4";
					break;
				default:
					$out .= "0";
			}
			
			$out .= "&d=";
		
			//reverse sort if the current column is clicked
			if($key == $col) {
				switch($dir) {
					case "ASC":
						$out .= "1";
						break;
					default:
						$out .= "0";
				}
			}
			else {
				//pass on current sort direction
				switch($dir) {
					case "ASC":
						$out .= "0";
						break;
					default:
						$out .= "1";
				}
			}
			
			//complete link
			$out .= "\">$value</a>";
			
			return $out;
		}
        
		switch($_GET['c']) {
			case "1":
				$col = "person_name";
				break;
			case "2":
				$col = "person_surname";
				break;
			case "3":
				$col = "person_birthdate";
				break;
			case "4":
				$col = "person_department";
				break;
			default:
				$col = "person_id";
		}
		
		if($_GET['d'] == "1") {
			$dir = "DESC";
		}
		else {
			$dir = "ASC";
		}
        
        if(!$link = mysql_connect("server", "username", "password")) {
            echo "Cannot connect to db server";
        }
        elseif(!mysql_select_db("database")) {
            echo "Cannot select database";
        }
        else {
            if(!$rs = mysql_query("SELECT * FROM table ORDER BY $col $dir")) {
                echo "Cannot parse query";
            }
            elseif(mysql_num_rows($rs) == 0) {
                echo "No records found";
            }
            else {
                echo "<table class=\"bordered\" cellspacing=\"0\">\n";
                echo "<tr>";
				echo "<th>" . makeHeaderLink("Record ID", "person_id", $col, $dir) . "</th>";
                echo "<th>" . makeHeaderLink("First Name", "person_name", $col, $dir) . "</th>";
                echo "<th>" . makeHeaderLink("Last Name", "person_surname", $col, $dir) . "</th>";
                echo "<th>" . makeHeaderLink("Birthday", "person_birthdate", $col, $dir) . "</th>";
                echo "<th>" . makeHeaderLink("Department", "person_department", $col, $dir) . "</th>";
                echo "</tr>\n";
                while($row = mysql_fetch_array($rs)) {
                    echo "<tr><td>$row[person_id]</td><td>$row[person_name]</td><td>$row[person_surname]</td><td>$row[person_birthdate]</td><td>$row[person_department]</td></tr>\n";
                }
                echo "</table><br />\n";
            }
        }
        ?>
        <p><a href="js.php">Example 2: jQuery-Powered Sorting</a></p>
        <p><a href="http://www.dougv.com/blog/2009/06/13/sorting-your-mysql-results-set-in-php-using-jquery-and-a-more-traditional-approach">Sorting Your Results Set In PHP / MySQL Using jQuery (And A More Traditional Approach)</a></p>
    </body>
</html>
