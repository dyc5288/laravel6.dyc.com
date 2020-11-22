<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExamGrab extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExamGrab {y}';
    protected $cookie = 'NOWCODERUID=D1A717DF6F6404C2FA6642C21A5F3134; NOWCODERCLINETID=58C0352CE9C88A6A970845137BDB2C10; Hm_lvt_a808a1326b6c06c437de769d1b85b870=1606025424; gr_user_id=7753ec53-9be8-405e-9c3c-7fa07121e812; grwng_uid=d2b402fe-2e8b-4af4-9743-282346e4572a; t=C5EEC26D8E205A8D5BA260DB5D3E51F4; c196c3667d214851b11233f5c17f99d5_gr_last_sent_cs1=319252981; c196c3667d214851b11233f5c17f99d5_gr_session_id=a340a7fa-44e0-477e-bfa0-a4e658e80dff; c196c3667d214851b11233f5c17f99d5_gr_last_sent_sid_with_cs1=a340a7fa-44e0-477e-bfa0-a4e658e80dff; c196c3667d214851b11233f5c17f99d5_gr_session_id_a340a7fa-44e0-477e-bfa0-a4e658e80dff=true; Hm_lpvt_a808a1326b6c06c437de769d1b85b870=1606028505; c196c3667d214851b11233f5c17f99d5_gr_cs1=319252981; SERVERID=3a1c9805c8714fdca6b2e754d978f568|1606028510|1606025422';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '抓取试题数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 请求
     *
     * @param $url
     * @param $params
     * @param $cookie
     */
    public static function curl_get($url, $params, $cookie)
    {
        $md5 = md5($url);
        $file = storage_path("app/{$md5}.html");

        if (file_exists($file)) {
            echo "grap {$url}-{$file}" . PHP_EOL;
            return file_get_contents($file);
        }

        $data = http_build_query($params);
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header'=>"Content-type: application/x-www-form-urlencoded\r\n".
                          "Content-length:".strlen($data)."\r\n" .
                          "Cookie: ".$cookie."\r\n" .
                          "\r\n",
                'content' => $data,
            )
        );

        echo "grap {$url}" . PHP_EOL;
        $context = stream_context_create($opts);
        $output = file_get_contents($url, false, $context);
        file_put_contents($file, $output);
        return $output;
    }

    /**
     * @param string $url 请求网址
     * @param string $cookie 请求网址
     * @param array $header 请求头
     * @param bool $params 请求参数
     * @param int $ispost 请求方式
     * @param int $https https协议
     * @return bool|mixed
     */
    public static function curl($url, $cookie, $header = [], $params = false, $ispost = 1, $https = 1)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64)');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //$cookie_path = storage_path("app/cookie.txt");
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_path);
        //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_path);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if(!empty($header)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            //curl_setopt($ch, CURLOPT_HEADER, 0);//返回response头部信息
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        //var_dump([$httpCode, $httpInfo]);
        return $response;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $y = $this->argument('y');
        $url = 'https://www.nowcoder.com/test/question/done?tid=39557824&qid=4555#summary';
        $result = self::curl_get($url, [], $this->cookie);

        $pattern = "/\/test\/question\/done\?tid\=\d+&qid=\d+#summary/m";
        preg_match_all ($pattern, $result, $matchs);

        if (!empty($matchs[0]))
        {
            foreach($matchs[0] as $row)
            {
                $detailUrl = "https://www.nowcoder.com{$row}";
                $detail = self::curl_get($detailUrl, [], $this->cookie);
                $pattern = "/question-main\">([^<]*)</m";
                preg_match_all ($pattern, $detail, $dmatchs);

                if (empty($dmatchs[1]))
                {
                    continue;
                }

                $question = $dmatchs[1][0];
                $pattern = "/pre>([^<]*)<\/pre/m";
                preg_match_all ($pattern, $detail, $dmatchs);

                if (empty($dmatchs[1]))
                {
                    continue;
                }

                $selects = $dmatchs[1];

                foreach ($selects as $k => $s)
                {
                    $selects[$k] = html_entity_decode($s);
                }

                $pattern = "/正确答案:\n(\w)/m";
                preg_match_all ($pattern, $detail, $dmatchs);

                if (empty($dmatchs[1]))
                {
                    continue;
                }

                $answer = $dmatchs[1][0];
                var_dump(['q' => $question, 's' => $selects, 'a' => $answer]);
            }
        }

    }
}

