<?php
  class Project {

    public $Project_ID;
    public $Project_Title;
    public $Project_Created_Date;
    public $Project_State;

    public function __construct($Project_ID, $Project_Title, $Project_Created_Date, $Project_State)
    {
        $this->Project_ID = $Project_ID;
        $this->Project_Title = $Project_Title;
        $this->Project_Created_Date = $Project_Created_Date;
        $this->Project_State = $Project_State;
    }
    
    public function getButtonStringForProjectState()
    {
        return ($this->Project_State == "CLOSED" ? "Start working" : "Stop working");
    }
    
    public function getButtonStringCssClassForProjectState()
    {
        return ($this->Project_State == "CLOSED" ? "btn btn-success  pull-right" : "btn btn-danger  pull-right");
    }
    
    public static function fetchAll()
    {
        $projectList = [];
        $dbCon = dbConnection::connectToDB();
        $results = pg_query($dbCon, 'SELECT P.*, public.Check_Project_State(P."Project_ID") "Project_State"
            FROM public."Project" P ORDER BY P."Project_ID" ASC') or die('Select query failed: ' . pg_last_error());

        while ($row = pg_fetch_assoc($results))
          $projectList[] = new Project($row['Project_ID'], $row['Project_Title'], $row['Project_Created_Date'], $row['Project_State']);

        pg_close($dbCon);
        return $projectList;
    }
  }
?>
