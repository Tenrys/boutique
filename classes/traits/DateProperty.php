<?php

trait DateProperty {
	protected DateTime $date;

	public function getDate() { return $this->date; }
	public function setDate($date) {
		if (is_string($date)) {
			$date = new DateTime($date);
		}
		if (!$date instanceof DateTime) {
			throw new InvalidArgumentException(__METHOD__ . " requires either a DateTime or valid DateTime string");
		}
		$this->date = $date;
	}
}
