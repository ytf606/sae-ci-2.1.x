<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Weibo extends CI_Controller {
	public $config_weibo = array();

	public function __construct(){
		parent::__construct();
		$this->config_weibo['client_id'] = $this->config->item('WB_AKEY');	
		$this->config_weibo['client_secret'] = $this->config->item('WB_SKEY');
	}

	public function index(){
		$this->load->library('Weibooauth',$this->config_weibo);
		$this->load->helper('url');
		$code_url = $this->weibooauth->getAuthorizeURL($this->config->item('WB_CALLBACK_URL'));

		echo "<a href=".$code_url.">Use Oauth to login</a>";
		$this->output->enable_profiler(TRUE);
	}

	public function callback(){
		$this->load->library('Weibooauth', $this->config_weibo);
		$this->load->helper('url');

		if(isset($_REQUEST['code'])){
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = $this->config->item('WB_CALLBACK_URL');
			try{
				$token = $this->weibooauth->getAccessToken('code', $keys);
			}catch(OAuthException $e){
			
			}
		}

		if(isset($token)){
			$_SESSION['token'] = $token;
			setcookie('webojs_'.$this->weibooauth->client_id,http_build_query($token));
			echo "授权完成,<a href='".base_url().index_page()."/weibo/weibolist'>进入微博页面</a>";
		}else{
			echo "授权失败";
		}
	}

	public function weibolist(){
		$this->config_weibo['access_token'] = $_SESSION['token']['access_token'];
		$this->load->library("Weiboclient",$this->config_weibo);
		
		$ms = $this->weiboclient->home_timeline();
		$uid_get = $this->weiboclient->get_uid();
		$uid = $uid_get['uid'];
		$user_message = $this->weiboclient->show_user_by_id($uid);
		$data = array(
			'user_message' => $user_message,
			'ms' => $ms,
		);
		$this->load->view('weibo_list',$data);
		$this->output->enable_profiler(TRUE);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
