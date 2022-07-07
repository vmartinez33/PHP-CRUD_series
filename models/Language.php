<?php
    class Language  {
        private $id;
        private $name;
        private $ISOcode;

        public function __construct($idLanguage, $nameLanguage, $codeLanguage) {
            $this->id = $idLanguage;
            $this->name = $nameLanguage;
            $this->ISOcode = $codeLanguage;
        }

        /**
         * @return mixed
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name) {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getISO() {
            return $this->ISOcode;
        }

        /**
         * @param mixed $code
         */
        public function setISO($code) {
            $this->ISOcode = $code;
        }
    }
?>