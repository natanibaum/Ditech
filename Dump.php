<?php
class DatabaseDump {
    private $db;
    private $host, $user, $pass, $dbname;
    private $sql, $removeAI;

    public function __construct($host, $user, $pass, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->removeAI = true;

        try {
            $this->db = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();          
            die;
        }
    }

    private function ln($text = '') {
        $this->sql = $this->sql . $text . "\n";
    }

    public function dump($file) {
        $this->ln("SET FOREIGN_KEY_CHECKS=0;\n");

        $tables = $this->db->query('SHOW TABLES')->fetchAll(PDO::FETCH_BOTH);

        foreach ($tables as $table) {
            $table = $table[0];
            $this->ln('DROP TABLE IF EXISTS `'.$table.'`;');

            $schemas = $this->db->query("SHOW CREATE TABLE `{$table}`")->fetchAll(PDO::FETCH_ASSOC);

            foreach ($schemas as $schema) {
                $schema = $schema['Create Table'];
                if($this->removeAI) $schema = preg_replace('/AUTO_INCREMENT=([0-9]+)(\s{0,1})/', '', $schema);
                $this->ln($schema.";\n\n");
            }
        }

        file_put_contents($file, $this->sql);
    }
}
?>