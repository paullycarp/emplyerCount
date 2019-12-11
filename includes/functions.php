<?php 



function get_employees()
{
    return sql_fetch_all('SELECT `employee`.*,`qualification`.`name` as `qualification_name`  FROM `employee` LEFT JOIN `qualification` ON `qualification`.`id` = `employee`.`qualification_id`');
}
function require_login()
{

    $login_user_id =  $_SESSION['user_id'] ?? null;
    
    if( ! $login_user_id)
    {
        header('location: login.php');
        exit();
    }
}

function check_credentials($email, $password)
{

}


function login_user($id)
{

}

function sql_query($sql, $bind_param = null, $data = null)
{
    global $conn;

    if( $bind_param &&  $data  )
    {
        
        $stmt = $conn->prepare($sql);

        if($conn->error)
        {
            throw new Exception($conn->error);
        }

        //$stmt->store_result();
        $stmt->bind_param($bind_param, ...$data);
        $stmt->execute();        
    }
    else
    {
        $stmt = $conn->query($sql);
    }

    if($conn->error)
    {
        throw new Exception($conn->error);
    }


    return  $stmt;
   
}

function sql_fetch_one($sql, $bind_param = null, $data = null)
{
    global $conn;
    $stmt = sql_query($sql, $bind_param, $data);

    
    $r = $bind_param ? $stmt->get_result() : $stmt;
    $data = [];
    while ( $row = mysqli_fetch_assoc($r) ) {
        $data[] = $row;
    }
    $stmt->close();
    $conn->next_result();
    return $data[0] ?? null;
}


function sql_fetch_all($sql, $bind_param = null, $data = null)
{
   
    global $conn;
    $stmt = sql_query($sql, $bind_param, $data);

    $r = $bind_param ? $stmt->get_result() : $stmt;
    $data = [];
    while ( $row = mysqli_fetch_assoc($r) ) {
        $data[] = $row;
    }
    $stmt->close();
    $conn->next_result();
    return $data;
}


function sql_insert($table, array $data)
{
    $sql = 'INSERT INTO '.$table;
    $cols = '';
    $placeholders = '';
    $params = '';
    $values = [];
    foreach($data as $col => $val)
    {
        if($cols)
        {
            $cols .= ',';
            $placeholders .= ',';
        }
        if(gettype($val) == 'integer')
        {
            $params .= 'i';
        }
        else
        {
            $params .= 's'; 
        }
        $cols .= $col;
        $placeholders .= '?';
        $values[] = $val;
    }
    $sql .= '('.$cols.')  VALUES('.$placeholders.');';

    $stmt = sql_query($sql, $params, $values);
    return [
        'id' => $stmt->insert_id,  
        'error' => $stmt->error,  
    ];
}


function sql_update($table, $where, array $data)
{
    $sql = 'UPDATE '.$table .' SET ';
    $cols = '';
    $params = '';
    $values = [];
    foreach($data as $col => $val)
    {
        if($cols)
        {
            $cols .= ',';
        }

        if(gettype($val) == 'integer')
        {
            $params .= 'i';
        }
        else
        {
            $params .= 's'; 
        }
        $cols .= $col.'='.'?';
        $values[] = $val;
    }
    $sql .= $cols . ' WHERE ';

    foreach($where as $col => $val)
    {
        $sql .= $col.'='.$val.';';
    }

    $stmt = sql_query($sql, $params, $values);
    return [
        'success' => ! $stmt->error,  
        'error' => $stmt->error,  
    ];
}

function sql_delete($table, array $where)
{
    $sql = 'DELETE FROM '.$table;
    $cols = '';
    $params = '';
    $values = [];
    foreach($where as $col => $val)
    {
        if($cols)
        {
            $cols .= ' AND ';
        }

        if(gettype($val) == 'integer')
        {
            $params .= 'i';
        }
        else
        {
            $params .= 's'; 
        }
        $cols .= $col.'='.'?';
        $values[] = $val;
        
    }
    $sql .=  ' WHERE '.$cols;

    $stmt = sql_query($sql, $params, $values);
    return [
        'success' => ! $stmt->error,  
        'error' => $stmt->error,  
    ];
}
function get_qualifications()
{
    return   sql_fetch_all('SELECT * FROM qualification');

}



function group_employee_chart_data($categories, $data, $column = 'qualification_name', $sub_group_column = 'gender')
{
    $result = [];
    $labels = [];
    $groups = [];
    $datasets = [];
    foreach($data as $row)
    {
        $col_value = $row[$column];
        $sub_col_value = $row[$sub_group_column];

        if( ! isset($labels[$col_value]))
        {
            $labels[$col_value] = $col_value;
            $groups[$col_value] = [];
        }
        if( ! isset($groups[$col_value][$sub_col_value]))
        {
            $groups[$col_value][$sub_col_value] = 0;
        }
        $groups[$col_value][$sub_col_value]++;
    }
   
    foreach($categories as $category)
    {
        $cat_label = $category['label'] ?? '';
        $category['data'] = [];
       
        foreach($labels as $label)
        {
            $category['data'][] = $groups[$label][$cat_label] ?? 0;
        }
        $datasets[] = $category;
    }
    return [
        'labels' => $labels,
        'datasets' => $datasets
    ];
}