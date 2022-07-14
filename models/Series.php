<?php
    class Series  {
        private $id;
        private $title;
        private $platform;
        private $director;
        private $actors;
        private $audioLanguages;
        private $subtitlesLanguages;

        public function __construct($idSeries, $titleSeries, $platformSeries, $directorSeries, $actorsSeries, $audioLanguagesSeries, $subtitlesLanguagesSeries) {
            $this->id = $idSeries;
            $this->title = $titleSeries;
            $this->platform = $platformSeries;
            $this->director = $directorSeries;
            $this->actors = $actorsSeries;
            $this->audioLanguages = $audioLanguagesSeries;
            $this->subtitlesLanguages = $subtitlesLanguagesSeries;
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
        public function getTitle() {
            return $this->title;
        }

        /**
         * @param mixed $title
         */
        public function setTitle($title) {
            $this->title = $title;
        }

        /**
         * @return mixed
         */
        public function getPlatform() {
            return $this->platform;
        }

        /**
         * @param mixed $platform
         */
        public function setPlatform($platform) {
            $this->platform = $platform;
        }

        /**
         * @return mixed
         */
        public function getDirector() {
            return $this->director;
        }

        /**
         * @param mixed $director
         */
        public function setDirector($director) {
            $this->director = $director;
        }

        /**
         * @return mixed
         */
        public function getActors() {
            return $this->actors;
        }

        /**
         * @param mixed $actors
         */
        public function setActors($actors) {
            $this->actors = $actors;
        }

        /**
         * @return mixed
         */
        public function getAudioLanguages() {
            return $this->audioLanguages;
        }

        /**
         * @param mixed $audioLanguages
         */
        public function setAudioLanguages($audioLanguages) {
            $this->audioLanguages = $audioLanguages;
        }

        /**
         * @return mixed
         */
        public function getSubtitlesLanguages() {
            return $this->subtitlesLanguages;
        }

        /**
         * @param mixed $subtitlesLanguages
         */
        public function setSubtitlesLanguages($subtitlesLanguages) {
            $this->subtitlesLanguages = $subtitlesLanguages;
        }
    }
?>