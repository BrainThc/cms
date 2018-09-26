<?php
    /*
    【 DEMO 】
    
    header("Content-type: text/html; charset=utf-8");   
    $string = $_GET['v'];
 
    //你有两种方式来使用
    //No1.
    //$new = new translate( $string );
    //echo '<hr/>';
    //die;
    //No2.
    $new = new translate();
    //$new->init($string);
    //echo '<hr/>';
    $new->init($string);
 
    if( $new->err_code!=0 ){
        var_dunp( $new->err_message );
    }
    */
 
/**
 *
 *  有道翻译API —— 支持英汉互译
 *
 *  基于有道翻译的API，写了这个类。
 *  类里设置了一些参数，可以设置缓存。
 *  在使用这个服务之前，你需要去有道申请一个APPKEY，并记住填表内容的“网站名称”
 *  ★申请地址 http://fanyi.youdao.com/fanyiapi?path=data-mode
 */
 
class translate{
 
    //开发者必须设置的参数
    protected   $apikey         = '861721470'; //从有道申请的APIKEY
    protected   $keyFrom        = 'mbkunet';//申请APPKEY时，填表的网站名称的内容
                                                //注意： $keyFrom 需要是【连续的英文、数字的组合】
    //开发者可以默认的参数                                        
    protected   $cacheSwitch    = false;        //是否开启缓存
    protected   $cacheTime      = 60;           //开启缓存情况下，缓存时间
    protected   $iconv          = true;         //用于UTF8格式的编码中
    protected   $autoCut        = false;        //是否开启自动截取字符串
    protected   $doctype        = 'json';       //你希望得到请求接口返回的格式
                                                //可选： xml或json或jsonp                    
    //开发者可以忽略的参数    
    public      $mc;
    public      $err_code       = 0;
    public      $err_message    = '';
    protected   $apiurl         = 'http://fanyi.youdao.com/fanyiapi.do?type=data&version=1.1';
 
 
    public function __construct( $key=NULL ){
        if( $key )
            return $this->init( $key );
    }
    public function init( $key ){
        if(mb_strlen($key)>200){
            if( $this->autoCut )
                $query = mb_substr( $key , 0 , 200 );
            else
                return $this->error( -1 , 'query string is too long , please be less than 200)' );
        }
        else{
            $query = $key;
        }
        /*if($this->iconv){
            $query = iconv('GBK','UTF-8', $query );
        }   */  
        //organize apiurl
        $url = $this->apiurl;
        $url.= '&doctype='.$this->doctype.'&keyfrom='.$this->keyFrom;
        $url.= '&q='.$query.'&key='.$this->apikey;
        //request api interface and rebuilt response
        $result = $this->todo( $url );
        if( $result )
            //print result
            return $this->printf( $result );
    }
    private function todo( $url ){
        if( $this->cacheSwitch ){
            $result = $this->mcGet( $url );
        }
        if( !$result ){
            $url .= '&rand_num='.rand();
            $data = $this->curlGet( $url );
            if( !$data ){
                return $this->error( -2 , 'query api interface failure' );
            }
            //organize api response
            $result = $this->organize( $data );
        }
 
        if( $result && $this->cacheSwitch ){
            $this->mcSet( $url , $result );
        }
 
        return $result;
    }
    private function organize( $data ){
    /**
     *  更细一步的处理有道接口返回的数据
     *  用户可根据自己的需求，对API接口返回的数据，进行更详细的处理操作
     *
     *  @param  string  $data       //接口直接返回的数据
     *  @return string/array        //根据用户处理的结果
     *  @author pangee
     */
 
        return $data;
    }
    private function printf( $result ){
    /**
     *  返回结果处理
     *  用户根据自己的需求，修改返回结果格式
     *
     *  @param  uncertain $result   //通过$this->organize处理过的数据
     *  @return uncertain           //根据用户处理的显示
     *  @author pangee
     */
 
        //我就直接输出结果了。
        //如果你想，可以进行写入MYSQL操作等等
        return $result;
    }
 
 
    protected function error( $code , $message ){
        $this->err_code = $code;
        $this->err_message = $message;
        return false;
    }
    protected function mc(){
        if( !$this->mc ){
            $this->mc = memcache_init();
        }
        return $this->mc;
    }
    protected function mcGet( $key ){
        $mc = $this->mc();
        $md5key = substr( md5( $key.'_translate' ) , 4 , 16 );
        $lifeKey = $md5key.'_t';
        $life = memcache_get( $mc , $lifeKey );
        if( $_SERVER['REQUEST_TIME'] - $life > $this->cacheTime ){
            return false;
        }else{
            return memcache_get( $mc , $key );
        }
    }
    protected function mcSet( $key , $value ){
        $mc = $this->mc();
        $md5key = substr( md5( $key.'_translate' ) , 4 , 16 );
        $lifeKey = $md5key.'_t';
        memcache_set( $md5key , $value );
        memcache_set( $lifeKey , $_SERVER['REQUEST_TIME'] );
        return true;
    }
    protected function curlGet($url, $head = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $rs = curl_exec($ch);
        curl_close($ch);
        return $rs;
    }
 
}