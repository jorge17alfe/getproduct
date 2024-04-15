<?php

class AdminModel
{
    public function Active()
    {
       
        global $wpdb;
        $table1 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gpgetproduct(
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` TEXT NULL,
            `product` TEXT NULL,
            PRIMARY KEY (`id`));
            ";

         $wpdb->query($table1);


        global $wpdb;
        $table2 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}gpstore(
            `id` INT AUTO_INCREMENT NOT NULL,
            `storeid` VARCHAR(100) NULL,
            PRIMARY KEY (`id`));
            ";

         $wpdb->query($table2);



         return ;
    }

    public function SelectAllId($table, $id)
    {
        global $wpdb;
        $query = "SELECT * FROM $table WHERE id = $id";
        return $wpdb->get_results($query, ARRAY_A);
    }
    public function Insert($table, $data)
    {
        global $wpdb;
        $wpdb->insert($table, $data);
    }


  
    
 
}