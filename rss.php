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


require_once('./admin/talk_db.inc.php');

db_init();

$lastUpdate = "Thu, 20 Nov 2008 21:28:00 CST";

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";
echo    '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
echo 	"<channel>";
echo '	<atom:link href="http://hpcf.stjude.org/RSS/rss.php" rel="self" type="application/rss+xml" />' . "\n";
echo     "<title>St Jude HPCF News Feed</title>
    <link>http://hpcf.stjude.org/RSS/</link>
    <description>Updates from St Jude HPCF</description>
    <copyright>St Jude Children's Research Hospital</copyright>
    <lastBuildDate>" /*Fri, 25 Apr 2008 13:40:00 CST*/. $lastUpdate . "</lastBuildDate>
    <language>en-us</language>";

$sql = ("SELECT * from news");

$result = db_query($sql) or die(mysql_error());

$counter = 0;
while($junx = mysql_fetch_object($result))
  {
    echo '<item>' . "\n";
    echo '<title>' . $junx->title . '</title>' . "\n";
    echo '<link>http://hpcf.stjude.org/RSS/index.php?id=' . (int) $junx->id . '</link>' . "\n";
    echo '<guid isPermaLink="true">http://hpcf.stjude.org/RSS/index.php?id=' . (int) $junx->id . '</guid>' . "\n";
    echo '<description><![CDATA[';

    echo $junx->message . "<br>";

    echo ']]></description>' . "\n";
    echo '<pubDate>' . date("D, d M Y H:i:s",$junx->lastUpdate) . ' EST</pubDate>' . "\n";
    echo '</item>' . "\n";
    
  }

echo " </channel>
 </rss>";

db_close();

?>