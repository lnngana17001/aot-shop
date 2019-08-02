<?php
    class SanPham 
    {

        private $spMa;
        private $spTen;
        private $spGia;
        private $spMoTaNgan;
        private $spMoTaChiTiet;
        private $spNgayCapNhat;
        private $spSoLuong;
        private $lspTen;
        private $nsxTen;
        private $kmTen;

        public function __construct($spMa,$spTen, $spGia, $spMoTaNgan, $spMoTaChiTiet,$spNgayCapNhat,$spSoLuong, $lspTen, $nsxTen, $kmTen)
        {
            $this->spMa = $spMa;
            $this->spTen = $spTen;
            $this->spGia = $spGia;
            $this->spMoTaNgan = $spMoTaNgan;
            $this->spMoTaChiTiet = $spMoTaChiTiet;
            $this->spNgayCapNhat = $spNgayCapNhat;
            $this->spSoLuong = $spSoLuong;
            $this->lspTen = $lspTen;
            $this->nsxTen = $nsxTen;
            $this->kmTen = $kmTen;
        }

        // Get method
        public function getspMa()
        {
            return $this->spMa;
        }

        public function getspTen()
        {
            return $this->spTen;
        }
        public function getspGia()
        {
            return $this->spGia;
        }

        public function getspMoTaNgan()
        {
            return $this->spMoTaNgan;
        }

        public function getspMoTaChiTiet()
        {
            return $this->spMoTaChiTiet;
        }
        public function getspNgayCapNhat()
        {
            return $this->spNgayCapNhat;
        }

        public function getspSoLuong()
        {
            return $this->spSoLuong;
        }

        public function getlspTen()
        {
            return $this->lspTen;
        }

        public function getnsxTen()
        {
            return $this->nsxTen;
        }

        public function getkmTen()
        {
            return $this->kmTen;
        }

        // Set method

        public function setspTen($spTen)
        {
            $this->spTen = $spTen;
        }

        public function setspGia($spGia)
        {
            $this->spGia = $spGia;
        }

        public function setspMoTaNgan($spMoTaNgan)
        {
            $this->spMoTaNgan = $spMoTaNgan;
        }

        public function setspMoTaChiTiet($spMoTaChiTiet)
        {
            $this->spMoTaChiTiet = $spMoTaChiTiet;
        }
        public function setspNgayCapNhat($spNgayCapNhat)
        {
            $this->spNgayCapNhat = $spNgayCapNhat;
        }

        public function setspSoLuong($spSoLuong)
        {
            $this->spSoLuong = $spSoLuong;
        }

        public function setlspTen($lspTen)
        {
            $this->lspTen = $lspTen;
        }

        public function setnsxTen($nsxTen)
        {
            $this->nsxTen = $nsxTen;
        }

        public function setkmTen($kmTen)
        {
            $this->kmTen = $kmTen;
        }

        // Magic Get

        public function __get($name) 
        {
            switch($name) 
            {
                case 'spMa': 
                return $this->getspMa();
                case 'spTen': 
                return $this->getspTen();
                case 'spGia': 
                return $this->getspGia();
                case 'spMoTaNgan': 
                return $this->getspMoTaNgan();
                case 'spMoTaChiTiet': 
                return $this->getspMoTaChiTiet();
                case 'spNgayCapNhat': 
                return $this->getspNgayCapNhat();
                case 'spSoLuong': 
                return $this->getspSoLuong();
                case 'lspTen': 
                return $this->getlspTen();
                case 'nsxTen': 
                return $this->getnsxTen();
                case 'kmTen': 
                return $this->getkmTen();
            }
          }


        // Magic Set

        public function __set($name,$value) 
        {
            switch($name) 
            { 
                case 'spTen': 
                return $this->setspTen($value);
                case 'spGia': 
                return $this->setspGia($value);
                case 'spMoTaNgan': 
                return $this->setspMoTaNgan($value);
                case 'spMoTaChiTiet': 
                return $this->setspMoTaChiTiet($value);
                case 'spNgayCapNhat': 
                return $this->setspNgayCapNhat($value);
                case 'spSoLuong': 
                return $this->setspSoLuong($value);
                case 'lspTen': 
                return $this->setlspTen($value);
                case 'nsxTen': 
                return $this->setnsxTen($value);
                case 'kmTen': 
                return $this->setkmTen($value);
            }
          }

    }

        


     