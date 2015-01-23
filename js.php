<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sorting Your MySQL Results Set In PHP Using jQuery (And A More Traditional Approach) Example 2: jQuery-Powered Sorting</title>
        <link href="../demo.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="jquery-1.3.1.min.js"></script>
        <script type="text/javascript" src="jquery.tablesorter.min.js"></script>
        <script type="text/javascript">
			$(document).ready(function() {
				$("#sortedtable").tablesorter({ sortlist: [0,0] });
			});
		</script>
        <style type="text/css">
			#sortedtable thead th {
				color: #00f;
				font-weight: bold;
				text-decoration: underline;
			}
		</style>
    </head>
    <body>
    	<h1>
        	Sorting Your MySQL Results Set In PHP Using jQuery (And A More Traditional Approach))<br />
            Example 2: jQuery-Powered Sorting
        </h1>
        
        <?php
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
			
			if(!$link = mysql_connect("server", "user", "password")) {
				echo "Cannot connect to db server";
			}
			elseif(!mysql_select_db("database")) {
				echo "Cannot select database";
			}
			else {
				if(!$rs = mysql_query("SELECT * FROM table ORDER BY person_id")) {
					echo "Cannot parse query";
				}
				elseif(mysql_num_rows($rs) == 0) {
					echo "No records found";
				}
				else {
					echo "<table id=\"sortedtable\" class=\"bordered\" cellspacing=\"0\">\n";
					echo "<thead>\n<tr>";
					echo "<th>Record ID</th>";
					echo "<th>First Name</th>";
					echo "<th>Last Name</th>";
					echo "<th>Birthday</th>";
					echo "<th>Department</th>";
					echo "</tr>\n</thead>\n";
					while($row = mysql_fetch_array($rs)) {
						echo "<tr><td>$row[person_id]</td><td>$row[person_name]</td><td>$row[person_surname]</td><td>$row[person_birthdate]</td><td>$row[person_department]</td></tr>\n";
					}
					echo "</table><br />\n";
				}
			}
        ?>
        <p><a href="index.php">Example 1: Traditional PHP Sorting</a></p>
        <p><a href="http://www.dougv.com/blog/2009/06/13/sorting-your-mysql-results-set-in-php-using-jquery-and-a-more-traditional-approach">Sorting Your Results Set In PHP / MySQL Using jQuery (And A More Traditional Approach)</a></p>
    </body>
</html>
