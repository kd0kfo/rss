<html>
<head><title>RSS Feed Writer</title></head>
<body>

<?

  /**
   * RSS Feed
   *
   * Copyright 2009, 2010 David Coss, PhD
   *
   * RSS Feed is free software: you can redistribute it and/or modify 
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation, either version 3 of the License, or
   * (at your option) any later version.
   *
   * RSS feed is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   * 
   * You should have received a copy of the GNU General Public License
   * along with RSS feed in a file called COPYING.  If not, see 
   * <http://www.gnu.org/licenses/>.
   */



include('talk_db.inc.php');

if (isset($_POST['submited'])) {

  db_init();

$title = $_POST['title'];
$link = $_POST['link'];
$description = $_POST['description'];

$sql = ("INSERT INTO news (title, message, linkURL, lastUpdate) VALUES ('$title', '$description', '$link', UNIX_TIMESTAMP())");
$result = mysql_query($sql) or die("Insertion error: " . mysql_error());



}
 
echo "<form action=\"edit.php\" method=\"post\">
 <table border=1 align=center>
  <tr>
   <td>Title:</td>
   <td><input type=\"text\" name=\"title\" size=\"55\" maxlength=\"256\"></td>
  </tr>
  <tr>
   <td>URL:</td>
   <td><input type=\"text\" name=\"link\" size=\"55\" maxlength=\"256\"></td>
  </tr>
  <tr>
   <td>Comment:</td>
   <td><textarea name=\"description\" cols=\"55\" rows=\"4\"></textarea></td>
  </tr>
  <tr>
   <td><input type=\"submit\" name=\"Submit\" value=\"Add Post\"><input type=\"hidden\" name=\"submited\" value=\"1\"></td>
  </tr>
 </table>
</form>";
?>

<p><a href="../index.php">Back</a></p>
</body>
</html>
