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

$db;

function db_init()
{
  global $db;
  
  $db = mysql_connect('localhost','DBUSER','DBPASSWORD') or die (mysql_error($db));

  mysql_select_db('DBNAME') || die (mysql_error());
  $db;

}

function db_close()
{
  global $db;

  if($db){
    mysql_close($db);
  }
}

/**
 * Returns mysql_results from the given query or null if an empty set 
 * is returned
 */
function db_query($query)
{
  $tmpresults = mysql_query($query) or die ("Error:" . mysql_error());
  return $tmpresults;
}

/**
 * returns a boolean as to whether $value is in the $name column of $table
 */
function db_contains($value,$name,$table)
{
  $numberOf = db_query("select * from " . $table ." where " . $name . " = '" . $value . "'");
  
  mysql_num_rows($numberOf) != 0;
}

/**
 * Creates a drop box with the given query results.
 * if ableToAdd is true, then there is an option (first) to add a new value.
 * The two fields required in the sql query are ID and showMe.
 */
function addDropBox($sqlquery, $name, $ableToAdd = false)
{
  
  $returnMe = '<select name="' . $name . '" onchange="refreshBox(\'' . $name . '\');return true">' . "\n";

  $returnMe .= '<option value="">----</option>' . "\n";
  
  if($ableToAdd)
    {
      $returnMe .= '<option value="add">Create New</option>' . "\n";
    }
  while($junx = mysql_fetch_object($sqlquery))
    {
      $returnMe .= '<option value="' . $junx->ID . '">' . $junx->showMe . '</option>' . "\n";
    }
  return $returnMe . '</select>' . "\n";
}

function addRow($left, $right = null)
{
  $returnMe = '<tr>' . "\n";
  $returnMe .=  '<td>' . $left . '</td>' . "\n";
  if($right != null)
    {
      $returnMe .= '<td>' . $right . ' </td>' . "\n";
    }
  return $returnMe . '</tr>' . "\n";
}


function showNews($id)
{

	$query = db_query("select * from news where id = " . $id);
	if(mysql_num_rows($query) == 0){echo "That is not a valid news item.";exit();}
	$newsItem = mysql_fetch_object($query);


	echo '<p class="newItem">';
  	echo '<b>';
	if($newsItem->linkURL != ""){echo "<a href=\"" . $newsItem->linkURL . "\">";}
	echo $newsItem->title;
	if($newsItem->linkURL != ""){echo "</a>";}
	echo '</b>' . "\n";
  

  echo '<br id="message">' . $newsItem->message . "\n";

  echo "<br>\n";

 echo "<i id=\"lastUpdate\">Posted";

	if($newsItem->author != null && $newsItem->author != ""){
		
	  echo " by " . getFullName($newsItem->author);
	}
	
  echo	" on " . date("F d, Y g:i a", $newsItem->lastUpdate) . "</i>\n";
 
  
}

function get_int($intString)
{
	if(!isset($_GET[$intString])){die ( "Error: $intString is not a valid variable.");}

	$inty = $_GET[$intString];

	if(!is_numeric($inty)){die ("Error: Int needed, but not supplied. Was given ");}

	return (int) $inty;

}

/**
 * To connect a user to posts, complete this function to return a user name based on the user id.
 */
function getFullName($nameID)
{
   return "";

}

?>
