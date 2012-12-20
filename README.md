CodeIgniter 是一个小巧但功能强大的 PHP 框架，作为一个简单而“优雅”的工具包，它可以为 PHP 程序员建立功能完善的 Web 应用程序。如果你是一个使用共享主机，并且为客户所要求的期限而烦恼的开发人员，如果你已经厌倦了那些傻大笨粗的框架

具体有关CodeIgniter可以参考官网 http://codeigniter.org.cn/

正因为CodeIgniter拥有这么多有点，所以国内领先的云平台SAE也收录了此框架并作为一个重点框架放到应用仓库框架选项卡的首列，地址如下：http://sae.sina.com.cn/?m=apps&a=detail&aid=10 但是SAE上的框架是1.x的版本，我们知道SAE的环境和一般VPS或者本地环境有点区别，SAE为了平台的整体安全禁止了平台上的读写操作和一些函数操作方法和操作类，所以官方的2.x版本的CodeIgniter如果想在SAE上使用必须经过一定的改造才可以。

此处的CodeIgniter是基于官方2.1.x版本修改的，同时使用本地平台和SAE平台使用，框架本身通过SAE常用变量来判断是否是SAE平台，具体可以查看具体代码细节。
经过修改的2.1.x版本的CodeIgniter很多模块都可以适应了SAE平台的正常使用，如下：

1、数据库修改，可以通过application/config/database.php文件查看，此次修改可以支持本地数据库和SAE线上数据库
如果是SAE线上数据库，不需要修改此文件任何东西，如果是本地数据库只需要修改对应的数据库配置即可

2、email发送类，可以自行修改application/config/email.php文件，根据跟人情况选择SAE的邮件服务还是个人的，只需要把相关邮件发送的配置数据添加到此配置文件中就可以了。

3、文件上传类， 可以自行修改application/config/upload.php文件，打开此文件就可以很明显的看到各个变量的配置信息，需要修改成负荷自己的配置文件信息，但是如果在SAE平台上事先要先打开storage并建立一个对应的domain，并且别勾选放到链接哦！

4、其他还有captcha、img、zip、缓存等模块，前一段时间修改的但是测试没有什么问题。
可能修改的地方还不止这些，只是时间稍长一点没有，例子当时测试完后就删除了，不过当你在SAE平台上切实使用一下的话就会体会到其它修改的地方带来的便利。

还有一点，在此版本中我加入了weibo认证的模块，需要在config.php文件最后的添加自己的weibo应用的appkey和skey以及对应的回调地址。然后在control对应的页面中添加代码如下：
<?php 
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
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
            if(isset($token)){
                $_SESSION['token'] = $token;
                setcookie('webojs_'.$this->weibooauth->client_id,http_build_query($token));
                echo "授权完成,<a href='".base_url().index_page()."/weibo/weibolist'>进入微博页面</a>";
            }else{
                echo "授权失败";
            }
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
?>

注：如果我想起来其他的更改会在此说明文档重做说明的，希望各位CodeIgniter的大牛们发现问题及时反馈，业余移植的CodeIgniter多少都会存在点问题，希望能够共完善其中的问题，谢谢！
