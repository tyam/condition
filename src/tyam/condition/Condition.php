<?php

namespace tyam\condition;

class Condition {
    private $isFine;
    private $content;

    private final function __construct(bool $isFine, $content) {
        $this->isFine = $isFine;
        $this->content = $content;
    }

    public static function fine($content) {
        return new Condition(true, $content);
    }

    public static function poor($content) {
        return new Condition(false, $content);
    }

    public function isFine() {
        return $this->isFine;
    }

    public function isPoor() {
        return ! $this->isFine;
    }

    public function __invoke() {
        return $this->isFine;
    }

    public function get() {
        if ($this->isFine) {
            return $this->content;
        } else {
            throw new \LogicException('Condition::get() called while that is poor.');
        }
    }

    public function describe() {
        if ($this->isFine) {
            return null;
        } else {
            return $this->content;
        }
    }
}