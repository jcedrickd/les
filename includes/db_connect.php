<?php
class db_connect {
// PostgreSql connection
protected $pg_server		= '192.168.2.52';
protected $pg_dbusername	= 'postgres';
protected $pg_dbpass		= 'javasr';

// Sybase connection
protected $server		= 'AAIASE';
protected $dbusername	= 'cris';
protected $dbpass		= 'aaigoc';

// mysqli connection
protected $mysqli_server		= 'localhost';
protected $mysqli_dbusername	= 'root';
protected $mysqli_dbpass		= '123456';

public $tablefields;
public	$dbtype;
public $link;
public $num_rows;
public $countQuery;
public $total_records;
public $perpage;
public $current_page;
public $itemlist;
public function __construct($dbname="dbcentral",$dbtypeval="sybase"){

	if ($dbtypeval == 'sybase')
	{
		@$this->link	= sybase_connect($this->server,$this->dbusername,$this->dbpass);
		@$db	= sybase_select_db($dbname);
		
	}
	elseif ($dbtypeval == 'pg')
	{
		$this->link		= pg_connect("host=$this->pg_server dbname=$dbname user=$this->pg_dbusername password=$this->pg_dbpass");
	}
	elseif ($dbtypeval == 'mysqli')
	{
		$this->link		= mysqli_connect($this->mysqli_server,$this->mysqli_dbusername,$this->mysqli_dbpass,$dbname);
	}
	else
		die("Invalid database type!");
		
$this->dbtype	= $dbtypeval;
}

public function __destruct(){
	if ($this->dbtype == 'sybase')
		sybase_close($this->link);
	elseif ($this->dbtype == 'pg')
		pg_close($this->link);
	elseif ($this->dbtype == 'mysqli')
		$this->link->close();
	
}

public function dbquery($query){
$dbquery	= $this->dbtype."_query";
	if ($this->dbtype == 'sybase')
				$tablequery	= $dbquery($query);
	else
		{
				$tablequery	= $dbquery($this->link,$query);
		}

	return $tablequery;

}

public function num_rows($result){
return count($result);
}

public function get_records_sql($sql){
	$query		= $this->dbquery($sql);
	$fieldsx	= array();
	$dbfetch	= $this->dbtype."_fetch_array";
	$dbfetchfield	= $this->dbtype."_fetch_field";
	if ($this->dbtype == 'pg')
	{
		$i = pg_num_fields($query);
		for ($j=0; $j < $i ; $j++)
		{
		$dbfetchfield	= $this->dbtype."_field_name";
		$fieldsx[]		= $dbfetchfield($query,$j);
		}
	}
	else
	{
	while($info	= $dbfetchfield($query))
		$fieldsx[]	= $info->name;
	}
	$result		= array();
	while ($row = $dbfetch($query))
	{		
		$resultVal		= new stdClass();
		foreach ($fieldsx as $dbfields)
		{
			$resultVal->$dbfields	= $row[$dbfields];
		}
		$result[]	= $resultVal;
	}
	return $result;	
}


public function set_limit($pg = 1){

	$pg	= ($pg == 0) ? 1 : $pg;
	if (empty($this->perpage))
		return "";
		
	if ($this->dbtype == "sybase")
	{
		$items	= $this->perpage * $pg;
		$this->itemlist	=	$this->perpage * ($pg - 1);
			return "TOP $items";
	}
	
	return "";

}

public function pages()
{
	$dbfetch	= $this->dbtype."_fetch_array";
	$countAll	= $this->dbquery($this->countQuery);
	while($row	= $dbfetch($countAll))
		$all		= $row['computed']; // all records
	
	$perpage	= !empty($this->perpage) ? $this->perpage : 1; // per page display
	$this->total_records = $all;
	if ($perpage > $all)
		return 1;
	else
	{
		$pages	= $all / $perpage;
		if ($all % $perpage != 0) {
					$pages	= intval($pages) + 1;
		}
	}
	$count	= 0;
	$test	= "";
	
	$link	= 3;
	$currentpage	= "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$first	= "First";
	$last	= "Last";
	$back	= $this->current_page -1;
	$next	= $this->current_page + 1;
	if ($this->current_page == 1)
		$test	.= "<span class='staticpage'>$first</span>";
	else
	{
		
		$test	.= "<a href='$currentpage?pg=1' class='pagipage'>$first</a>";
		$test	.= "<a href='$currentpage?pg=$back' class='pagipage'><<</a>";
	}
	
	while ($count < ($pages))
	{
		$current	= "";
		$count++;
		if ($this->current_page == $count)
			$current	= "currentpage";
		
		$test	.= "<a class='".$current." pagipage' href='$currentpage?pg=$count'>$count</a>";
	}
	
	if ($this->current_page == $pages)
		$test	.= "<span class='staticpage'>$last</span>";
	else
	{
		$test	.= "<a href='$currentpage?pg=$next' class='pagipage'>>></a>";
		$test	.= "<a href='$currentpage?pg=$pages' class='pagipage'>$last</a>";
	}	
	return $test;
}


public function get_records($table,$fields = '*',$condition = NULL, $tablejoin = NULL){
	$dbfetchfield	= $this->dbtype."_fetch_field";
	$dbfetch	= $this->dbtype."_fetch_array";
	$limit		= $this->set_limit($this->current_page);
	if ($fields == '*' OR empty($fields))
	{
		$dbquery_column	= "SELECT * FROM $table";
		$tablequery = $this->dbquery($dbquery_column);

		$allfields	= array();
		
		if ($this->dbtype == 'pg')
		{
			$i = pg_num_fields($tablequery);
			for ($j=0; $j < $i ; $j++)
			{
			$dbfetchfield	= $this->dbtype."_field_name";
			$allfields[]		= $dbfetchfield($tablequery,$j);
			}
		}
		else
		{
		while ($rowtable = $dbfetchfield($tablequery))
		{
		$allfields[]	= $rowtable->name;
		}
		}
		$fields	= $allfields;
	}
	//$this->tablefields	= $fields;
	
		$field = implode(',',$fields);

	$condition	= !empty($condition) ? "WHERE 1=1 AND $condition" : "";
	
	$dbresult	= "SELECT $limit $field FROM $table $tablejoin $condition";
	
	$query	= $this->dbquery($dbresult);
	
	$this->countQuery	= "SELECT COUNT(*) FROM $table $tablejoin $condition";
	
	$fieldsx	= array();
	
	if ($this->dbtype == 'pg')
		{
			$i = pg_num_fields($query);
			for ($j=0; $j < $i ; $j++)
			{
			$dbfetchfield	= $this->dbtype."_field_name";
			$fieldsx[]		= $dbfetchfield($query,$j);
			}
		}
	else
	{
	while($info	= $dbfetchfield($query))
	{
	$fieldsx[]	= $info->name;
	}
	}
	
	$this->tablefields	= $fieldsx;
	$result		= array();
	$test	= $this->itemlist;
	$count	= 0;
	while ($row = $dbfetch($query))
	{
		if ($count < $test)
		{
			$count++;
		}
		else
		{
			$resultVal		= new stdClass();
				foreach ($fieldsx as $dbfields)
					$resultVal->$dbfields	= $row[$dbfields];

				$result[]	= $resultVal;
		}
	}
		
	return $result;
	
}

public function check_datatype($table,$field,$value){

$query			= $this->dbquery("SELECT $field FROM $table");
$dbfetchfield	= $this->dbtype."_fetch_field";
	if ($this->dbtype == 'pg')
	{
		$info = new stdClass();
		$i = pg_num_fields($query);
		for ($j=0; $j < $i ; $j++)
		{
		$dbfetchfield	= $this->dbtype."_field_type";
		$info->numeric		= $dbfetchfield($query,$j);
		}
	}
	elseif ($this->dbtype == 'mysqli')
	{
		if ($this->dbtype == 'mysqli')
			$fieldtype	= "charsetnr";
			
			$info		= $dbfetchfield($query);
			
			if ($info->charsetnr == 8)
				return "'$value'";
			else
			{
				$value	= empty($value) ? 0 : $value;
				return $value;
			}
	}
	else
	{
	$info	= $dbfetchfield($query);
	}
	
	if ($info->numeric == 0 OR $info->numeric == 'varchar' OR $info->numeric == 'char'  OR $info->numeric == 'text')
		return "'$value'";
	else
	{
		$value	= empty($value) ? 0 : $value;
		return $value;
	}
}

public function insert_record($table,$fields,$fieldreturn = NULL, $multiple = FALSE){
$dbfetch	= $this->dbtype."_fetch_array";
	if ($multiple == FALSE)
	{
	$getfields	=	array();
	$getvalue	=	array();
	foreach($fields as $fieldindex => $fieldval)
	{
		if (!empty($fieldval))
		{
		$getfields[]	= $fieldindex;
		$getvalue[]		= $this->check_datatype($table,$fieldindex,$fieldval);
		}
	}
	
	
	$fieldlist	= implode(',',$getfields);
	$fieldvalue	= "(".implode(',',$getvalue).")";
	
	
	}
	else
	{
		$finalVal	= array();
		foreach($fields as $fieldObj)
			{
				$getfields		= array();
				$getval			= array();
				$sampleVal		= array();
				
				foreach ($fieldObj as $fieldIndex => $fieldval)
				{
					
					if (!empty($fieldval))
					{
						$getfields[]	= $fieldIndex;
						$getval[]		= $this->check_datatype($table,$fieldIndex,$fieldval);
					}	
				}
				
				$stringVal	= implode(',',$getval);
				
				$finalVal[]		= "($stringVal)";
			}
		$fieldlist	= implode(',',$getfields);
		$fieldvalue	= implode(',',$finalVal);
		
	}
	if ($query	= $this->dbquery("INSERT INTO $table ($fieldlist) VALUES $fieldvalue"))
		return true;
	else
		return false;
	
	return false;
}

public function update_record($table, $data, $condition = NULL){
	$getvalue	=	array();
	foreach($data as $dataindex => $dataval)
	{
		$value		= $this->check_datatype($table,$dataindex,$dataval);
		$getvalue[]	= "$dataindex = $value";
	}

	$newVal	= implode(',',$getvalue);

	$condition	= !empty($condition) ? "WHERE $condition" : "";
	$query		= "UPDATE $table SET $newVal $condition";
	if ($query	= $this->dbquery($query))
		return true;
	else
		return false;
}

public function delete_record($table, $condition){
	
	if ($query	= $this->dbquery("DELETE FROM $table WHERE $condition"))
		return true;
	else
		return false;
}

}

// $sybase	= new db_connect('boss'); // initiate class

// get_records Function
// param $table - name of table
// param $fields - array list of fields
// param $condition - condition of the query e.g 'id = 1' 
// param $tablejoin - table join e.g. 'LEFT JOIN table2 ON table1.field=table2.field'
// return object of the result
//get_records($table,$fields,$condition,$tablejoin);

// insert_record Function
// param $table - name of table
// param $dataObject - object type of data to be inserted
// return true
//$dataObject	= new stdClass();
//$dataObject->field1	= "value1";
//$dataObject->field2	= "value2";
//insert_record($table,$dataObject);


// update_record Function
// param $table - name of table
// param $dataObject - object type of data to be updated
// param $condition - condition of the query e.g 'id = 1'
// update_record($table, $data, $condition = NULL) 
// return true

// delete_record Function
// param $table - name of table
// param $condition - condition of the query e.g 'id = 1' 
// return true
//	delete_record($table, $condition);

//$sybase->num_rows; //to get the number of results

//$result	= $sybase->get_records('department');

?>
