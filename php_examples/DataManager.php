<?php
class DataManager
{
    /*
     * Mainīgais kas satur visas datubāzes tabulu divdimensionālā masīvā
     */
    private $table = [];
    private $file_name = 'db.json';

    public function __construct($filename)
    {
        $this->file_name = $filename;
        if (file_exists($this->file_name)) {
            $content = file_get_contents($this->file_name);
            $data = json_decode($content, true);
            if (is_array($data)) {
                $this->table = $data;
            }
        }
    }


    /*
     * Saglabā vērtību iekš datubāzes ar atslēgām $r un $c 
     * @param int $r - pirmā atslēga
     * @param int $c - otrā atslēga
     * @param mixed $value - vērtība kas tiks saglabāta datubāzē
     */
    public function save($r, $c, $value)
    {
        $this->table[$r][$c] = $value;
        $content = json_encode($this->table, JSON_PRETTY_PRINT);
        file_put_contents($this->file_name, $content);
    }

    /*  
     * Atgriež vērtību no datubāzes kas atbilst atslēgām $r un $c 
     * @param(parameter) int(integer) $r
     * @param int $c 
     *
     * @return mixed vērtība no datubāzes || tukšu stringu.
     */

    public function get($r, $c)
    {
        if (array_key_exists($r, $this->table) && array_key_exists($c, $this->table[$r])) {
            return $this->table[$r][$c];
        }

        return '';
    }

    /*
     * @return int 
     */
    public function count()
    {
        $count = 0;
        foreach ($this->table as $row) {
            foreach ($row as $value) {
                $count++;
            }
        }

        return $count;
    }
    
    public function deleteAll() {
        $this->table = [];
        
        file_put_contents($this->file_name, '');
    }
}
