<?php
    class NhaSanXuat 
    {

        private $nsxMa;
        private $nsxTen;

        public function __construct($nsxMa,$nsxTen)
        {
            $this->nsxMa = $nsxMa;
            $this->nsxTen = $nsxTen;
        }

        // Get method
        public function getnsxMa()
        {
            return $this->nsxMa;
        }

        public function getnsxTen()
        {
            return $this->nsxTen;
        }

        // Set method

        public function setnsxTen($nsxTen)
        {
            $this->nsxTen = $nsxTen;
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
                case 'nsxMa': 
                return $this->getnsxMa();
                case 'nsxTen': 
                return $this->getnsxTen();
            }
          }


        // Magic Set

        public function __set($name,$value) 
        {
            switch($name) 
            { 
                case 'nsxTen': 
                return $this->setnsxTen($value);
                case 'lspMoTa': 
                return $this->setlspMoTa($value);
            }
          }

    }

        


     