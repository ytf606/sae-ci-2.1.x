<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/*email系统的可用配置参数
$config['useragent'] = 'CodeIgniter';
$config['protocol'] = 'mail';//mail,sendmail,smtp
$config['mailpath'] = "/usr/sbin/sendmail";
$config['smtp_host'] = ''
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_port'] = 25;
$config['smtp_timeout'] = 5;
$config['wordwrap'] = TRUE;//TRUE,FALSE
$config['wrapchars'] = 76;
$config['mailtype'] = "text";//test,html
$config['charset'] = 'utf-8';
$config['validate'] = FALSE;//TRUE,FALSE
$config['priority'] = 3;//1,2,3,4,5
$config['crlf'] = "\n";//\n,\r.\n\r
$config['newline'] = '\n';//\n,\r,\n\r
$config['bcc_batch_mode'] = FALSE;//TRUE,FALSE
$config['bcc_batch_size'] = 200;
*/



$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.163.com';
$config['smtp_port'] = '25';
$config['smtp_user'] = 'xxxxxxxx@xxx.xx';
$config['smtp_pass'] = 'xxxxxxxx';
$config['mail_type'] = 'html';
$config['charset'] = 'utf-8';
?>
