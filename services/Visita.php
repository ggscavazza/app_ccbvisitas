<?php
    class Visita {
        public $table_prefix;
        private Conexao $conn;

        public function marcarVisita($dados) {
            $busca_id = $this->buscarUmaVisita($dados);
            $busca_hoje = $this->buscarVisitaHoje();
            
            if ($busca_id === false && $busca_hoje === false) {
                $bd = new $this->conn;
                $bd->conectar();

                if (gettype($dados) == 'array') {                    
                    $colunas_inserir = "";
                    $valores_inserir = "";
                    $ultima_chave = array_key_last($dados);
                    
                    foreach ($dados as $coluna => $valor) {
                        $colunas_inserir .= "{$coluna}, ";
                        $valores_inserir .= "'{$valor}', ";                        
                    }
                    
                    $colunas_inserir .= "status";
                    $valores_inserir .= "'1'";
                    

                    $updt = "INSERT INTO {$this->table_prefix}_marcadas ({$colunas_inserir}) VALUES ({$valores_inserir})";

                    $bd->query($updt);
                    $bd->close();

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function editarVisita($id, $dados) {
            $busca_id = $this->buscarUmaVisita($id);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                if (gettype($dados) == 'array') {                    
                    $campos_editar = "";
                    $ultima_chave = array_key_last($dados);
                    
                    foreach ($dados as $coluna => $valor) {
                        if ($coluna != $ultima_chave) {
                            $campos_editar .= "`{$coluna}`='{$valor}', ";
                        } else {
                            $campos_editar .= "`{$coluna}`='{$valor}'";
                        }
                    }

                    $updt = "UPDATE {$this->table_prefix}_marcadas SET {$campos_editar} WHERE id='{$id}'";

                    $bd->query($updt);
                    $bd->close();

                    return true;
                } else {
                    return false;
                }
            }
        }

        public function desmarcarVisita($id) {
            $busca_id = $this->buscarUmaVisita($id);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                $updt = "UPDATE {$this->table_prefix}_marcadas SET status='0' WHERE id='{$id}'";

                $bd->query($updt);
                $bd->close();

                return true;                
            }
        }

        public function concluirVisita($id) {
            $busca_id = $this->buscarUmaVisita($id);
            
            if ($busca_id === false) {   
                return false;
            } else {
                $bd = new $this->conn;
                $bd->conectar();

                $updt = "UPDATE {$this->table_prefix}_marcadas SET status='2' WHERE id='{$id}'";

                $bd->query($updt);
                $bd->close();

                return true;                
            }
        }

        public function buscarVisita() {
            $bd = new $this->conn;
            $bd->conectar();
            
            $sql = "SELECT * FROM {$this->table_prefix}_marcadas";
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $bd->close();

                return $query;
            } else {
                $bd->close();

                return false;
            }
        }

        public function buscarVisitaHoje() {
            $bd = new $this->conn;
            $bd->conectar();

            $hoje = date("Y-m-d");            
            $sql = "SELECT * FROM {$this->table_prefix}_marcadas WHERE data_ordem='{$hoje}' AND status='1'";
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $bd->close();

                return $query;
            } else {
                $bd->close();

                return false;
            }
        }
        
        public function buscarUmaVisita($id=null, $dados=null) {
            $bd = new $this->conn;
            $bd->conectar();
            
            if (!is_null($id)) {
                $sql = "SELECT * FROM {$this->table_prefix}_marcadas WHERE id='{$id}'";
            } else {
                $id = addslashes($dados['id']);
                $status = addslashes($dados['status']);

                $sql = "SELECT * FROM {$this->table_prefix}_marcadas WHERE id='{$id}' AND status='{$status}'";
            }
            
            
            $query = $bd->query($sql);
            $num = $bd->num_rows($query);

            if ($num > 0) {
                $row = $bd->fetch_assoc($query);                
                $bd->close();

                return $row;
            } else {
                $bd->close();

                return false;
            }
        }
    }