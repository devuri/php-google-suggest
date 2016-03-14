<?php

/**
 * PHP Google suggest keyword tool. Google suggest search result.
 *
 * @author euclid1990
 */
namespace euclid1990\PhpGoogleSuggest;

use Exception;
use Illuminate\Config\Repository;

class GoogleSuggest {

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var string
     */
    protected $api = "http://suggestqueries.google.com/complete/search?callback=?&q=%s&client=youtube&hl=%s";

    /**
     * Constructor
     *
     * @param Repository $config
     */
    function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Get camel case string
     *
     * @param  string  $word
     * @return string
     */
    public function camel($word)
    {
        return lcfirst(str_replace(' ', '', ucwords(strtr($word, '_-', '  '))));
    }

    /**
     * Init configuration
     *
     * @return void
     */
    protected function configure()
    {
        if ($this->config->has('google_suggest')) {
            foreach($this->config->get('google_suggest') as $key => $val) {
                $key = $this->camel($key);
                $this->{$key} = $val;
            }
        }
    }

    /**
     * Return html/json data by using cURL function.
     *
     * @param  string  $keyword
     * @return mixed
     */
    public function cURL($keyword)
    {
        $url = sprintf($this->api, $keyword, $this->language);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json; charset=utf-8']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $content = curl_exec($ch);
        curl_close($ch);
        // Detect encoding and make everything UTF-8
        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = iconv('ISO-8859-9', 'UTF-8', $content);
        }
        return $content;
    }

    /**
     * Return array list suggestion from string content
     *
     * @param  string  $string
     * @return array
     */
    public function parse($string)
    {
        // Remove the outer window.google.ac.h( .. and .. )
        $content = preg_replace("/(^.*?\()|(\))$/", '', $string);
        $data = json_decode($content, true);

        $result = [];
        if (empty($data[1])) {
            return $result;
        }
        $data = $data[1];
        foreach ($data as $key => $value) {
            if (!empty($value[0]) && !in_array($value[0], $result)) {
                array_push($result, $value[0]);
            }
        }
        $result = array_slice($result, 0, $this->limit);
        return $result;
    }

    /**
     * Search keyword string and get list suggestion search/trending keyword.
     *
     * @param  string  $keyword
     * @return mixed
     */
    public function search($keyword)
    {
        $this->configure();
        // Remove undesired whitespace of $keyword
        $keyword = mb_convert_kana($keyword, 's');
        $keyword = trim($keyword);
        $keyword = preg_replace('/\s+/', ' ',$keyword);
        $content = $this->cURL($keyword);
        return $this->parse($content);
    }
}