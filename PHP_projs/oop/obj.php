<?php
class person{

public $fname=false;
public $lname=false;
public $age=false;
public $job=false;
function get_data(){
if($this->fname !== false && $this->lname !== false ) return $this->fname.' '.$this->lname."<br>";
if($this->age !== false) return $this->age;
if($this->job !== false) return $this->job;
return false;
}
}
$mido=new person();


$mido->job="hacker";

print $mido->get_data();





?>