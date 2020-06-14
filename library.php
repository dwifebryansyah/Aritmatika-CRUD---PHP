<?php  
$con = mysqli_connect('localhost','root','','db_ulangan') or die('gagal');

class oop{

	public function tampil($table)
	{
		global $con;

		$sql = "SELECT * FROM $table";
		$query = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_array($query))
			$isi[] = $data;
		return @$isi;
	}

	public function simpan($table,$isi,$link)
	{
		global $con;

		$sql = "INSERT INTO $table SET $isi";
		$query = mysqli_query($con,$sql);

		if ($query) {
			echo "<script>alert('Success');document.location.href='$link'</script>";
		}else{
			echo "<script>alert('Failed');document.location.href='$link'</script>";
		}
	}

	public function hapus($table,$where,$link)
	{
		global $con;

		$sql = "DELETE FROM $table WHERE $where";
		$query = mysqli_query($con,$sql);

		if ($query) {
			echo "<script>alert('Success');document.location.href='$link'</script>";
		}else{
			echo "<script>alert('Failed');document.location.href='$link'</script>";
		}
	}

	public function edit($table,$where)
	{
		global $con;

		$sql = "SELECT * FROM $table WHERE $where";
		$data = mysqli_fetch_array($query);
		return $data;
	}

	public function ubah($table,$isi,$where)
	{
		global $con;

		$sql = "UPDATE FROM $table SET $isi WHERE $where";
		$query = mysqli_query($con,$sql);
		if ($query) {
			echo "<script>alert('Success');document.location.href='$link'</script>";
		}else{
			echo "<script>alert('Failed');document.location.href='$link'</script>";
		}
		// while ($data = mysqli_fetch_array($query));
		// $data[] = $isi;
		// return $isi;
	}

	public function autokode($table, $field, $prefix){
			
			global $con;

            $sql = "SELECT COUNT($field) FROM $table";
            $query = mysqli_query($con, $sql);
            $rows = mysqli_num_rows($query);
            if($rows > 0){
                $sql = "SELECT MAX($field) AS max FROM $table";
                $query = mysqli_query($con, $sql);
                $result = mysqli_fetch_assoc($query);
                $jml = substr($result['max'], 2,3);
                $jml += 1;
                if(strlen($jml) == 4){ 
                    $kode = $prefix.$jml;
                }else if(strlen($jml) == 3){ 
                    $kode = $prefix."0".$jml;
                }else if(strlen($jml) == 2){ 
                    $kode = $prefix."00".$jml;
                }else if(strlen($jml) == 1){ 
                    $kode = $prefix."000".$jml;
                }
            }else{
                $kode = $prefix.'0001';
            }
            return $kode;
        }

}

?>
