<?php
/**
 * Created by IntelliJ IDEA.
 * User: bibek
 * Date: 12/4/17
 * Time: 1:21 AM
 */

class PISLogger
{
    private $filePointer;



    /**
     * @param $message
     */
    public function logInfo($message)
    {
        if (!is_resource($this->filePointer)) {
            $this->openFile();
        }
        //script name
        $scriptName = pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME);
        //define current time
        $time = @date('[d-M-Y:H:i:s]');
        fwrite($this->filePointer, "$time ($scriptName) :  $message\r\n");
    }
    public function closeFile(){
        fclose($this->filePointer);
    }
    private function openFile()
    {
        //for window user
        if (strtoupper(PHP_OS) === 'WIN') {
            $logDirDefault = "c:/pis/user-pis-log-" . @date('[d-M-Y]') . ".txt";
        } else {
            $logDirDefault = "/home/bibek/pis/user-pis-log-" . @date('d-M-Y') . ".txt";
        }
        $this->filePointer = fopen($logDirDefault, 'a') or exit("cant open file");
    }

}