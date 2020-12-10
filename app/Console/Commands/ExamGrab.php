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
    protected $signature = 'ExamGrab {y} {num} {tid} {qid}';
    protected $cookie = 'NOWCODERUID=B953FCCD143C28EC899996739103E33F; NOWCODERCLINETID=61BA768A98166EAC2A1042282B44FDBE; Hm_lvt_a808a1326b6c06c437de769d1b85b870=1607562041; t=85147AF0988C577F0A4F333A7A118C37; Hm_lpvt_a808a1326b6c06c437de769d1b85b870=1607567696; SERVERID=76c38881415ad3405ef5a3db2e9b59bb|1607567853|1607565971';
    protected $cookie_ksxt = 'PHPSESSID=4i6rj9usgdq34pkrh6grhf3fh0; exam_currentuser=%25C5q%259Ds%25B4%25A6%259D%2594flS%25A4%259A%25D5%25A4%25CD%25A8%259E%25DA%25D9%25C8%25A5%25A2%259BYp%25D7j%2595sYr%259AY%25A0%25ACsd%2598%259DU%25A5%2596%25A4%25A8%25CB%25A0%25D2%25A9%2591%25D8%25D9%25DA%25A2%25AB%259BYp%25D7j%2596kq%255B%2594%259C%25C7%259Bq%2594%2596%2597cfd%2596n%25C4%2592%2597lc%259B%259D%25C5kjk%2598%2599%25C7%2595%2596kgo%2586r%25D8srm%2585%25D6%2598%25A5%25A4%259A%25A4%25D0%259A%25D4%255Bk%25D8%25A0%2594fsYhl%2596%255E%2595qej%259Dk%2593pmU%259E%25D6mcekW%25D5%2596%25D7%25AC%2599%25D4%25D4%25CA%25A5%25A8%25AC%25A7%259E%25C8R%259E%25ACqj%259EY%2596%255Bt%25A6%259D%2594ilS%25A4%259A%25D5%25A4%25CD%25A8%259E%25D1%25D5%25CA%259C%25A7%25AB%25A0%25A2%25C9R%259E%25A2qj%259Ag%259Cnoj%259B%2596cm%25A4kf%2597k%2586%25AC%2595%25D8%25D9%25CC%25A2%25A7%25AC%25AA%259A%25D6%259E%25C4%25A6%259C%255B%259F%25AA%259FosU%25C7%25D8%2594%25A0%25AA%2594W%259D%25A4%259Ejf%259F%2588%25D6%2598%25AC%25AA%25A0%25A4%25D2%25A4%25CC%25A6%259C%25A5%25CD%25A4%25CE%25AD%255Bn%25CC%259Ddhahj%2598h%259Cl%2560%25A0%25D9%259DlsY%25AA%259A%25D7%25A3%25CC%25A8%25A5%25A2%25C8Y%25A0%25ACsf%2595%259DUichi%2598b%259B%259Eb%259A%25C7%2595%2598%259E%259Am%259A%2597%2592%25C9%259Dmi%25C7p%2596%259E%259Fd%25C9%25C7iTl%25AE';

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
     * 请求
     *
     * @param $url
     * @param $params
     * @param $cookie
     */
    public static function curl_post($url, $params, $cookie)
    {
        $data = http_build_query($params);
        $opts = array(
            'http'=>array(
                'method'=>"POST",
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
        $num = $this->argument('num');
        $tid = $this->argument('tid');
        $qid = $this->argument('qid');
        $url = 'https://www.nowcoder.com/test/question/done?tid='.$tid.'&qid='.$qid.'#summary';
        $result = self::curl_get($url, [], $this->cookie);

        $pattern = "/\/test\/question\/done\?tid\=\d+&qid=\d+#summary/m";
        preg_match_all ($pattern, $result, $matchs);
        $jsonFile = storage_path("app/examGrab.json");
        $jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
        $jsonSelectFile = storage_path("app/examSelect.json");
        $jsonSelectData = file_exists($jsonSelectFile) ? file_get_contents($jsonSelectFile) : "";
        $index = 0;

        if (!empty($matchs[0]))
        {
            foreach($matchs[0] as $row)
            {
                $detailUrl = "https://www.nowcoder.com{$row}";
                $md5 = md5($detailUrl);

                if ($index >= $num)
                {
                    echo "finish {$num}." . PHP_EOL;
                    break;
                }

                if (!empty($jsonData[$md5]))
                {
                    echo "{$detailUrl} had enter." . PHP_EOL;
                    continue;
                }

                $detail = self::curl_get($detailUrl, [], $this->cookie);
                $pattern = "/question-main\">(.*?)<\/div>\n<\/div>\n<\/div>\n<div class=\"result-subject-item/is";
                preg_match_all ($pattern, $detail, $dmatchs);

                if (empty($dmatchs[1]))
                {
                    echo "{$url} no question." . PHP_EOL;
                    continue;
                }

                $question = $dmatchs[1][0];
                $qmd5 = md5($question);

                if (!empty($jsonData[$qmd5]))
                {
                    echo "{$detailUrl} question had enter." . PHP_EOL;
                    continue;
                }

                if (strpos($question, '</pre>') !== false)
                {
                    $question = html_entity_decode($question);
                    echo "{$detailUrl} pre continue." . PHP_EOL;
                    continue;
                }

                $pattern = "/class=\"result-answer-item[^>]*\">(.*?)<\/div/is";
                preg_match_all ($pattern, $detail, $dmatchs);

                if (empty($dmatchs[1]))
                {
                    echo "{$url} no selects." . PHP_EOL;
                    continue;
                }

                $selects = $dmatchs[1];
                $snames = [0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D', 4 => 'E', 5 => 'F', 6 => 'G'];

                foreach ($selects as $k => $s)
                {
                    $selects[$k] = "<p>" . $snames[$k] . "、" . $s . "</p>";
                }

                $pattern = "/正确答案:(.*?)你的答案/is";
                preg_match_all ($pattern, $detail, $dmatchs);

                if (empty($dmatchs[1]))
                {
                    echo "{$url} no answer." . PHP_EOL;
                    continue;
                }

                $answer = trim(str_replace(["\n", "&nbsp;"], [" ", ""], $dmatchs[1][0]));
                $answers = explode(' ', $answer);
                $ksxtUrl = 'http://172.22.46.55:8080/index.php?exam-master-questions-addquestion';
                $params = [
                    'args[questionknowsid]' => '84:实习生第2月',
                    'args[question]' => $question,
                    'args[questionselect]' => implode("\n", $selects),
                    'args[questionselectnumber]' => count($selects),
                    'args[questionlevel]' => '1',
                    'insertquestion' => '1',
                    'page' => '',
                ];

                // 单选
                if (count($answers) == 1)
                {
                    $params['args[questiontype]'] = '1';
                    $params['targs[questionanswer1]'] = $answer;
                }
                else if (count($answers) > 1)
                {
                    $params['args[questiontype]'] = '2';
                    $params['targs[questionanswer2]'] = $answers;
                }
                else
                {
                    echo 'questiontype error' . PHP_EOL;
                    continue;
                }

                $ksxtResult = $y ? self::curl_post($ksxtUrl, $params, $this->cookie_ksxt) : false;
                //$res = json_decode($ksxtResult, true);
                $index++;

                if (strpos($ksxtResult, 'window.location = \'index.php?exam-master-questions&page=\''))
                {
                    $jsonSelectData .= $question . ":" . $detailUrl . PHP_EOL;
                    $jsonData[$md5] = 1;
                    $jsonData[$qmd5] = 1;
                    echo $detailUrl . ' enter success!' . PHP_EOL;
                }
                else
                {
                    echo 'enter fail, error:' . $ksxtResult . PHP_EOL;die;
                }
            }
        }

        file_put_contents($jsonFile, json_encode($jsonData));
        file_put_contents($jsonSelectFile, $jsonSelectData);

    }
}

