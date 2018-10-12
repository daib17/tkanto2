<?php
class Hour
{
    private $student;
    private $time;
    private $duration;

    function __construct($student = "", $time = 0, $duration = -1) {
        $this->student = $student;
        $this->time = $time;
        $this->duration = $duration;
    }

    public function setStudent($student) {
        $this->student = $student;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
    }

    public function getStudent() {
        return $this->student;
    }

    public function getTime() {
        return $this->time;
    }

    public function getDuration() {
        return $this->duration;
    }
}
