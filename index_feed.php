<?php

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


if(isset($_GET['id']))
{

	$curr = get_int('id');	

	showNews($curr);

	exit();

}

$newsItems = db_query("select id from news order by id desc");

while($ids = mysql_fetch_object($newsItems))
{
	showNews($ids->id);
	echo '<br><br>';
}



db_close();

if(isset($outlook_url))
  {
    echo "<p><a href=\"$outlook_url\">Subscribe in Outlook</a></p>\n";
  }
if(isset($feed_url))
  {
    echo "<p><a href=\"$feed_url\">Feed URL<img src=\"$base_url/feed-icon-14x14.png\" alt=\"RSS Feed\" /></a></p>";
  }

?>
