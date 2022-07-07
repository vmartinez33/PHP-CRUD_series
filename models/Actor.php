<?php
    class Actor  {
        private $id;
        private $name;
        private $firstSurname;
        private $secondSurname;
        private $dni;
        private $birthDate;
        private $nationality;

        public function __construct($idActor, $nameActor, $firstSurnameActor, $secondSurnameActor, $dniActor, $birthDateActor, $nationalityActor) {
            $this->id = $idActor;
            $this->name = $nameActor;
            $this->firstSurname = $firstSurnameActor;
            $this->secondSurname = $secondSurnameActor;
            $this->dni = $dniActor;
            $this->birthDate = $birthDateActor;
            $this->nationality = $nationalityActor;
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
        public function getFirstSurname() {
            return $this->firstSurname;
        }

        /**
         * @param mixed $firstSurname
         */
        public function setFirstSurname($firstSurname) {
            $this->firstSurname = $firstSurname;
        }

        /**
         * @return mixed
         */
        public function getSecondSurname() {
            return $this->secondSurname;
        }

        /**
         * @param mixed $secondSurname
         */
        public function setSecondSurname($secondSurname) {
            $this->secondSurname = $secondSurname;
        }

        /**
         * @return mixed
         */
        public function getDNI() {
            return $this->dni;
        }

        /**
         * @param mixed $dni
         */
        public function setDNI($dni) {
            $this->dni = $dni;
        }

        /**
         * @return mixed
         */
        public function getBirthDate() {
            return $this->birthDate;
        }

        /**
         * @param mixed $birthDate
         */
        public function setBirthDate($birthDate) {
            $this->birthDate = $birthDate;
        }

        /**
         * @return mixed
         */
        public function getNationality() {
            return $this->nationality;
        }

        /**
         * @param mixed $nationality
         */
        public function setNationality($nationality) {
            $this->nationality = $nationality;
        }
    }
?>