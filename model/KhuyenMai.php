<?php
    class KhuyenMai 
    {

        private $kmMa;
        private $kmTen;
        private $kmNoiDung;
        private $kmTuNgay;
        private $kmDenNgay;


        public function __construct($kmMa,$kmTen, $kmNoiDung, $kmTuNgay, $kmDenNgay)
        {
            $this->kmMa = $kmMa;
            $this->kmTen = $kmTen;
            $this->kmNoiDung = $kmNoiDung;
            $this->kmTuNgay = $kmTuNgay;
            $this->kmDenNgay = $kmDenNgay;
        }

        // Get method
        public function getkmMa()
        {
            return $this->kmMa;
        }

        public function getkmTen()
        {
            return $this->kmTen;
        }
        public function getkmNoiDung()
        {
            return $this->kmNoiDung;
        }

        public function getkmTuNgay()
        {
            return $this->kmTuNgay;
        }

        public function getkmDenNgay()
        {
            return $this->kmDenNgay;
        }

        // Set method

        public function setkmTen($kmTen)
        {
            $this->kmTen = $kmTen;
        }

        public function setkmNoiDung($kmNoiDung)
        {
            $this->kmNoiDung = $kmNoiDung;
        }

        public function setkmTuNgay($kmTuNgay)
        {
            $this->kmTuNgay = $kmTuNgay;
        }

        public function setkmDenNgay($kmDenNgay)
        {
            $this->kmDenNgay = $kmDenNgay;
        }


        // Magic Get

        public function __get($name) 
        {
            switch($name) 
            {
                case 'kmMa': 
                return $this->getkmMa();
                case 'kmTen': 
                return $this->getkmTen();
                case 'kmNoiDung': 
                return $this->getkmNoiDung();
                case 'kmTuNgay': 
                return $this->getkmTuNgay();
                case 'kmDenNgay': 
                return $this->getkmDenNgay();
            }
          }


        // Magic Set

        public function __set($name,$value) 
        {
            switch($name) 
            { 
                case 'kmTen': 
                return $this->setkmTen($value);
                case 'kmNoiDung': 
                return $this->setkmNoiDung($value);
                case 'kmTuNgay': 
                return $this->setkmTuNgay($value);
                case 'kmDenNgay': 
                return $this->setkmDenNgay($value);
            }
          }

    }

        


     