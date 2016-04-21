<?php
class Query
{	
	var $connection;
	function __construct()
	{
		include('connectionHandler.php');
		$this->connection=new dbConnection();
	}
#############################--Insert Query Starts--#######################################
	function dbInsert($table,$sqlQuery)
	{
		$fields	=	array_keys($sqlQuery);
		$values	=	array_values($sqlQuery);
		//print_r($sqlQuery);
		//print_r($table);
		$this->connection->connect();
		if(!$this->connection)
		{
			echo "Data Base Not Connected";
			exit;
		}
	else
	{
		//$sqlInsert;
		$sqlInsert="INSERT INTO ".$table." (";
		$sqlInsert.=	implode(", ",$fields).") ";
		$sqlInsert.=	"VALUES( '";
		$sqlInsert.=	implode("','",$values);
		$sqlInsert.="')";
		//echo $this->sqlInsert;
		mysql_query($sqlInsert) or die(mysql_error());
		return mysql_insert_id();
		$this->connection->close();
	}
	}
	#############################--Insert Query Ends--#########################################
	#############################--Update Query Starts--#######################################
	function dbUpdate($table, $arFieldsValues, $strCondition='')
	{
	$this->connection->connect();
	if(!$this->connection)
	{
		echo "Data Base Not Connected";
		exit;
	}
	else
	{	
		$formatedValues	=	array();
		foreach($arFieldsValues as $key => $val)
		{
			if(!is_numeric($val))
			{
			if(strcmp($val,"NOW()") == 0)
				$val	=	$val;
			else
			$val	=	"'".addslashes($val)."'";
			}
			$formatedValues[]	=	"$key = $val";
		}
		$sqlUpdate	=	"UPDATE ".$table." SET ";
		$sqlUpdate	.=	implode(",",$formatedValues);
	if($strCondition != "") 
		{
			$sqlUpdate	.=	" WHERE ".$strCondition;
		}
		//echo $sqlUpdate;
		mysql_query($sqlUpdate) or die(mysql_error());
		return mysql_affected_rows();
		$this->connection->close();
	}
	}
	#############################--Select Query Starts--#######################################
	function dbSelect($Query)
	{
		$this->connection->connect();
	if(!$this->connection)
	{
		echo "Data Base Not Connected";
		exit;
	}
	else
	{
		$retResultSelect	=	array();
		$rs	=	mysql_query($Query) or die("MySQL Error Happend : " .mysql_error());
		while( ($row	=	mysql_fetch_assoc($rs)))
		{
			$retResultSelect[]	=	$row;
		}
		return $retResultSelect;
		}
	}
	#############################--Select Query Ends--#########################################
	#############################--Count Query Starts--########################################
	function countRow($strQuery)
	{
		$this->connection->connect();
	if(!$this->connection)
	{
		echo "Data Base Not Connected";
		exit;
	}
	else
	{
		$rs	=	mysql_query($strQuery) or die("MySQL Error Happend : " .mysql_error());
		if(!is_resource($rs))
		{
		}
		return mysql_num_rows($rs);
		//print_r($rs);
	}
	}
	#############################--Count Query Ends--##########################################
	#############################--Pager Start--###############################################
	function getPager($countAll ,$currentPage)
	{
		$prevPage =1;
		$nextPage = 1;
		$perPage = 20;
		$pageCount = (int)($countAll / $perPage) ;
		$pageRem = (int)($countAll % $perPage) ;
	if($pageRem > 0)
	{
		$pageCount=$pageCount+1;
	}
		$firstPage = 1;
		$lastPage = $pageCount;
	if($currentPage > 1)
	{
		$prevPage = $currentPage-1;
	}
	if($currentPage == $pageCount)
	{
		$nextPage = $currentPage;
	}
	else if($currentPage < $pageCount)
	{
		$nextPage = $currentPage+1;
	}
		$limit = (int)(($currentPage-1)*$perPage);
		return array('limit'=> $limit,'perPage'=> $perPage,'prevPage'=> $prevPage,
		'currentPage'=>$currentPage ,'nextPage'=>$nextPage,'firstPage'=>$firstPage,'lastPage'=>$lastPage );
	
	}
	#############################--Pager Ends--##################################################
	#############################--Cart--------------############################################
	function cart($countAll ,$currentPage)
	{
		$prevPage =1;
		$nextPage = 1;
		$perPage = 5;
		$pageCount = (int)($countAll / $perPage) ;
		$pageRem = (int)($countAll % $perPage) ;
	if($pageRem > 0)
	{
		$pageCount=$pageCount+1;
	}
		$firstPage = 1;
		$lastPage = $pageCount;
	if($currentPage > 1)
	{
		$prevPage = $currentPage-1;
	}
	if($currentPage == $pageCount)
	{
		$nextPage = $currentPage;
	}
	else if($currentPage < $pageCount)
	{
		$nextPage = $currentPage+1;
	}
		$limit = (int)(($currentPage-1)*$perPage);
		return array('limit'=> $limit,'perPage'=> $perPage,'prevPage'=> $prevPage,'currentPage'=>$currentPage ,
		'nextPage'=>$nextPage,'firstPage'=>$firstPage,'lastPage'=>				$lastPage );
	
	}
	##################################---C-art Ends----###########################################
	function getPager1($countAll ,$currentPage)
	{
		$prevPage =1;
		$nextPage = 1;
		$perPage = 1;
		$pageCount = (int)($countAll / $perPage) ;
		$pageRem = (int)($countAll % $perPage) ;
	if($pageRem > 0)
	{
		$pageCount=$pageCount+1;
	}
		$firstPage = 1;
		$lastPage = $pageCount;
	if($currentPage > 1)
	{
		$prevPage = $currentPage-1;
	}
	if($currentPage == $pageCount)
	{
		$nextPage = $currentPage;
	}
	else if($currentPage < $pageCount)
	{
		$nextPage = $currentPage+1;
	}
		$limit = (int)(($currentPage-1)*$perPage);
		return array('limit'=> $limit,'perPage'=> $perPage,'prevPage'=> $prevPage,'currentPage'=>$currentPage ,
		'nextPage'=>$nextPage,'firstPage'=>$firstPage,'lastPage'=>				$lastPage );
	
	}
	function dbDelete($Query)
	{
		$this->connection->connect();
		if(!$this->connection)
		{
			echo "Data Base Not Connected";
			exit;
		}
		else
		{
			$rs = mysql_query($Query) or die("MySQL Error Happend : " .mysql_error());
			return $rs;
		}
	}
}
?>
