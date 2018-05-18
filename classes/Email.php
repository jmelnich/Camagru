<?php
final class Email {
	/* Set preferences */
	//TODO:fix class
	private $subject_preferences = array(
					"input-charset" => "utf-8",
					"output-charset" => "utf-8",
					"line-length" => 76,
					"line-break-chars" => "\r\n"
				);

	private function send($from, $name, $msg, $to, $subject) {
		/* Set mail header */
		$header = "Content-type: text/html; charset=" . "utf-8" . " \r\n";
		$header .= "From: ". $name . " <" . $from . "> \r\n";
		$header .= "MIME-Version: 1.0 \r\n";
		$header .= "Content-Transfer-Encoding: 8bit \r\n";
		$header .= "Date: " . date("r (T)") . " \r\n";
		$header .= iconv_mime_encode("Subject", $subject, $this->subject_preferences);
		/* now sending */
		mail($to, $subject, $msg, $header);
	}

	public function activate($to, $link) {
		$from = Config::get('mail/admin_mail');
		$msg = Config::get('mail/activate_msg');
		$name = Config::get('mail/admin_name');
		$fullMsg = $msg . " Please activate Your account for " . $link;
		$subject = 'Registration';
		$this->send($from, $name, $fullMsg, $to, $subject);
	}

	public function remind() {

	}

	public function contact($from, $name, $msg) {
		$subject = 'A letter from website visitor';
		$to = Config::get('mail/admin_mail');
		$this->send($from, $name, $msg, $to, $subject);
	}
}