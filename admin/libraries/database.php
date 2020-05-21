<?php 
	
	class database
	{

		public $connect;

		public function __construct()
		{
			$this->connect=mysqli_connect('localhost','root','','do_an_tot_nghiep') or die('connect fail');
			
			// $this->connect=mysqli_connect('sql308.byethost22.com','b22_24712289','vanbac92','b22_24712289_kmt') or die('connect fail');

			mysqli_set_charset($this->connect,'utf8');
		}

		public function fetchSql($sql){

			$result = mysqli_query($this->connect,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->connect));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
		}
		public function fetchSql_no_array($sql){

			$result = mysqli_query($this->connect,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->connect));
            
            return $result;
		}

		public function fetchAll($table)
		{
			$sql = "SELECT * FROM $table";
			$query = mysqli_query($this->connect,$sql);

			$result=[];
			if($query){

				while($row = mysqli_fetch_assoc($query)){
					$result[]=$row;
				}

			}
			return $result;
		}

		public function fetchAll_condition($table,$condition)
		{
			$sql = "SELECT * FROM $table WHERE ";
			$sql .=$condition;
			$query = mysqli_query($this->connect,$sql);
			$result=[];
			if($query){

				while($row = mysqli_fetch_assoc($query)){
					$result[]=$row;
				}

			}
			return $result;
		}

		public function fetchID($table,$id)
		{
			$sql = "SELECT * FROM $table WHERE id = $id AND deleted_at = 0 ";
			$query = mysqli_query($this->connect,$sql) or die('query error');
			return mysqli_fetch_assoc($query);
		}
		public function fetchOne($table,$query)
		{
			$sql = "SELECT * FROM {$table} WHERE ";
			$sql.= $query;
			$sql.= "LIMIT 1";
			$result = mysqli_query($this->connect,$sql) or die('query fail');
			return mysqli_fetch_assoc($result);
		}

		 public function countTable($table)
        {
            $sql = "SELECT id FROM  {$table} WHERE deleted_at=0";
            $result = mysqli_query($this->connect, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->connect));
            $num = mysqli_num_rows($result);
            return $num;
        }

		public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false ) // for product
        {
            //$row : số bản ghi hiển thị, $p: get ?page tren url
            $data = [];
            if ($pagi == true )
            {
                $total = $this->countTable($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->connect,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->connect));
            }
            else
            {
                $result = mysqli_query($this->connect,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->connect));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public  function fetchJones($table,$sql,$total=0 ,$page = 0,$row ,$pagi = false ) // for product
        {
            //$row : số bản ghi hiển thị, $p: get ?page tren url
            $data = [];
            if ($pagi == true )
            {
                
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->connect,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->connect));
            }
            else
            {
                $result = mysqli_query($this->connect,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->connect));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

		//insert
		public function createSQL($data)
		{
			$field_list = $value_list = '';
			foreach($data as $key=>$value)
			{
				$field_list .=",$key";
				$value_list .=", '".mysqli_escape_string($this->connect,$value)."' ";
			}
			$list =[
				'field_list' => trim($field_list,','),
				'value_list' => trim($value_list,',')
			];
			return $list;
		}
		public function insertDB($table,$data)
		{
			$list = $this->createSQL($data);
			$sql = 'INSERT INTO '.$table.'('.$list['field_list'].') VALUES ('.$list['value_list'].')';
			mysqli_query($this->connect,$sql);
			return mysqli_insert_id($this->connect);
		}

		
		public function updateDB($table,$data,$conditional)
		{
			$sql = '';
			$where = '';
			foreach($data as $key=>$value)
			{
				$sql.=",$key =  '".mysqli_escape_string($this->connect,$value)."' ";
			}
			$sql = trim($sql,',');

			foreach($conditional as $key=>$value)
			{
				$where.="AND $key = '".mysqli_escape_string($this->connect,xss_clean($value))."' ";
			}
			$where = trim($where,'AND');
			$update = "UPDATE $table SET ". $sql.' WHERE '.$where;

			mysqli_query($this->connect,$update);

			
			return mysqli_affected_rows($this->connect);
		}

		public function deleteDB($table,$id)
		{
			$sql = "DELETE FROM $table WHERE id=$id";
			mysqli_query($this->connect,$sql);
			return mysqli_affected_rows($this->connect); //mysqli_affected_rows : hàm trả về số dòng bị ảnh hưởng bởi câu truy vấn
		}

	}


?>