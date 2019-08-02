<?php
    class HinhThucThanhToan 
    {

        private $htttMa;
        private $htttTen;

        public function __construct($htttMa,$htttTen)
        {
            $this->htttMa = $htttMa;
            $this->htttTen = $htttTen;
        }

        // Get method
        public function gethtttMa()
        {
            return $this->htttMa;
        }

        public function gethtttTen()
        {
            return $this->htttTen;
        }

        // Set method

        public function sethtttTen($htttTen)
        {
            $this->htttTen = $htttTen;
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
                case 'htttMa': 
                return $this->gethtttMa();
                case 'htttTen': 
                return $this->gethtttTen();
            }
          }


        // Magic Set

        public function __set($name,$value) 
        {
            switch($name) 
            { 
                case 'htttTen': 
                return $this->sethtttTen($value);
            }
          }

    }

        


     