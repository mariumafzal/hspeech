<?php
include 'database_connect.php';

class Source {
	public static function getContent($content_id) {
		$query = "select * from source where id='$content_id'";
		$result = mysql_query($query) or die("Could #getContent(id)# source from database ".mysql_error());
		return mysql_fetch_object($result);
	}

	public static function addSource($type, $reference, $content){
		$query = "insert into source values('','$type', '$reference', '$content', 'false')";
		$result = mysql_query($query) or die("Could not #addSource()# into the database ".mysql_error());
		return true;
	}

	public static function editSource($sourceId, $type, $sourceReference, $content) {
		$query = "update source set values('','$type', '$sourceReference', '$content') where id='$sourceId'";
		$result = mysql_query($query) or die("Could not #editSource()# into the database ".mysql_error());
		return true;
	}

	public static function setAsAnaylsed($sourceId) {
		$query = "update source set analysed='false' where id='$sourceId'";
		$result = mysql_query($query) or die("Could not #setAsAnaylsed()# into the database ".mysql_error());
		return true;
	}

	public static function removeSource($source_id) {
		$query = "delete from source where id='$sourceId'";
		$result = mysql_query($query) or die("Could not delete from Source in the database ".mysql_error());
		return true;
	}

	public static function getAllSourcesByType($type) {
		getAllSourcesByType($type, 'false');
	}

	public static function getAllSourcesByType($type, $isAnalysed) {
		if($type == "all") {
			if($isAnalysed == "false") {
				$query = "select * from source where analysed='false'";
			} else {
				$query = "select * from source where analysed='true'";
			}
		} else {
			if($isAnalysed == "false") {
				$query = "select * from source where type='".$type."' and analysed='false'";
			} else {
				$query = "select * from source where type='".$type."' and analysed='true'";
			}
		}
		$result = mysql_query($query) or die("Could not get all the sources".mysql_error());
		$allSources = array();
		while ($row = mysql_fetch_assoc($result)) {
		    array_push($allSources,array('id'  => $row['id'], 'type' => $row['type'], 'sourceReference' => $row['sourceReference'], 'content' => $row['content']));
		}
		return $allSources;
	}
}
?>