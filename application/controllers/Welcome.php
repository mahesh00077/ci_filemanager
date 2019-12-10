<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_tool_image');
	}
	public function index() {
		$data = array();
		$data['image'] = 'image/placeholder.png';
		$data['placeholder'] = 'image/placeholder.png';

		$thumb = 'placeholder.png';
		$data['thumb'] = $this->model_tool_image->resize($thumb, 100, 100);

		$this->load->view('welcome_message', $data);
	}public function add() {
		$data = array();
		$data['image'] = 'image/placeholder.png';
		$data['placeholder'] = 'image/placeholder.png';

		$thumb = 'placeholder.png';
		$data['thumb'] = $this->model_tool_image->resize($thumb, 100, 100);

		$this->load->view('add', $data);
	}
	public function fileread() {

		$file = 'check/index1.html';

		$fs = fopen($file, "r");
		$ft1 = fopen("check/header1.php", "w");
		$ft2 = fopen("check/sidebar1.php", "w");
		$ft3 = fopen("check/body1.php", "w");
		$ft4 = fopen("check/footer1.php", "w");

		if ($fs == NULL) {
			echo "Can't Open Source File ...";
			exit(0);
		}
		if ($ft1 == NULL || $ft2 == NULL || $ft3 == NULL || $ft4 == NULL) {
			echo "Can't Open Destination File ...";
			fclose($fs);
			exit(1);
		} else {
			//adding in header

			while ($ch = fgets($fs)) {
				$searchfor = '<div class="main-sidebar sidebar-style-2"><!-- -->'; //sidebar start
				$contents = ($ch);
				$pattern = preg_quote($searchfor, '/');
				$pattern = "/^.*$pattern.*\$/m";
				if (preg_match_all($pattern, $contents, $matches)) {
					echo "Found matches: header done<br>";
					//  adding in sidebar
					fputs($ft2, $ch);
					while ($ch = fgets($fs)) {
						$searchfor = '</div><!-- -->'; //sidebar end
						$contents = ($ch);
						$pattern = preg_quote($searchfor, '/');
						$pattern = "/^.*$pattern.*\$/m";
						if (preg_match_all($pattern, $contents, $matches)) {
							echo "Found matches:sidebar done<br>";
							// adding in body
							fputs($ft2, $ch);
							while ($ch = fgets($fs)) {
								$searchfor = '<footer';
								$contents = ($ch);
								$pattern = preg_quote($searchfor, '/');
								$pattern = "/^.*$pattern.*\$/m";
								if (preg_match_all($pattern, $contents, $matches)) {
									echo "Found matches:body done<br>";
									// adding in footer
									fputs($ft4, $ch);
									while ($ch = fgets($fs)) {
										$searchfor = '</html>';
										$contents = ($ch);
										$pattern = preg_quote($searchfor, '/');
										$pattern = "/^.*$pattern.*\$/m";
										if (preg_match_all($pattern, $contents, $matches)) {
											echo "Found matches:done footer";
											fputs($ft4, $ch);
											break;
										} else {
											fputs($ft4, $ch);
										}
									}
									// footer close
									break;
								} else {
									fputs($ft3, $ch);
								}
							}
							// body close
							break;
						} else {
							fputs($ft2, $ch);
						}
					}
					// sidebar close
					break;
				} else {
					fputs($ft1, $ch);
				}
			}
			// header close
			fclose($fs);
			fclose($ft1);
			fclose($ft2);
			fclose($ft3);
			fclose($ft4);

		}

	}
	public function addTxtinLinkTag() {
		$file = 'check/header.php';

		$path_to_file = $file;
		$file_contents = file_get_contents($path_to_file);

		$file_contents = str_replace('<link rel="stylesheet" href="', '<link rel="stylesheet" href="<?php echo base_url();?>/assets/', $file_contents);
		file_put_contents($path_to_file, $file_contents);
	}
	public function addTxtinScriptTag() {
		$file = 'check/footer.php';

		$path_to_file = $file;
		$file_contents = file_get_contents($path_to_file);

		$file_contents = str_replace('<script src="', '<script src="<?php echo base_url();?>/assets/', $file_contents);
		file_put_contents($path_to_file, $file_contents);
	}
	public function newDashboardCreate() {
		$content = "<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __costruct()
	{
		parent::__costruct();

	}
	public function index()
	{
		\$this->load->view('theme/dashboard_header');
		\$this->load->view('theme/dashboard_sidebar');
		\$this->load->view('theme/dashboard_index');
		\$this->load->view('theme/dashboard_footer');
	}
}";
		$fp = fopen('check/new.php', "wb");
		fwrite($fp, $content);
		fclose($fp);
		chmod('check/new.php', 0777);

	}
	public function emailSend() {
		//setup SMTP configurion
		// header('content-type: image/png');
		$config = Array(
			'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
			'smtp_host' => 'smtp.gmail.com', // smtp.gmail.com or localhost
			'smtp_port' => 587, // 465 or 587
			'smtp_user' => '',
			'smtp_pass' => '',
			'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
			'mailtype' => 'html', //plaintext 'text' mails or 'html'
			'smtp_timeout' => '4', //in seconds
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE,

		);

		$file = base_url() . "image/no_image.png";
		$im = file_get_contents($file);
		$this->load->library('email', $config); // Load email template
		$this->email->set_newline("\r\n");
		$this->email->from('', 'Anil Labs');
		$data = array(

			'name' => 'Manoj Patil',
			'URL' => 'http://manojpatial.com/login',
			'user_name' => 'manojpatil',
			'password' => 'welcome',

		);
		$message = $this->load->view('emailSend', $data, TRUE);

		$this->email->to(''); // replace it with receiver email id
		$this->email->subject('mama'); // replace it with email subject
		$this->email->message($im);
		$this->email->message($message);
		// $this->email->send();
		if ($this->email->send()) {
			echo "sent";
		} else {
			echo "fail";
		}
	}
}
