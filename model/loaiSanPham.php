<?php
    class loaiSanPham implements Iterator
    {

        private $lspMa;
        private $lspTen;
        private $lspMoTa;

        public function __construct($lspMa,$lspTen,$lspMoTa)
        {
            $this->lspMa = $lspMa;
            $this->lspTen = $lspTen;
            $this->lspMoTa = $lspMoTa;
        }

        // Get method
        public function getlspMa()
        {
            return $this->lspMa;
        }

        public function getlspTen()
        {
            return $this->lspTen;
        }

        public function getlspMoTa()
        {
            return $this->lspMoTa;
        }

        // Set method

        public function setlspTen($lspTen)
        {
            $this->lspTen = $lspTen;
        }

        public function setlspMoTa($lspMoTa)
        {
            $this->lspMoTa = $lspMoTa;
        }


        // Magic Get

        public function __get($name) 
        {
            switch($name) 
            {
                case 'lspMa': 
                return $this->getlspMa();
                case 'lspTen': 
                return $this->getlspTen();
                case 'lspMoTa': 
                return $this->getlspMoTa();
            }
          }


        // Magic Set

        public function __set($name,$value) 
        {
            switch($name) 
            { 
                case 'lspTen': 
                return $this->setlspTen($value);
                case 'lspMoTa': 
                return $this->setlspMoTa($value);
            }
          }

          // iterator
          public function rewind() {
            var_dump(__METHOD__);
            $this->position = 0;
        }
    
        public function current() {
            var_dump(__METHOD__);
            return $this->array[$this->position];
        }
    
        public function key() {
            var_dump(__METHOD__);
            return $this->position;
        }
    
        public function next() {
            var_dump(__METHOD__);
            ++$this->position;
        }
    
        public function valid() {
            var_dump(__METHOD__);
            return isset($this->array[$this->position]);
        }
    }

        


     